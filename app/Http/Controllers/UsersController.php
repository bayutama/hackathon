<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Model\Banner;
use App\Model\Pages;
use App\Model\Judges;
use App\Model\HKUser;
use App\Model\Team;
use App\Model\Member;
use App\Model\Faq;
use App\Model\Event;
use App\Model\Region;
use App\Model\User;
use App\Model\ApiLog;
use Mail;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use File;

class UsersController  extends Controller {
	function __construct()
	{
		parent::__construct();
		$this->template = 'member';
		$this->event_id = 1;
	
	}

	function index(Request $request)
	{
		
		$data = array();
		
		$data["users"] = $userInfo = Auth::user();
		if(isset($userInfo->role_id)){
			if($userInfo->role_id==1) return redirect("/admin/dashboard");
		}
		View::share('currmenu', "home");
		View::share('viewnya', "welcome");
		View::share('userinfo', $data["users"]);
		View::share('subtitle', "Welcome");

		
		return 	view("{$this->template}.layout.mars",$data);
	}
	
	function event(Request $request)
	{
		
		$data = array();
		
		$data["users"]  = $userInfo  = Auth::user();
		if(isset($userInfo->role_id)){
			if($userInfo->role_id==1) return redirect("/admin/dashboard");
		}
		
		$data["events"] = Event::where('user_id', $data["users"]->id)->where('status', '<>', 'delete')->get();
		View::share('currmenu', "event");
		View::share('viewnya', "listevent");
		View::share('subtitle', "List Event");
		View::share('userinfo', $data["users"]);
		View::share('events', $data["events"]);
		

		
		return 	view("{$this->template}.layout.mars",$data);
		
	}	
	
	function createevent(Request $request)
	{
		
		$data = array();
		
		$data["users"] = $userInfo = Auth::user();
		if(isset($userInfo->role_id)){
			if($userInfo->role_id==1) return redirect("/admin/dashboard");
		}
		$data["region"] = Region::where('country_code',"ID")->get();
		
		$register_msg = $request->session()->get('event_msg');
		View::share('currmenu', "event");
		View::share('viewnya', "createevent");
		View::share('subtitle', "Create Event");
		View::share('userinfo', $data["users"]);
		View::share('register_msg', $register_msg );
		View::share('region', $data["region"] );

		
		return 	view("{$this->template}.layout.mars",$data);
		
	}
	
	function event_edit($event_id, Request $request)
	{
		
		$data = array();
		
		$data["users"] = $userInfo = Auth::user();
		if(isset($userInfo->role_id)){
			if($userInfo->role_id==1) return redirect("/admin/dashboard");
		}
		
		$data["region"] = Region::where('country_code',"ID")->get();
		$data["banners"] = Banner::where('event_id', $event_id)->get();
		$data["judges"] = Judges::where('event_id',  $event_id)->get();
		$data["pages"] = Pages::where('event_id',  $event_id)->get();
		$register_msg = $request->session()->get('event_msg');
		
		$event = Event::where("id", $event_id)->first();
		
		View::share('currmenu', "event");
		View::share('viewnya', "createevent");
		View::share('subtitle', "Edit Event");
		View::share('userinfo', $data["users"]);
		View::share('register_msg', $register_msg );
		View::share('eventInfo', $event );
		View::share('banners', $data["banners"] );
		View::share('judges',$data["judges"] );
		View::share('region', $data["region"]);
		View::share('pages', $data["pages"]);

		
		return 	view("{$this->template}.layout.mars",$data);
		
	}
	
	function event_hapus($event_id, Request $request)
	{
		
		$data = array();
		
		$data["users"] = $userInfo =  Auth::user();
		if(isset($userInfo->role_id)){
			if($userInfo->role_id==1) return redirect("/admin/dashboard");
		}
		
		$event = Event::where("id", $event_id)->where("user_id", $data["users"]->id)->update([ 'status' => 'delete']);

		
		$request->session()->flash('event_msg','Event has been deleted'); 
		return redirect('/member/event');
		
	}
	
	function editevent_post(Request $request){
		
		$userInfo = Auth::user(); 
		$event_id = $request->input("event_id");
		$startdate = explode("/",$request->input("startdate"));
		$enddate   = explode("/",$request->input("enddate"));
		$event = Event::where("id", $event_id)->where("user_id",$userInfo->id)->first();
		if(isset($event->id)){
			Event::where("id", $event_id)->where("user_id", $userInfo->id)->update([ 
				'nama' => $request->input("nama"),
				'deskripsi' => $request->input("deskripsi"),
				'startdate' => "{$startdate[2]}-{$startdate[1]}-{$startdate[0]}",
				'enddate' => "{$enddate[2]}-{$enddate[1]}-{$enddate[0]}",
				'location_id' =>  $request->input("location_id")
			]);
			
			Banner::where('event_id',  $event_id)->delete();
			Judges::where('event_id',  $event_id)->delete();
			Pages::where('event_id',  $event_id)->delete();
			Faq::where('event_id',  $event_id)->delete();
			
			$files_banner = array();
			if(isset($_FILES["banner_image"])) $files_banner = $_FILES["banner_image"];
			if(count($files_banner["name"]) > 0 ){
				$bannerd = $_POST["url"];
				for($i=0; $i<count($files_banner["name"]); $i++){
					if(!$files_banner["name"][$i]) continue;
					if(isset($files_banner["name"][$i])){
						$ext_expl = explode(".",$files_banner["name"][$i]);
						$filename = md5(time()).".".$ext_expl[count($ext_expl)-1];
						$bn_class = new Banner;
						$bn_class->event_id = $event->id;
						$bn_class->nama = $files_banner["name"][$i];
						
						$type_img = $files_banner["type"][$i];
						$data_banner = file_get_contents($files_banner["tmp_name"][$i]);
						$base64_banner = 'data:' . $type_img . ';base64,' . base64_encode($data_banner);
						$bn_class->url = $base64_banner;
						$bn_class->website = $bannerd[$i];
						$bn_class->save();
					}
				}
			}
			
			if(count($_POST['banner_image_hidden'])>0){
				for($i=0; $i<count($_POST['banner_image_hidden']); $i++){
					$bn_class = new Banner;
					$bn_class->event_id = $event->id;
					$bn_class->nama = $_POST['banner_image_hidden'][$i];
					
					$type_img = @mime_content_type($_POST['banner_image_hidden'][$i]);
					if(!$type_img){
						$ext_expl = explode(".",$_POST['banner_image_hidden'][$i]);
						$type_img = "image/".$ext_expl[count($ext_expl)-1];
					}
					$data_banner = file_get_contents($_POST['banner_image_hidden'][$i]);
					$base64_banner = 'data:' . $type_img . ';base64,' . base64_encode($data_banner);
					$bn_class->url = $base64_banner;
					$bn_class->website =  $_POST["url"][$i];
					$bn_class->save();	
				}
			}
			
			
			//judges upload
			$files_judges["name"] = array();
			if(isset($_FILES["judges_photo"])) $files_judges = $_FILES["judges_photo"];
			
			if(count($files_judges["name"]) > 0 ){
				$judges_name 		= $request->input("judges_name");
				$judges_description = $request->input("judges_description");
				$judges_fb 			= $request->input("judges_fb"); 
				$judges_twitter 	= $request->input("judges_twitter"); 
				$judges_linken 		= $request->input("judges_linken"); 
				for($i=0; $i<count($files_judges["name"]); $i++){		
					if(!$files_judges["name"][$i]) continue;
					if(isset($files_judges["name"][$i])){
						$ext_expl = explode(".",$files_judges["name"][$i]);
						$filename = md5(time()).".".$ext_expl[count($ext_expl)-1];
						$jd_class = new Judges;
						$jd_class->event_id = $event->id;
						$jd_class->nama = $judges_name[$i];
						//$jd_class->photo = "http://hack.id/assets/upload/judges/{$filename}";
						$jd_class->deskripsi = $judges_description[$i];
						$jd_class->fb = $judges_fb[$i];
						$jd_class->twitter = $judges_twitter[$i];
						$jd_class->linken = $judges_linken[$i];
						
						$type_img = $files_judges["type"][$i];
						$data_judges = file_get_contents($files_judges["tmp_name"][$i]);
						$base64_judges = 'data:' . $type_img . ';base64,' . base64_encode($data_judges);
						$jd_class->photo = $base64_judges;
					
						//@move_uploaded_file($files_judges["tmp_name"][$i],"/var/www/html/hackaton/public/assets/upload/judges/{$filename}");
						$jd_class->save();
					}
				}
			}
			$judges_photo_hidden = array();
			if(isset($_POST["judges_photo_hidden"])) $judges_photo_hidden = $_POST["judges_photo_hidden"];
			if(count($judges_photo_hidden)>0){
				$judges_name 		= $request->input("judges_name");
				$judges_description = $request->input("judges_description");
				$judges_fb 			= $request->input("judges_fb"); 
				$judges_twitter 	= $request->input("judges_twitter"); 
				$judges_linken 		= $request->input("judges_linken"); 
				for($i=0; $i<count($judges_photo_hidden); $i++){
					$bn_class = new Banner;
					$bn_class->event_id = $event->id;
					$bn_class->nama = $judges_photo_hidden[$i];
					
					$type_img = @mime_content_type($judges_photo_hidden[$i]);
					if(!$type_img){
						$ext_expl = explode(".",$judges_photo_hidden[$i]);
						$type_img = "image/".$ext_expl[count($ext_expl)-1];
					}
					$photo_judges = file_get_contents($judges_photo_hidden[$i]);
					$base64_judges = 'data:' . $type_img . ';base64,' . base64_encode($photo_judges);
					
					
					$jd_class = new Judges;
					$jd_class->event_id = $event->id;
					$jd_class->nama = $judges_name[$i];
					$jd_class->photo = $base64_judges;
					$jd_class->deskripsi = $judges_description[$i];
					$jd_class->fb = $judges_fb[$i];
					$jd_class->twitter = $judges_twitter[$i];
					$jd_class->linken = $judges_linken[$i];
					
					$jd_class->save();
				}
			}
			
			//Pages upload
			
			$page_name 	  = $request->input("page_name");
			$page_content = $request->input("pages_content_clean");
			
			$files_pages = array();
			if(isset($_FILES["pages_bg"])) $files_pages = $_FILES["pages_bg"];
			
			if(count($page_name) > 0 ){
				for($i=0; $i<count($page_name); $i++){			
					if(isset($page_name[$i])){
						
						
						$pg_class = new Pages;
						$pg_class->event_id = $event->id;
						$pg_class->nama = $page_name[$i];
						$pg_class->code = str_slug($page_name[$i]);
						$pg_class->konten = urldecode($page_content[$i]);
					
						if(isset($files_pages["name"][$i])){
							$ext_expl = explode(".",$files_pages["name"][$i]);
							$filename = md5(time()).".".$ext_expl[count($ext_expl)-1];
							@move_uploaded_file($files_pages["tmp_name"][$i],"/var/www/html/hackaton/public/assets/upload/judges/{$filename}");
							$pg_class->background_image = "http://hack.id/assets/upload/bgpages/{$filename}";
						}
						$pg_class->save();
					}
				}
			}
			$request->session()->flash('event_msg','Event has been updated, Please wait for approval'); 
		
		}else{
			$request->session()->flash('event_msg','Opps, Sorry. We not found this data'); 
		}
		return redirect('/member/event/'.$event_id.'/edit');
	}
	
	
	function createevent_post(Request $request)
	{
	
		$startdate = explode("/",$request->input("startdate"));
		$enddate   = explode("/",$request->input("enddate"));
		
		$userInfo = Auth::user(); 
		
		$event = new Event;
		$event->nama = $request->input("nama");
		$event->deskripsi = $request->input("deskripsi");
		$event->slug = str_slug($request->input("nama"));
		$event->startdate = "{$startdate[2]}-{$startdate[1]}-{$startdate[0]}";
		$event->enddate =   "{$enddate[2]}-{$enddate[1]}-{$enddate[0]}";
		$event->user_id = $userInfo->id;
		$event->location_id = $request->input("location_id");
		$event->save();
		
		
		//banner upload
		$files_banner = array();
		if(isset($_FILES["banner_image"])) $files_banner = $_FILES["banner_image"];
		
		if(count($files_banner["name"]) > 0 ){
			$bannerd = $_POST["url"];
			for($i=0; $i<count($files_banner["name"]); $i++){
				if(isset($files_banner["name"][$i])){
					$ext_expl = explode(".",$files_banner["name"][$i]);
					$filename = md5(time()).".".$ext_expl[count($ext_expl)-1];
					$bn_class = new Banner;
					$bn_class->event_id = $event->id;
					$bn_class->nama = $files_banner["name"][$i];
					//$bn_class->url = "http://hack.id/assets/upload/banners/{$filename}";
					
					$type_img = @mime_content_type($files_banner["tmp_name"][$i]);
					$data_banner = file_get_contents($files_banner["tmp_name"][$i]);
					$base64_banner = 'data:' . $type_img . ';base64,' . base64_encode($data_banner);
					$bn_class->url = $base64_banner;
					$bn_class->website = $bannerd[$i];
					
					//$bn_class->setUrl($files_banner["tmp_name"][$i]);
					//@move_uploaded_file($files_banner["tmp_name"][$i],"/var/www/html/hackaton/public/assets/upload/banners/{$filename}");
					$bn_class->save();
				}
			}
		}
		
		
		//judges upload
		$files_judges["name"] = array();
		if(isset($_FILES["judges_photo"])) $files_judges = $_FILES["judges_photo"];
		
		if(count($files_judges["name"]) > 0 ){
			$judges_name 		= $request->input("judges_name");
			$judges_description = $request->input("judges_description");
			$judges_fb 			= $request->input("judges_fb"); 
			$judges_twitter 	= $request->input("judges_twitter"); 
			$judges_linken 		= $request->input("judges_linken"); 
			for($i=0; $i<count($files_judges["name"]); $i++){			
				if(isset($files_judges["name"][$i])){
					$ext_expl = explode(".",$files_judges["name"][$i]);
					$filename = md5(time()).".".$ext_expl[count($ext_expl)-1];
					$jd_class = new Judges;
					$jd_class->event_id = $event->id;
					$jd_class->nama = $judges_name[$i];
					//$jd_class->photo = "http://hack.id/assets/upload/judges/{$filename}";
					$jd_class->deskripsi = $judges_description[$i];
					$jd_class->fb = $judges_fb[$i];
					$jd_class->twitter = $judges_twitter[$i];
					$jd_class->linken = $judges_linken[$i];
					
					$type_img = @mime_content_type($files_judges["tmp_name"][$i]);
					if($type_img){
						$data_judges = file_get_contents($files_judges["tmp_name"][$i]);
						$base64_judges = 'data:' . $type_img . ';base64,' . base64_encode($data_judges);
						$jd_class->photo = $base64_judges;
					}
					//@move_uploaded_file($files_judges["tmp_name"][$i],"/var/www/html/hackaton/public/assets/upload/judges/{$filename}");
					$jd_class->save();
				}
			}
		}
		
		//Pages upload
		
		$page_name 	  = $request->input("page_name");
		$page_content = $request->input("pages_content_clean");
		
		$files_pages = array();
		if(isset($_FILES["pages_bg"])) $files_pages = $_FILES["pages_bg"];
		
		if(count($page_name) > 0 ){
			for($i=0; $i<count($page_name); $i++){			
				if(isset($page_name[$i])){
					
					
					$pg_class = new Pages;
					$pg_class->event_id = $event->id;
					$pg_class->nama = $page_name[$i];
					$pg_class->code = str_slug($page_name[$i]);
					$pg_class->konten = urldecode($page_content[$i]);
				
					if(isset($files_pages["name"][$i])){
						$ext_expl = explode(".",$files_pages["name"][$i]);
						$filename = md5(time()).".".$ext_expl[count($ext_expl)-1];
						@move_uploaded_file($files_pages["tmp_name"][$i],"/var/www/html/hackaton/public/assets/upload/judges/{$filename}");
						$pg_class->background_image = "http://hack.id/assets/upload/bgpages/{$filename}";
					}
					$pg_class->save();
				}
			}
		}
		$request->session()->flash('event_msg','Event has been created, Please wait for approval'); 
		return redirect('/member/createhackathon');
	}
	
	
	
	function login(Request $request)
	{
		$data = array();
		$data["register_msg"] = $request->session()->get("member_msg");
		View::share('register_msg', $data["register_msg"] );
		return 	view("theme_red.main.login",$data);
	}
	
	function validateit(Request $request){
		$email = $request->input("email");
		$password = $request->input("password");
		if($email && $password){
			$user = HKUser::where('email', $email)->first();
			if($user){
				if($user->status!='aktif'){
					$request->session()->flash('member_msg','Please validate your account'); 
					return redirect()->guest('member/login');
				}
				if (Auth::attempt(['email' => $email, 'password' => $password])) {
					// Authentication passed...
					return redirect('/member/mainpage');
				}
			}
		}
		$request->session()->flash('member_msg','Login Failed'); 
		return redirect()->guest('member/login');
	}
	
	function signup(Request $request){

		$email = $request->input("email");
		$fullname = $request->input("fullname");
		$password = $request->input("password");
		$repass = $request->input("repass");
		if($password!=$repass){
			$request->session()->flash('member_msg','Password not same'); 
			return redirect('member/login');
		}
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$request->session()->flash('member_msg','Email not valid'); 
			return redirect('member/login');
		}
		$user = HKUser::where('email', $email)->first();
		if(!isset($user->email)){
			$user = new HKUser;
			$user->email = $email;
			$user->name = $fullname;
			$user->password = Hash::make($password);
			$user->status = 'pending';
			$user->role_id = 2;
			$user->save();
			$user_id  = $user->id;

			$hkuser = new User;
			$hkuser->id = $user_id;
			$hkuser->email = $email;
			$hkuser->fullname = $fullname;
			$hkuser->password = Hash::make($password);
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
			
			$encryptedurl = Crypt::encryptString(json_encode(array('email'=> $email)));

			//$decrypted = Crypt::decryptString($encrypted);

			Mail::send("{$this->template}.register_notif", ['fullname' => $fullname, 'email'=> $email, 'encryptedurl' => $encryptedurl], function ($m) use ($fullname,  $email, $encryptedurl) {
				$m->from('support@hack.id', 'Support of Hack.id');

				$m->to($email, $fullname)->subject("Registrasi Sukses!");
			});
			$request->session()->flash('member_msg','Register Success, please check your email'); 
		}else{
			$request->session()->flash('member_msg','Register failed, Email Exist'); 
		}
		return redirect('member/login');
		
		
	}
	
	function peserta($event_id, Request $request){
		
		$data = array();
		
		$data["users"] = $userInfo = Auth::user();
		
		if(isset($userInfo->role_id)){
			if($userInfo->role_id==1) return redirect("/admin/dashboard");
		}
		/* $data["region"] = Region::where('country_code',"ID")->get();
		$data["banners"] = Banner::where('event_id', $event_id)->get();
		$data["judges"] = Judges::where('event_id',  $event_id)->get();
		$data["pages"] = Pages::where('event_id',  $event_id)->get(); */
		$event = Event::where("id", $event_id)->where('user_id', $data["users"]->id )->first();
		$rs_peserta= array();
		if($event){
			$rs_peserta =  Team::where('event_id', $event->id)->get();
		
		
		}
		$register_msg = $request->session()->get('event_msg');
		View::share('currmenu', "event");
		View::share('viewnya', "listpeserta");
		View::share('subtitle', "Participants");
		View::share('userinfo', $data["users"]);
		View::share('rsPeserta', $rs_peserta);
		View::share('register_msg', $register_msg );

		
		return 	view("{$this->template}.layout.mars",$data);
	}
	
	
	function logout(Request $request){
		Auth::logout();
		return redirect('/member/login');
	}
	
	
	function aktivasi_member($encryptedurl, Request $request )
	{
		$jsonDec = Crypt::decryptString($encryptedurl);
		$data = json_decode($jsonDec, true);
		$user = HKUser::where('email', $data['email'])->first();
		$user->status = 'aktif';
		$user->save();

		$hkuser = User::where('email', $data['email'])->first();
		$hkuser->status = 'aktif';
		$hkuser->save();
		$request->session()->flash('member_msg','Activation Success, please login'); 
		return redirect('/member/login');
	}
	
	function pesertaaccept($peserta_id, Request $request )
	{
		$team = Team::where('id', $peserta_id)->first();
		$memberInfo = Auth::user();
		$event = Event::where("id", $team->event_id)->where('user_id', $memberInfo->id )->first();
		if($team){
			$team->status = 'accepted';
			$team->save();
			
			$user = HKUser::where("id", $team->user_id)->first();
			$fullname = $user->fullname;
			$email = $user->email;
			
			Mail::send("{$this->template}.content.peserta.accepted_notif", ['fullname' => $fullname, 'email'=> $email, 'event' => $event], function ($m) use ($fullname,  $email) {
					$m->from('support@hack.id', 'Support of Hack.id');

					$m->to($email, $fullname)->subject("Aplikasi disetujui!");
			});
				
			$request->session()->flash('member_msg','Success accepted'); 
		}else{
			$request->session()->flash('member_msg','Failed, participant not found'); 
		}
		return redirect("/member/event/{$team->event_id}/peserta");
	}
	
	function pesertareject($peserta_id, Request $request )
	{
		
		$comment = $request->input("msgreject");
		$team = Team::where('id', $peserta_id)->first();
		$memberInfo = Auth::user();
		$event = Event::where("id", $team->event_id)->where('user_id', $memberInfo->id )->first();

		if($team){
			$team->status = 'rejected';
			$team->comment = $comment;
			$team->save();
			
			$user = HKUser::where("id", $team->user_id)->first();
			$fullname = $user->fullname;
			$email = $user->email;
			
			Mail::send("{$this->template}.content.peserta.rejected_notif", ['fullname' => $fullname, 'email'=> $email, 'msg_rejected' => $comment, 'event' => $event ], function ($m) use ($fullname,  $email) {
					$m->from('support@hack.id', 'Support of Hack.id');

					$m->to($email, $fullname)->subject("Aplikasi ditolak!");
			});
				
			$request->session()->flash('member_msg','Rejected'); 
		}else{
			$request->session()->flash('member_msg','Failed, participant not found'); 
		}
		return redirect("/member/event/{$team->event_id}/peserta");
	}
	
	function pesertadetail($peserta_id, Request $request){
		
		$data = array();
		
		$memberInfo = Auth::user();
		
		$rs_peserta= array();
		$rs_peserta =  Team::where('id', $peserta_id)->first();
		
		$register_msg = $request->session()->get('event_msg');
		View::share('currmenu', "event");
		View::share('viewnya', "pesertadetail");
		View::share('subtitle', "Participants");
		View::share('userinfo', $memberInfo);
		View::share('rsPeserta', $rs_peserta);
		View::share('register_msg', $register_msg );

		
		return 	view("{$this->template}.layout.mars",$data);
	}
	
	function project(Request $request){
		
		$data = array();
		
		$memberInfo = $userInfo = Auth::user();
		if(isset($userInfo->role_id)){
			if($userInfo->role_id==1) return redirect("/admin/dashboard");
		}
		
		$data["teams"] = Team::where('user_id', $memberInfo->id )->where('status','!=' ,'deleted')->get();
		if(!$data["teams"]) $data["teams"] = array();
		
		$register_msg = $request->session()->get('event_msg');
		View::share('currmenu', "project");
		View::share('viewnya', "listprojects");
		View::share('subtitle', "Your Projects");
		View::share('userinfo', $memberInfo);
		View::share('teams', $data["teams"]);
		View::share('register_msg', $register_msg );

		
		return 	view("{$this->template}.layout.mars",$data);
	}
	
	function forget_password(Request $request){
		
		$data = array();
		$forget_msg = $request->session()->get('forget_msg');
		View::share('currmenu', "");
		View::share('forget_msg', $forget_msg );

		
		return 	view("theme_red.main.forgetpassword",$data);
	}
	
	function reset_password_form($encryptedurl, Request $request){
		
		$data = array();
		
		//$data = Crypt::decryptString($encryptedurl);
		$forget_msg = $request->session()->get('forget_msg');
		View::share('currmenu', "");
		View::share('encryptedurl',$encryptedurl);
		View::share('forget_msg', $forget_msg );

		
		return 	view("theme_red.main.reset_password_form",$data);
	}
	
	function reset_password_done($encryptedurl, Request $request){
		
		$data = array();
		
		$enc = json_decode(Crypt::decryptString($encryptedurl), true);
		$email = $request->input("email");
		$repass = $request->input("repass");
		
		$memberInfo = HKUser::where('email', $enc['email'])->first();
		if(strtotime($enc['expired'])>time()){
			$memberInfo->password = Hash::make($repass);
			$memberInfo->save();
			$request->session()->flash('member_msg','Reset success, please login'); 
		}else{
			$request->session()->flash('member_msg','Reset failed, session expire'); 
		}
		
			
		return redirect("/member/login");
	}
	
	function reset_password(Request $request){
		
		$data = array();
		$forget_msg = $request->session()->get('forget_msg');
		$email = $request->input("email");
		$memberInfo = HKUser::where('email', $email)->first();
		$encryptedurl = Crypt::encryptString(json_encode(array('email'=> $email,'expired'=>date("Y-m-d H:i:s", time()+3600))));
		$encryptedurl = "http://hack.id/member/reset/{$encryptedurl}";	
		$fullname = $memberInfo->name;
		Mail::send("member.resetpassword_notif", ['fullname' => $fullname, 'email'=> $email, "encryptedurl"=> $encryptedurl ], function ($m) use ($fullname,  $email) {
					$m->from('support@hack.id', 'Support of Hack.id');

					$m->to($email, $fullname)->subject("Reset password");
			});
		$request->session()->flash('member_msg','Reset success, please check your email'); 	
		return redirect("/member/login");
	}
	
	function project_detail($project_id, Request $request)
	{
		$data = array();
		
		$memberInfo = Auth::user();
		
		$data["project"] = Team::where('user_id', $memberInfo->id )->where("id", $project_id)->first();
		
		$register_msg = $request->session()->get('event_msg');
		View::share('currmenu', "project");
		View::share('viewnya', "formproject");
		View::share('subtitle', "Details Projects");
		View::share('userinfo', $memberInfo);
		View::share('project', $data["project"]);
		View::share('register_msg', $register_msg );

		
		return 	view("{$this->template}.layout.mars",$data);
	}
	
	function project_delete($project_id, Request $request)
	{
		$data = array();
		$memberInfo = Auth::user();
		$team = Team::where('user_id', $memberInfo->id )->where("id", $project_id)->first();
		$team->status = "deleted";
		$team->save();
		
		$request->session()->flash('member_msg','Delete success'); 	
		return redirect("/member/project");
	}
	
	function project_edit_post($project_id, Request $request)
	{
		$data = array();
		$memberInfo = Auth::user();
		$team = Team::where('user_id', $memberInfo->id )->where("id", $project_id)->first();
		$team->nama = $request->input("nama");
		$team->alamat = $request->input("alamat");
		$team->app_name = $request->input("app_name");
		$files_dokumen = array();
		if(isset($_FILES["dokumen"])) $files_dokumen = $_FILES["dokumen"];
		if(isset($files_dokumen["tmp_name"])){
			$ext_expl = explode(".",$files_dokumen["name"]);
			$filename = md5(time()).".".$ext_expl[count($ext_expl)-1];
			@move_uploaded_file($files_dokumen["tmp_name"],"/var/www/html/hackaton/public/assets/upload/dokumen/{$filename}");
			$team->dokumen = "http://hack.id/assets/upload/dokumen/{$filename}";
		}
		
		$team->video_url =  $request->input("video_url");
		$team->save();
		
		$request->session()->flash('member_msg','Delete success'); 	
		return redirect("/member/project");
	}
	
}

?>