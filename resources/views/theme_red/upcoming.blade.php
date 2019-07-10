<div class="container">
	<div class="row">
		<div class="[ col-xs-12 col-sm-offset-2 col-sm-8 ]">
			<br/>
			<h1 style="color:#333;">Upcoming Hackathon</h1>
			<br/>
			<ul class="event-list">
				<?php foreach($allevent as $ev): ?>
				<li onclick="window.location='<?=url("/{$ev->slug}")?>';">
					<time datetime="2014-07-20">
						<span class="day"><?=date("d", strtotime($ev->startdate))?></span>
						<span class="month"><?=date("F", strtotime($ev->startdate))?></span>
						<span class="year"><?=date("Y", strtotime($ev->startdate))?></span>
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
</div>			