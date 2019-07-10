<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login - hack.id</title>
		<meta name="google-signin-client_id" content="928596884418-lmd96cbh4h4vf1rkiudb5rtqn2ur6a97.apps.googleusercontent.com">

		<link rel="stylesheet" href="/assets/theme_red/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
		<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
		

        <!-- Styles -->
        <style>
			.login-box{
			  position:relative;
			  margin: 10px auto;
			  width: 500px;
			  height: 380px;
			  background-color: #fff;
			  padding: 10px;
			  border-radius: 3px;
				-webkit-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.33);
				-moz-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.33);
				box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.33);
				margin-top:10%;
			}
			.lb-header{
			  position:relative;
			  color: #00415d;
			  margin: 5px 5px 10px 5px;
			  padding-bottom:10px;
			  border-bottom: 1px solid #eee;
			  text-align:center;
			  height:28px;
			}
			.lb-header a{
			  margin: 0 25px;
			  padding: 0 20px;
			  text-decoration: none;
			  color: #666;
			  font-weight: bold;
			  font-size: 15px;
			  -webkit-transition: all 0.1s linear;
			  -moz-transition: all 0.1s linear;
			  transition: all 0.1s linear;
			}
			.lb-header .active{
			  color: #029f5b;
			  font-size: 18px;
			}
			.social-login{
			  position:relative;
			  float: left;
			  width: 100%;
			  height:auto;
			  padding: 10px 0 15px 0;
			  border-bottom: 1px solid #eee;
			}
			.social-login a{
			  position:relative;
			  float: left;
			  width:calc(45% - 8px);
			  text-decoration: none;
			  color: #fff;
			  border: 1px solid rgba(0,0,0,0.05);
			  padding: 12px;
			  border-radius: 2px;
			  font-size: 12px;
			  text-transform: uppercase;
			  margin: 0 3%;
			  text-align:center;
			}
			.social-login a i{
			  position: relative;
			  float: left;
			  width: 20px;
			  top: 2px;
			}
			.social-login a:first-child{
			  background-color: #49639F;
			}
			.social-login a:last-child{
			  background-color: #DF4A32;
			}
			.email-login,.email-signup{
			  position:relative;
			  float: left;
			  width: 100%;
			  height:auto;
			  margin-top: 20px;
			  text-align:center;
			}
			.u-form-group{
			  width:100%;
			  margin-bottom: 10px;
			}
			.u-form-group input[type="email"],
			.u-form-group input[type="text"],
			.u-form-group input[type="password"]{
			  width: calc(50% - 22px);
			  height:45px;
			  outline: none;
			  border: 1px solid #ddd;
			  padding: 0 10px;
			  border-radius: 2px;
			  color: #333;
			  font-size:0.8rem;
			  -webkit-transition:all 0.1s linear;
			  -moz-transition:all 0.1s linear;
			  transition:all 0.1s linear;
			}
			.u-form-group input:focus{
			  border-color: #358efb;
			}
			.u-form-group button{
			  width:50%;
			  background-color: #1CB94E;
			  border: none;
			  outline: none;
			  color: #fff;
			  font-size: 14px;
			  font-weight: normal;
			  padding: 14px 0;
			  border-radius: 2px;
			  text-transform: uppercase;
			}
			.forgot-password{
			  width:50%;
			  text-align: left;
			  text-decoration: underline;
			  color: #888;
			  font-size: 0.75rem;
			}
        </style>

		
		
    </head>
    <body style="background-color: #cecece;">
	
	 <div class="login-box" style="position:relative">
		<?/*<img src="/assets/<?=$current_theme?>/images/logov3.png?<?=$IMAGES_VERSION?>" alt="logo" style="width:300px;">*/?>
		<?php if(isset($register_msg)): ?>
			<div class="alert <?php if(strpos(strtolower($register_msg),"success")!==false): ?>alert-success<?php else:?>alert-danger<?php endif; ?> alert-dismissable" style="position:absolute;top:-60px;width:100%;left:0px;">
				<p><?=$register_msg?></p>
			</div>
		<?php endif; ?> 
		<div class="lb-header">
		  <a href="javascript:void(0)" class="active" id="login-box-link">Login</a>
		  <a href="javascript:void(0)" id="signup-box-link">Sign Up</a>
		</div>
		<div class="social-login">
			<a href="{{ url('/social/auth/facebook') }}" class="btn btn-facebook"><i class="fa fa-facebook"></i> Facebook</a>
			<a href="{{ url('/social/auth/google') }}" class="btn btn-google"><i class="fa fa-google"></i> Google</a>

		</div>
		
		<form class="email-login" name="loginform">	
		  <div class="u-form-group">
			<input type="email" placeholder="Email" name="email" style="font-size:12px;" />
		  </div>
		  <div class="u-form-group">
			<input type="password" placeholder="Password" name="password" style="font-size:12px;" />
		  </div>
		  <div class="u-form-group">
			<button class="g-recaptcha" data-sitekey="6LefTCgUAAAAALVNjhNVvcBCntixyAm-0KBQ4u2m" data-callback="loginProc">Log in</button>
		  </div>
		  <div class="u-form-group">
			<a href="javascript:void(0)" class="btn btn-warning" onclick="window.location=document.referrer;">Back to Hackathon</a>
		  </div>
		  <div class="u-form-group">
			<a href="/member/forget_password" class="forgot-password" style="font-size:12px;">Forgot password?</a>
		  </div>
		</form>
		<form class="email-signup" name="signform" method="POST" action="/member/signup">
		  <div class="u-form-group">
			<input type="email" placeholder="Email" name="email" style="font-size:12px;" />
		  </div>
		   <div class="u-form-group">
			<input type="text" placeholder="Full Name" name="fullname" style="font-size:12px;" />
		  </div>
		  <div class="u-form-group">
			<input type="password" placeholder="Password" name="password" style="font-size:12px;width:22%;" />
		 
			<input type="password" placeholder="Confirm" name="repass" style="font-size:12px;width:23%;">
		  </div>
		  <div class="u-form-group">
			<button onclick="signProc(); return false;">Sign Up</button>
		  </div>
		</form>
		{!! csrf_field() !!}
	  </div>
		
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>	
	<script src="https://apis.google.com/js/platform.js" async defer></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	
	<script>
		var perms = ['email','public_profile','user_friends'];
		var facebookLoginWindow;
		$(".email-signup").hide();
		$("#signup-box-link").click(function(){
		  $(".email-login").fadeOut(100);
		  $(".email-signup").delay(100).fadeIn(100);
		  $("#login-box-link").removeClass("active");
		  $("#signup-box-link").addClass("active");
		});
		$("#login-box-link").click(function(){
		  $(".email-login").delay(100).fadeIn(100);;
		  $(".email-signup").fadeOut(100);
		  $("#login-box-link").addClass("active");
		  $("#signup-box-link").removeClass("active");
		});
		
		var loginProc = function(){		
			var frm = document.loginform;
			$(frm).append("<input type='hidden' name='_token' value='"+ $('input[name="_token"]').val()+"'>");
			frm.action = "/member/validate";
			frm.method = "POST";
			frm.submit();
		};
		
		var signProc = function(){		
			var frm = document.signform;
			$(frm).append("<input type='hidden' name='_token' value='"+ $('input[name="_token"]').val()+"'>");
			frm.action = "/member/signup";
			frm.method = "POST";
			frm.submit();
		};
	</script>
	
	
	<script>
	  window.fbAsyncInit = function() {
		FB.init({
		  appId      : '<?=$FB_APP_ID?>',
		  cookie     : true,
		  xfbml      : true,
		  version    : 'v2.8'
		});
		FB.AppEvents.logPageView();   
	  };

	  (function(d, s, id){
		 var js, fjs = d.getElementsByTagName(s)[0];
		 if (d.getElementById(id)) {return;}
		 js = d.createElement(s); js.id = id;
		 js.src = "//connect.facebook.net/en_US/sdk.js";
		 fjs.parentNode.insertBefore(js, fjs);
	   }(document, 'script', 'facebook-jssdk'));
	   
	  /*  FB.getLoginStatus(function(response) {
			statusChangeCallback(response);
		}); */
		
		function checkLoginState() {
			FB.getLoginStatus(function(response) {
				if(!response ||  response==undefined) facebookLogin();
		  });
		}
		
		function checkFBLoginState(response){
			FB.getLoginStatus(function(response) {
				if(response.status=="not_authorized") facebookLogin();
				else if(response.status=="connected"){
					FB.api('/me?fields=name,id,email', function(rs) { 
						connectit({'userID':rs.id, 'accessToken': response.authResponse.accessToken, 'src': 'fb'});
					});
				}
		  });
			
		}
		
		function checkGoogleLoginState(googleUser){
			var profile = googleUser.getBasicProfile();
			connectit({'id': profile.getId(), 'accessToken': googleUser.getAuthResponse().id_token, 'src': 'google'});
		}
		
		function facebookLogin(){
			FB.login(function(response) {
			  if (response.status === 'connected') {
				FB.api('/me?fields=name,id,email', function(rs) {
					console.log(rs);
					connectit({'id':response.authResponse.userID, 'accessToken': response.authResponse.accessToken, 'src': 'fb'});
				});
			  } else {
				alert("Please allow our application to use Facebook");
			  }
			});	
		}
		
		function connectit(data){
			
				$.post("/api/openid",
					{
						src			: data.src,
						accessToken : data.accessToken
					},
					function(dt) {
						if(dt.status=="ok"){
							//setTimeout(function(){ window.location = "/member/mainpage"; },1000);
						}else{
							alert(dt.message);
						}
					},
					"json"
				);
			
		}
	</script>
		
	
    </body>
</html>
