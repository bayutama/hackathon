<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Model\Banner;
use App\Model\Pages;
use App\Model\Judges;
use App\Model\User;
use App\Model\Team;
use App\Model\Member;
use App\Model\Faq;
use App\Model\Event;
use App\Model\ApiLog;
use Mail;
use App\Model\HKUser;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MainController  extends Controller {
	function __construct(Request $request)
	{
		parent::__construct();
		$this->template = getenv('TEMPLATE_THEME');
		$slug = urldecode( $request->segment(1) );
		$event_id = "";
		if($slug){
			$event = Event::whereSlug($slug)->first();
			$event_id = @$event->id;
		}
		$this->event_id  = $event_id;
	
	}

	function index(Request $request)
	{
		
		$data = array();
		
		$data["banners"] = Banner::where("event_id", $this->event_id)->get();
		$data["pages"] = Pages::where("event_id", $this->event_id)->get();
		$data["judges"] = Judges::where("event_id", $this->event_id)->get();
		$data["allevent_banner"] =  Event::where('status','approved')->get();
		$data["allevent"] =  Event::where('id','!=' , $this->event_id )->where('status','approved')->get();
		$faq_raw = Faq::where("event_id", $this->event_id)->get();
		$login_msg = $request->session()->get('login_msg');
		$register_msg = $request->session()->get('register_peserta_msg');
		
		
		$faqs = array();
		foreach($faq_raw as $f){
			
			$faqs[$f->group][] = array('q' => $f->question, 'a'=> $f->answer);
		}
		$data['is_registered_event'] = false;
		$data["memberInfo"] = Auth::user();
		if($data["memberInfo"] && $this->event_id){
			$rs_team_exists = Team::where('event_id', $this->event_id)->where('user_id', $data["memberInfo"]->id)->first();
			if($rs_team_exists){
				$data['is_registered_event'] = true;
			}
		}
		
		View::share('banners', $data["banners"]);
		View::share('pages',   $data["pages"]);
		View::share('judges',   $data["judges"]);
		View::share('register_msg',   $register_msg);
		View::share('allevent',   $data["allevent"]);
		View::share('allevent_banner',   $data["allevent_banner"]);
		View::share('event_id',   $this->event_id);
		View::share('faqs',   $faqs);
		View::share('memberInfo',   $data["memberInfo"]);
		View::share('is_registered_event',  $data['is_registered_event']);
		if($this->event_id){
			View::share('viewnya', "page");
			View::share('menunya', "pagemenu");
		}else{
			View::share('viewnya', "home");
			View::share('menunya', "mainmenu");
		}
		return 	view("{$this->template}.main.layout",$data);
	}
	
	function upcoming(Request $request)
	{
		
		$data = array();
		

		$login_msg = $request->session()->get('login_msg');
		$register_msg = $request->session()->get('register_peserta_msg');
		
		$data["memberInfo"] = Auth::user();
		
		
		
		
		$data["allevent"] =  Event::where('status','approved')->get();

		View::share('register_msg',   $register_msg);
		View::share('allevent', $data["allevent"]);
		View::share('viewnya', "upcoming");
		View::share('menunya', "mainmenu");
		View::share('memberInfo',   $data["memberInfo"]);
		
		return 	view("{$this->template}.main.layout",$data);
	}
	
	
	function index_post(Request $request)
	{
		$password 	= $request->input('password');
		$repass 	= $request->input('repass');
		$fullname 	= $request->input('fullname');
		$email		= $request->input('email');
		
		$teamname 	= $request->input('teamname');
		$teamaddress 	= $request->input('teamaddress');
		$appname 	= $request->input('appname');
		$appname 	= $request->input('appname');
		$appvideo 	= $request->input('appvideo');
		$memberInfo = Auth::user();
		$fileName   = "";

		$valid = true;
		
		if($password!=$repass){ $request->session()->flash('register_peserta_msg','Register failed, password not same');  $valid = false;}
		if(!isset($_FILES['appdoc']['name'])){ $request->session()->flash('register_peserta_msg','Register failed, document empty');$valid = false; }
		else{
			if($_FILES['appdoc']['name']){
				$path = base_path();
				$destinationPath = "/public/assets/upload/dokumen"; // upload path	
				$extension = $request->file('appdoc')->getClientOriginalExtension(); // getting image extension
				$fileName = rand(11111,99999).'.'.$extension; // renameing image
				//$request->file('appdoc')->move($destinationPath, $fileName);
				$request->appdoc->storeAs($destinationPath, $fileName);
			}
		}
		//if(!$_POST['appdoc']['name']){ $request->session()->flash('register_msg','Register failed, document empty'); }
		if($memberInfo){
			$rs_team_exists = Team::where('event_id', $this->event_id)->where('user_id', $memberInfo->id)->first();
			if($rs_team_exists){
				$request->session()->flash('register_peserta_msg','Register failed. You has registered this project'); 
				$valid = false;
			}
		}
		if($valid){
			$user = HKUser::where('email', $email)->first();
			if(!isset($user->email) || $memberInfo){
				$user_id = "";
				if(!$memberInfo){
					$user = new HKUser;
					$user->email = $email;
					$user->role_id = 2;
					$user->name = $fullname;
					$user->password = Hash::make($repass); 
					$user->status = 'pending';
					$user->save();
					$user_id  = $user->id;

					$hkuser = new User;
					$hkuser->id = $user_id;
					$hkuser->email = $email;
					$hkuser->fullname = $fullname;
					$hkuser->password = Hash::make($repass); 
					$hkuser->status = 'pending';
					$hkuser->save();
					
					$client_id = "mlwuPUTCg87DzTdEO58sO3BG1EMa";
					$client_secret = "SmqtMwDeEAJVze8d1QFsWPoWsxMa";
					$base64_key = base64_encode("{$client_id}:{$client_secret}");
					$mainapitoken = new ApiLog;
					$mainapitoken->url_input = "https://api.mainapi.net/token";
					$mainapitoken->paraminput = $base64_key;
					$mainapitoken->created_at = date("Y-m-d H:i:s");
					$mainapitoken->save();
					$result =  json_decode(exec('curl -k -d "grant_type=client_credentials" -H "Authorization: Basic '.$base64_key.'" https://api.mainapi.net/token'),true);
					
					$mainapitoken = ApiLog::where("id", $mainapitoken->id )->first();
					$mainapitoken->response = json_encode($result);
					$mainapitoken->updated_at = date("Y-m-d H:i:s");
					$mainapitoken->save();
					
					
				
					$ch = curl_init();
					$authorization = "Authorization: Bearer {$result['access_token']}";
					
					$postdata = array(     
						"email" => $email,     
						"password"  => $repass,     
						"fullname"  => $fullname   
					); 

					$curl_create = 'curl -X POST --header "Content-Type: application/x-www-form-urlencoded" --header "Accept: application/json" --header "Authorization: Bearer '.$result['access_token'].'" -d "email='.urlencode($email).'&password='.$repass.'&fullname='.urlencode($fullname).'" "https://api.mainapi.net/registrar/1.0.0/users"';
					
					$mainapitoken = new ApiLog;
					$mainapitoken->url_input = "https://api.mainapi.net/registrar/1.0.0/users";
					$mainapitoken->paraminput = json_encode(array('header'=>$authorization, 'body'=>$postdata, 'curl'=> $curl_create));
					$mainapitoken->created_at = date("Y-m-d H:i:s");
					$mainapitoken->save();
					
					$params = http_build_query($postdata, NULL, '&'); 
					$result = json_decode(exec($curl_create),true);
					/* curl_setopt($ch, CURLOPT_URL,"https://api.mainapi.net/registrar/1.0.0/users");
					curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_POSTFIELDS,$params);
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
					$result = curl_exec($ch);
					curl_close($ch);curl_setopt($ch, CURLOPT_URL,"https://api.mainapi.net/registrar/1.0.0/users");
					curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_POSTFIELDS,$params);
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
					$result = curl_exec($ch);
					curl_close($ch); */
					$mainapitoken = ApiLog::where("id", $mainapitoken->id )->first();
					$mainapitoken->response = json_encode($result);
					$mainapitoken->updated_at = date("Y-m-d H:i:s");
					$mainapitoken->save();
				}else{
					$user_id = $memberInfo->id;
					$email = $memberInfo->email;
					$fullname = $memberInfo->name;
				}
				$team = new Team;
				$team->user_id = $user_id;
				$team->nama = $teamname;
				$team->alamat = $teamaddress;
				$team->app_name = $appname;
				$team->dokumen =  "http://hack.id/assets/upload/dokumen/{$fileName}";
				$team->video_url = $appvideo;
				$team->status = 'accepted';
				$team->event_id = $this->event_id;
				$team->save();
				
				for($i=1;$i<=3;$i++){
					$membername 	= $request->input("member{$i}_name");
					$memberemail 	= $request->input("member{$i}_email");
					$memberphone 	= $request->input("member{$i}_phone");
					$member = new Member;
					$member->team_id = $team->id;
					$member->nama = $membername;
					$member->email = $memberemail;
					$member->phone = $memberphone;
					$member->save();
				}
				
				
				
				$event = Event::findOrFail($this->event_id);
				$encryptedurl = Crypt::encryptString(json_encode(array('event_id'=>$this->event_id, 'email'=> $email)));

				//$decrypted = Crypt::decryptString($encrypted);

				Mail::send("{$this->template}.register_notif", ['event' => $event, 'fullname' => $fullname, 'email'=> $email, 'encryptedurl' => $encryptedurl], function ($m) use ($event, $fullname, $email, $encryptedurl) {
					$m->from('support@hack.id', 'Support of Hack.id');

					$m->to($email, $fullname)->subject("Registrasi {$event->nama} Sukses!");
				});
				if($memberInfo){
					$request->session()->flash('register_peserta_msg','Register Success, Please check your project status');
				}else{
					$request->session()->flash('register_peserta_msg','Register Success, Please login to check your project status');
				}
			}else{
				$request->session()->flash('register_peserta_msg','Register failed, Email Exist'); 
			}
		}
		
		
		
		return redirect('/');
	}
	
	function aktivasi($encryptedurl, Request $request )
	{
		$jsonDec = Crypt::decryptString($encryptedurl);
		$data = json_decode($jsonDec, true);
		$user = HKUser::where('email', $data['email'])->first();
		$user->status = 'aktif';
		$user->save();

		$hkuser = User::where('email', $data['email'])->first();
		$hkuser->status = 'aktif';
		$hkuser->save();
		$request->session()->flash('register_peserta_msg','Activation Success'); 
		return redirect('/');
	}
	
}

?>