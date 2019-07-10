<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Model\Banner;
use App\Model\Pages;
use App\Model\Judges;
use App\Model\User;
use App\Model\HKUser;
use App\Model\Team;
use App\Model\Member;
use App\Model\Faq;
use App\Model\Event;
use Mail;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ApiController  extends Controller {
	function __construct()
	{
		parent::__construct();
		$this->template = getenv('TEMPLATE_THEME');
		$this->event_id = 1;
	
	}

	
	function openid($provider="", Request $request)
	{
		if(!$provider) $provider 		 = $request->input("src");
		$accessToken = $request->input("accessToken");
		
		switch($provider){
			case "fb" :
			case "facebook" : 
					$facebook = new \Facebook\Facebook([
						'app_id' => getenv('FB_APP_ID'),
						'app_secret' => getenv('FB_APP_SECRET'),
						'default_graph_version' => 'v2.9',
					]);
					$userInfo = $facebook->get('/me?fields=id,name,email', $accessToken);
					
					$userfb = $userInfo->getGraphUser();
					$email = addslashes($userfb->getEmail());		
					$name = addslashes($userfb->getName());		 	 
					$uid = $userfb->getId(); 	 
					$photo = "http://graph.facebook.com/{$uid}/picture?type=square"; 
					$out =  array("status" => "error",  "message" => "Token not valid or expired");
					if($userInfo && !$email){
						$out =  array("status" => "error",  "message" => "Please check your facebook setting");
					}else if($userInfo && $email){
						$out =  array("status" => "ok",  "message" => "");
					}
					break;
			case "google" : 
					$source = "google";

					$client = new \Google_Client();
					
					$client->setClientId(getenv("GOOGLE_APP_ID"));
					$client->setClientSecret( getenv('GOOGLE_APP_SECRET'));
					$userInfo = $client->verifyIdToken($accessToken);
					
					$email = $userInfo['email'];		
					$name  = $userInfo['name'];			
					$uid   = $userInfo['sub']; 	
					$photo = $userInfo['picture']; 	
					$out =  array("status" => "error",  "message" => "Token not valid or expired");
					if($userInfo){
						$out =  array("status" => "ok",  "message" => "");
					}
					break;
		}
		
		if($email){
			$user = HKUser::where('email', $email)->first();
			if(!isset($user->email)){
				$user =  new HKUser;
				$user->name = $name;
				$user->email = $email;
				$md5time = strtolower(base64_encode(md5(time())));
				$password = substr($md5time,0,5);
				$user->password = Hash::make($password);
				$user->save();
				
				Mail::send("{$this->template}.register_member_notif_noneed_actived", ['name' => $name, 'email'=> $email, 'password'=>$password], function ($m) use ($name, $email, $password) {
					$m->from('support@hack.id', 'Support of Hack.id');

					$m->to($email, $name)->subject("Registrasi di hack.id, Sukses!");
				});
			}
			Auth::setUser($user);
			//Auth::user()->setAttribute('key','value');
		}
		
		$out['debug'] = $userInfo;
		echo json_encode($out);
		exit;
	}
	
}

?>