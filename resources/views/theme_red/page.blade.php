			<div id="topsec" class="container above-fold parallax pr rslides">
					<?php foreach($banners as $banner): ?>
					<div class="wrapper pr">
						<div class="col-7 md-col-10 above-fold-text">
							<?=$banner->deskripsi?>
						</div>					
						<img src="<?=$banner->url?>" alt="<?=$banner->nama?>" style="width:100%;cursor:pointer" onclick="window.location='<?=$banner->website?>';">
					</div>
					<?php endforeach; ?>
			</div> <!-- above-fold -->
			
			<?php /*
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
			<?php foreach($pages as $page): ?>
			<div id="<?=$page->code?>" class="container about-main">
				<div class="wrapper">
					<div class="title-block">
						<h2><?=$page->nama?></h2>
					</div>
					<div class="team-slider-main text-center">
						<?=$page->konten?>
					</div>
				</div>
			</div><!-- about-<?=$page->code?> -->
			<?php endforeach; ?>
			
			<?php if(count($judges)>0): ?>
			<div class="container team-block-main parallax" id="judges">
				<div class="wrapper">
					<div class="title-block">
						<h2>Judges</h2>
					</div>
					<div class="team-slider-main text-center">
						<ul class="thumbnails about-items">
							<?php foreach($judges as $judge): ?>
							<li class="col-md-4 center">
								<?/*<div class="pic-container-inner">
									<img src="<?=$judge->photo?>" alt="<?=$judge->nama?>" style="width:100%;"/>
									<span class="social-links">
										<a href="#"><i class="fa fa-twitter"></i></a>
										<a href="#"><i class="fa fa-facebook"></i></a>
										<a href="#"><i class="fa fa-linkedin"></i></a>
										<a href="#"><i class="fa fa-google-plus"></i></a>
									</span>
								</div>
								<div>
									<span class="name"><?=$judge->nama?></span><em class="role"><?=$judge->deskripsi?></em>
								</div>*/?>
								<div class="item">
									<!-- Team member image -->
									<img class="img-circle" src="<?=$judge->photo?>" alt="<?=$judge->nama?>" style="width:100%;">
									
									<!-- Team memeber details, activated on hover -->
									<div class="about-overlay img-circle">
										<div class="social-icons sicon-white">
											<a href="<?=$judge->fb?>" class="fa fa-facebook"><i></i></a>
											<a href="<?=$judge->twitter?>" class="fa fa-twitter"><i></i></a>
											<a href="<?=$judge->linken?>" class="fa fa-linkedin"><i></i></a>
										</div>
									</div>
									 <!-- Team member name and function -->
									<h5>
										<?=$judge->nama?><br/>
										<small><?=$judge->deskripsi?></small>
									</h5>
								</div>
							</li>
							<?php endforeach; ?>
							<div style="clear:both;"></div>
						</ul>
					</div>
				</div>
			</div>
			<?php endif; ?>
			
			<?php if($faqs): ?>
			<div class="container team-block-main parallax" id="faq">
				<div class="wrapper">
					<div class="title-block">
						<h2>FAQ</h2>
					</div>
					<div class="row text-left" style="margin-left:30px;;">

						<?php foreach($faqs as $faqGroup => $faqValue): ?>
							<div class="col-md-6">
							<h3><i class="fa fa-star" aria-hidden="true"></i> <?=$faqGroup?></h3>
							<?php foreach($faqValue as $faq): ?>
							<div class="animated fadeInLeft wow animated" data-wow-delay=".1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
								<h4 class="question" data-wow-delay=".1s"><?=$faq['q']?></h4>
								<p class="answer"><i class="fa fa-quote-left" aria-hidden="true"></i> <?=$faq['a']?> <i class="fa fa-quote-right" aria-hidden="true"></i></p>
							</div>
							<?php endforeach; ?>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
			<?php endif; ?>
			
			<div class="container team-block-main parallax" id="register">
				<div class="wrapper">
					<div class="title-block">
						<h2>Register</h2>
					</div>
					<div class="row text-left" style="margin-left:30px;;">
						<?php if(!$is_registered_event): ?>
						<div class="stepwizard col-md-offset-3">
								<div class="stepwizard-row setup-panel">
								<?php if(!$memberInfo): ?>	
								  <div class="stepwizard-step">
									<a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
									<p>Step 1</p>
								  </div>
								  <div class="stepwizard-step">
									<a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
									<p>Step 2</p>
								  </div>
								  <div class="stepwizard-step">
									<a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
									<p>Step 3</p>
								  </div>
								   <div class="stepwizard-step">
									<a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
									<p>Step 4</p>
								  </div>
								   <div class="stepwizard-step">
									<a href="#step-finish" type="button" class="btn btn-default btn-circle" disabled="disabled">Finish</a>
									<p>Finish</p>
								  </div>
								  <?php else: ?>
								  <div class="stepwizard-step">
									<a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled" id="a-step-2">1</a>
									<p>Step 1</p>
								  </div>
								  <div class="stepwizard-step">
									<a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
									<p>Step 2</p>
								  </div>
								   <div class="stepwizard-step">
									<a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
									<p>Step 3</p>
								  </div>
								   <div class="stepwizard-step">
									<a href="#step-finish" type="button" class="btn btn-default btn-circle" disabled="disabled">Finish</a>
									<p>Finish</p>
								  </div>
								  <?php endif; ?>
								</div>
							  </div>
							  
							  <form role="form" action="" method="post" style="margin-top:20px;" enctype="multipart/form-data">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<?php if(!$memberInfo): ?>
								<div class="row setup-content" id="step-1">
								  <div class="col-xs-6 col-md-offset-3">
									<div class="col-md-12 dvipbl">
									  <div class="form-group">
										<label class="control-label">FullName</label>
										<input  maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Full Name"  id="fullname" name="fullname" />
									  </div>
									  <div class="form-group">
										<label class="control-label">Email</label>
										<input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Email" id="email" name="email"  />
									  </div>
									  <div class="form-group col-xs-12 col-md-6" style="margin-left:0px;padding-left:0px;">
										<label class="control-label">Password</label>
										<input maxlength="100" type="password" required="required" class="form-control" placeholder="Enter Password" id="password" name="password"  />
									  </div>
									   <div class="form-group col-xs-12 col-md-6" style="margin-left:0px;padding-left:0px;">
										<label class="control-label">Retype</label>
										<input maxlength="100" type="password" required="required" class="form-control" placeholder="Retype Password" id="repass" name="repass"  />
									  </div>
									  <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
									</div>
								  </div>
								</div>
								<?php endif; ?>
								<div class="row setup-content dvipbl" id="step-2">
								  <div class="col-xs-6 col-md-offset-3">
									<div class="col-md-12">
									  
									  <div class="form-group">
										<label class="control-label">Team Name</label>
										<input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Team Name" id="teamname" name="teamname" />
									  </div>
									  <div class="form-group">
										<label class="control-label">Team Address</label>
										<textarea class="form-control" id="teamaddress" name="teamaddress"></textarea>
									  </div>
									   <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
									</div>
								  </div>
								  
								 
								</div>
								<div class="row setup-content dvipbl" id="step-3">
								  <div class="col-xs-10 col-md-offset-1">
									<div class="col-md-12">
									 
									  <div class="col-xs-10 col-md-offset-2">
										<div class="col-md-4">
											  <div class="form-group">
												<label class="control-label">Name Member 1</label>
												<input maxlength="200" type="text" class="form-control" placeholder="Enter Name" id="member1_name" name="member1_name" />
											  </div>
											  <div class="form-group">
												<label class="control-label">Email Member 1 </label>
												<input maxlength="200" type="text" class="form-control" placeholder="Enter Email Address" id="member1_email" name="member1_email" />
											  </div>
											  <div class="form-group">
												<label class="control-label">Phone Member 1 </label>
												<input maxlength="200" type="text" class="form-control" placeholder="Enter Phone" id="member1_phone" name="member1_phone" />
											  </div>
										</div>
										<div class="col-md-4">
											  <div class="form-group">
												<label class="control-label">Name Member 2</label>
												<input maxlength="200" type="text" class="form-control" placeholder="Enter Name" id="member2_name" name="member2_name" />
											  </div>
											  <div class="form-group">
												<label class="control-label">Email Member 2 </label>
												<input maxlength="200" type="text" class="form-control" placeholder="Enter Email Address" id="member2_email" name="member2_email"  />
											  </div>
											  <div class="form-group">
												<label class="control-label">Phone Member 2 </label>
												<input maxlength="200" type="text" class="form-control" placeholder="Enter Phone" id="member2_phone" name="member2_phone"  />
											  </div>
										</div>
										<div class="col-md-4">
											  <div class="form-group">
												<label class="control-label">Name Member 3</label>
												<input maxlength="200" type="text" class="form-control" placeholder="Enter Name" id="member3_name" name="member3_name" />
											  </div>
											  <div class="form-group">
												<label class="control-label">Email Member 3 </label>
												<input maxlength="200" type="text" class="form-control" placeholder="Enter Email Address"  id="member3_email" name="member3_email" />
											  </div>
											  <div class="form-group">
												<label class="control-label">Phone Member 3 </label>
												<input maxlength="200" type="text" class="form-control" placeholder="Enter Phone"  id="member3_phone" name="member3_phone" />
											  </div>
										</div>
									  </div>
									   <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
									</div>
								  </div>
								</div>
								<div class="row setup-content dvipbl" id="step-4">
								  <div class="col-xs-6 col-md-offset-3">
									<div class="col-md-12">
									 
									   <div class="form-group">
										<label class="control-label">Application Name</label>
										<input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Application Name" id="appname" name="appname" />
									  </div>
									  <div class="form-group">
										<label class="control-label">Proposal Document</label>
										<input  type="file" class="form-control" placeholder="Enter Team Address" id="appdoc" name="appdoc" />
									  </div>
									   <div class="form-group">
										<label class="control-label">Youtube URL</label>
										<input  maxlength="200" type="text"  class="form-control" placeholder="Enter Youtube Url" id="appvideo" name="appvideo" />
									  </div>
									   <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
									</div>
								  </div>
								</div>
								<div class="row setup-content" id="step-finish">
								  <div class="col-xs-6 col-md-offset-3">
									<div class="col-md-12">
									  <h3> Finish</h3>
									  <h4>Congratulations, your team is one step closer to registered in Hackathon IoT Telkom</h4>
									  <h3>Submit NOW</h3>
									  <button class="btn btn-success btn-lg pull-right" type="submit">Submit</button>
									</div>
								  </div>
								</div>
								
							  </form>	

					<?php else: ?>
						<div class="col-xs-12 col-md-12" align="center">
							<div class="col-xs-6 col-md-6" style="float:none;margin:auto;">
								<div class="alert alert-success" role="alert">
									<strong>Well done!</strong> You successfully registered this project. Please check <a href="/member/mainpage">your account</a>
								</div>
							</div>
						</div>
					<?php endif;?>
					</div>
				</div>
			</div>