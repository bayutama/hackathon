<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Hackaton - Telkom Indonesia</title>

        <!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Quattrocento+Sans" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Poppins:500,600,300%7COpen+Sans:400,300,700" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
			
			.rslides {
			  position: relative;
			  list-style: none;
			  overflow: hidden;
			  width: 100%;
			  padding: 0;
			  margin: 0;
			}

			.rslides .wrapper {
			  -webkit-backface-visibility: hidden;
			  position: absolute;
			  display: none;
			  width: 100%;
			  left: 0;
			  top: 0;
			}

			.rslides div:first-child {
			  position: relative;
			  display: block;
			  float: left;
			  }

			.rslides img {
			  display: block;
			  height: auto;
			  float: left;
			  width: 100%;
			  border: 0;
			  }
			  .dvipbl input{
				  color:#000;
				  font-weight:bold;
			  }
			  .dvipbl textarea{
				  color:#000;
				  font-weight:bold;
			  }
        </style>

		<link rel="stylesheet" href="/assets/<?=$current_theme?>/css/bootstrap.min.css?<?=$CSS_VERSION?>"> 
		<link rel="stylesheet" href="/assets/<?=$current_theme?>/css/webkit.css?<?=$CSS_VERSION?>"> 
		<link rel="stylesheet" href="/assets/<?=$current_theme?>/css/font-awesome.css?<?=$CSS_VERSION?>"> 
		<link rel="stylesheet" href="/assets/<?=$current_theme?>/css/style.css?<?=$CSS_VERSION?>"> 
		<link rel="stylesheet" href="/assets/<?=$current_theme?>/css/jquery.bxslider.css?<?=$CSS_VERSION?>" >	
		<link rel="stylesheet" href="/assets/<?=$current_theme?>/css/animate.css?<?=$CSS_VERSION?>" >	
		<link rel="stylesheet" href="/assets/<?=$current_theme?>/css/owl.carousel.min.css?<?=$CSS_VERSION?>">
		<link rel="stylesheet" href="/assets/<?=$current_theme?>/css/owl.theme.default.min.css?<?=$CSS_VERSION?>">
		<link rel="stylesheet" href="/assets/<?=$current_theme?>/css/jquery-sticklr-1.4-light-color.css?<?=$CSS_VERSION?>">
		
    </head>
    <body>
		
	
		<!-- LOADER -->	
		<div id="loader-overflow">
		  <div id="loader3" class="loader-cont">Please enable JS</div>
		</div>	

		<div id="site-main">
				<?/*<ul id="sticky-social" class="sticklr">
					<li>
						<a href="#" class="icon-plus32" title="Create Hackathon">
							<ul>
								<li class="sticklr-title">
									<a href="<?=url('create/hackathon')?>">Create Hackathon</a>
								</li>
							</ul>
						</a>
					</li>
				</ul>*/?>				
				<header id="main-header">
					@component($current_theme.'.'.$menunya)
						<strong>Whoops!</strong> Something went wrong!
					@endcomponent
					 <!-- END header-wrapper -->
					  
				</header>
        
				<!-- COTENT CONTAINER -->
				<div class="main">
					@component($current_theme.'.'.$viewnya)
						<strong>Whoops!</strong> Something went wrong!
					@endcomponent
					 <!-- END content-wrapper -->
				</div>
				<!-- content-end -->
				
				<!-- footer-start -->
				<footer id="main-footer" class="container">
					<div class="wrapper text-center">
						<img src="/assets/<?=$current_theme?>/images/logov3.png?<?=$IMAGES_VERSION?>" alt="logo">
						<ul class="social-link">
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>					
							<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="#"><i class="fa fa-youtube"></i></a></li>
							<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
						</ul>
						<span>Powered by <a href="http://telkom.co.id/" target="_blank">Telkom Indonesia</a></span>
					</div>
				</footer>
				<!-- footer-end -->
		

		</div><!-- End Main -->	
		@component($current_theme.'.footer_js')
			<strong>Whoops!</strong> Something went wrong!
		@endcomponent
	
    </body>
</html>
