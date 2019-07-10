<div id="topsec" class="container above-fold parallax pr rslides">
		<?php foreach($allevent_banner as $banner): ?>
		<?php 
			//var_dump($banner);
			$slug = "javascript:void(0)";
			$bdesc = "";
			$bnama = "";
			if(@isset($banner->slug)) $slug = url("/{$banner->slug}");
			if(@isset($banner->deskripsi)) $bdesc =  $banner->deskripsi;
			if(isset($banner->nama)) $bnama = $banner->nama;
			if(!@isset($banner->default_banner)) continue;
		?>
		<div class="wrapper pr">
			<a href="<?=$slug?>" >
				<div class="col-7 md-col-10 above-fold-text">
					<?=$bdesc?>
				</div>					
				<img src="<?=$banner->default_banner?>" alt="<?=$bnama?>" style="width:100%;">
			</a>
		</div> 
		<?php endforeach; ?>
</div> <!-- above-fold -->
			
			<?/*
			<div class="col-md-12 nextevent" >
				<div class="col-md-12"><h2>Upcoming Events</h2></div>
				<?php foreach ($allevent as $alv): ?>
				<div class="col-sm-4" onclick="window.location='<?=url("/{$alv->slug}")?>';">
					<div class="thumbnail">
					  <div class="overlay">
						<i class="fa fa-share md"></i>
					  </div>
					  <img class="img-responsive" alt="a" src="<?=$alv->default_banner?>">
					</div>
					<div class="row">
					  <div class="col-md-3">
						<h3><span class="label label-info"><?=date("d F", strtotime($alv->startdate))?></span></h3>
					  </div>
					  <div class="col-md-9">
						  <strong><?=$alv->nama?></strong><br>
						  <em><?=$alv->deskripsi?></em><br>
					  </div>
					</div>
				</div>
				<?php endforeach; ?>
				
			</div>*/?>
			
<div class="container team-block-main parallax" id="upcoming">
	<div class="[ col-xs-12 col-sm-offset-2 col-sm-8 ]">
		<br/>
		<h1 style="color:#333;">Upcoming Hackathon</h1>
		<br/>
		<ul class="event-list">
			<?php foreach($allevent as $ev): ?>
			<li onclick="window.location='<?=url("/{$ev->slug}")?>';">
				<time datetime="2014-07-20">
					<span class="day"><?=date("d", strtotime($ev->enddate))?></span>
					<span class="month"><?=date("M", strtotime($ev->enddate))?></span>
					<span class="year"><?=date("Y", strtotime($ev->enddate))?></span>
					<span class="time">ALL DAY</span>
				</time>
				<?/*<img alt="<?=$ev->nama?>" src="<?=$ev->default_banner?>" />*/?>
				<div class="info">
					<h2 class="title" style="color:#333;float:left;width:75%;cursor:pointer;" ><?=$ev->nama?></h2>
					<?php if($ev->location_name): ?><a href="javascript:void(0)" style="float:right;width:24%;"><i class="fa fa-map-marker" aria-hidden="true"></i> <?=$ev->location_name?></a><?php endif;?>
					<div style="clear:both;"></div>
					<p class="desc" style="color:#333;"><?=$ev->deskripsi?></p>
				</div>
				<div class="social">
					<ul>
						<li class="facebook" style="width:33%;"><a href="<?=$ev->facebook?>"><span class="fa fa-facebook"></span></a></li>
						<li class="twitter" style="width:34%;"><a href="<?=$ev->twitter?>"><span class="fa fa-twitter"></span></a></li>
						<?/*<li class="google-plus" style="width:33%;"><a href="#google-plus"><span class="fa fa-google-plus"></span></a></li>*/?>
					</ul>
				</div>
			</li>
			<?php endforeach;?>
		</ul>
	</div>
</div>
			
