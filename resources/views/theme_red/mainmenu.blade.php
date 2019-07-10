<div class="container">
	<div class="wrapper">
		<div class="row bgred">
			<div id="pagePeel" style="z-index:999999"></div>
			<div class="logo-main col-2" style="text-align:center">
				<?/*<a href="/"><img src="/assets/<?=$current_theme?>/images/logo.png?v=<?=$IMAGES_VERSION?>" alt="img"></a>*/?>
				<a href="/"><img src="/assets/<?=$current_theme?>/images/logov3.png?<?=$IMAGES_VERSION?>" alt="img"></a>
			</div>
			<div class="col-10 text-left bgred">
				<div class="responsive-menu-btn"><i><b></b><b></b><b></b></i><span></span></div>
				<nav id="main-menu">
					<ul class="main-top-menu">
						<li><a class="menutop" href="<?=url("/")?>" onclick="window.location='<?=url("/")?>';">Home</a></li>
						<li><a class="menutop" href="#upcoming">Upcoming Events</a></li>
						<li class="download" ><a class="menutop" href="<?=url("/create/hackathon")?>" onclick="window.location='<?=url("/create/hackathon")?>';">Create Hackathon</a></li>
						<?php if($memberInfo): ?>
						<li ><a class="menutop" href="/member/mainpage" onclick="window.location='<?=url("/member/mainpage")?>';">My Account</a></li>
						<?php else: ?>
						<li ><a class="menutop" href="/member/mainpage" onclick="window.location='<?=url("/member/mainpage")?>';"><i class="fa fa-user" aria-hidden="true"></i> Sign in</a></li>
						<?php endif;?>
					</ul>
				</nav>
			</div>
		</div>
	</div>
</div>