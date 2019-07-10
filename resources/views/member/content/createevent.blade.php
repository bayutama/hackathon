<?php
$nama = "";
$deskripsi = "";
$startdate = "";
$enddate = "";
$event_id = "";
$location_id = "";
$action = "/member/createhackathon";
if(isset($eventInfo)){
	$event_id = $eventInfo->id;
	$nama = $eventInfo->nama;
	$deskripsi = $eventInfo->deskripsi;
	$startdate_exp = explode("-",$eventInfo->startdate);
	$enddate_exp = explode("-",$eventInfo->enddate);
	$startdate = "{$startdate_exp[2]}/{$startdate_exp[1]}/{$startdate_exp[0]}";
	$enddate = "{$enddate_exp[2]}/{$enddate_exp[1]}/{$enddate_exp[0]}";
	$location_id = $eventInfo->location_id;
	$action = "/member/edithackathon";
}
?>
<div class="widget">
	<?php if(isset($register_msg)): ?>
		<?php if($register_msg): ?>
		<div class="alert alert-warning alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<i class="icon-exclamation-sign"></i> <strong><?=$register_msg?></strong> 
		</div>
		<?php endif; ?>
	<?php endif; ?>
	<div class="col-md-12">
		<form action="<?=$action?>" role="form" class="form-horizontal" name="hackaton_form" method="POST" enctype="multipart/form-data">
		{!! csrf_field() !!}
		<div class="widget">
			<div class="widget-content-white glossed">
				<div class="padded">
				  
					<h3 class="form-title form-title-first"><i class="icon-th-list"></i> Event Information</h3>
					<div class="form-group">
					  <label class="col-md-3 control-label">Title</label>
					  <div class="col-md-9">
						<input type="text" name="nama" class="form-control" placeholder="Hackathon Name" value="<?=$nama?>">
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-md-3 control-label">Description</label>
					  <div class="col-md-9">
						<textarea name="deskripsi" class="form-control" /><?=$deskripsi?></textarea>
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-md-3 control-label">Start Date</label>
					  <div class="col-md-9">
						<div class='input-group date' id='startdate_div'>
							<input type='text' class="form-control" name="startdate" id="startdate" value="<?=$startdate?>" />
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					  </div>
					  
					</div>
					<div class="form-group">
					  <label class="col-md-3 control-label">End Date</label>
					  <div class="col-md-9">
						<div class='input-group date' id='enddate_div'>
							<input type='text' class="form-control" name="enddate" id="enddate" value="<?=$enddate?>" />
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					  </div>
					  
					</div>
					<div class="form-group">
					  <label class="col-md-3 control-label">Location</label>
					  <div class="col-md-9">
						<select name="location_id" id="location_id" class="form-control" >
							<option value=""> --Please choose-- </option>
							<?php foreach($region as $rr): ?>
								<option value="<?=$rr->region_code?>" <?php if($location_id==$rr->region_code):?>selected<?php endif;?> > <?=$rr->region?> </option>
							<?php endforeach; ?>
						</select>
					  </div>
					  
					</div>
					
				</div>
			
			</div>
		</div>
		
		<div class="widget">
			<div class="widget-content-white glossed">
				<div class="padded">
					<div class="widget-controls pull-right">
                          <a href="javascript:void(0)" class="widget-link-remove" onclick="addbanner(); return false;">[<i class="icon-plus"></i>]</a>
                    </div>
					<h3 class="form-title form-title-first"><i class="icon-th-list"></i> Banner</h3>
					<div id="banner_div">
						<?php if(!isset($banners)): ?>
						<div class="form-group">
						   <label class="col-md-3 control-label">Image</label>
						   <div class="col-md-7">
							<input type="file" name="banner_image[]" class="form-control" >
						   </div>
						</div>
						<div class="form-group">
						   <label class="col-md-3 control-label">URL Click</label>
						   <div class="col-md-7">
								<input type="text" name="url[]" class="form-control" >
						   </div>
						</div>
						<?php else: ?>
							<?php foreach($banners as $banner): ?>
							<div>
								<div class="form-group">
								   <label class="col-md-3 control-label">Image</label>
								   <div class="col-md-7">
										<input type="file" name="banner_image[]" class="form-control" >
										<?php if($banner->url): ?>
										<img src="<?=$banner->url?>" style="width:100%" />
										<?php endif;?>
								   </div>
								   <div  class="col-md-2"> <a href="javascript:void(0)" class="widget-link-remove" onclick="removebanner(this); return false;">[<i class="icon-minus"></i>]</a></div>
								</div>
								<div class="form-group">
								   <label class="col-md-3 control-label">URL Click</label>
								   <div class="col-md-7">
										<input type="text" name="url[]" value="<?=$banner->website?>" class="form-control" >
								   </div>
								</div>
								<input type="hidden" name="banner_image_hidden[]" value="<?=$banner->url?>" />
							</div>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
					
					

				
				 
				</div>
			
			</div>
		</div>
		
		<div class="widget">
			<div class="widget-content-white glossed">
				<div class="padded">
					<div class="widget-controls pull-right">
                          <a href="javascript:void(0)" class="widget-link-remove" onclick="addJudges(); return false;">[<i class="icon-plus"></i>]</a>
                    </div>
					<h3 class="form-title form-title-first"><i class="icon-th-list"></i> Judges</h3>
					<div id="judges_div">
						<?php if(!isset($judges)): ?>
							<div class="form-group">
							   <label class="col-md-3 control-label">Name</label>
							   <div class="col-md-7">
									<input type="text" name="judges_name[]" class="form-control" >
							   </div>
							</div>
							<div class="form-group">
							   <label class="col-md-3 control-label">Photo</label>
							   <div class="col-md-7">
									<input type="file" name="judges_photo[]" class="form-control" >
							   </div>
							</div>
							<div class="form-group">
							  <label class="col-md-3 control-label">Description</label>
							  <div class="col-md-9">
								<textarea name="judges_description[]" class="form-control" /></textarea>
							  </div>
							</div>
							<div class="form-group">
							   <label class="col-md-3 control-label">FB</label>
							   <div class="col-md-7">
									<input type="text" name="judges_fb[]" class="form-control" >
							   </div>
							</div>
							<div class="form-group">
							   <label class="col-md-3 control-label">Twitter</label>
							   <div class="col-md-7">
									<input type="text" name="judges_twitter[]" class="form-control" >
							   </div>
							</div>
							<div class="form-group">
							   <label class="col-md-3 control-label">linked in</label>
							   <div class="col-md-7">
									<input type="text" name="judges_linken[]" class="form-control" >
							   </div>
							</div>
						<?php else: ?>
							<?php foreach($judges as $judge): ?>
							<div>
								<div class="form-group">
								   <label class="col-md-3 control-label">Name</label>
								   <div class="col-md-7">
										<input type="text" name="judges_name[]" class="form-control" value="<?=$judge->nama?>" >
								   </div>
								   <div  class="col-md-2"> <a href="javascript:void(0)" class="widget-link-remove" onclick="removeJudges(this); return false;">[<i class="icon-minus"></i>]</a></div>
								</div>
								<div class="form-group">
								   <label class="col-md-3 control-label">Photo</label>
								   <div class="col-md-7">
										<input type="file" name="judges_photo[]" class="form-control" >
										<?php if($judge->photo): ?>
										<img src="<?=$judge->photo?>" style="width:100%"  />
										<?php endif;?>
								   </div>
								</div>
								<div class="form-group">
								  <label class="col-md-3 control-label">Description</label>
								  <div class="col-md-9">
									<textarea name="judges_description[]" class="form-control" value="<?=$judge->deskripsi?>" /></textarea>
								  </div>
								</div>
								<div class="form-group">
								   <label class="col-md-3 control-label">FB</label>
								   <div class="col-md-7">
										<input type="text" name="judges_fb[]" class="form-control" value="<?=$judge->fb?>" >
								   </div>
								</div>
								<div class="form-group">
								   <label class="col-md-3 control-label">Twitter</label>
								   <div class="col-md-7">
										<input type="text" name="judges_twitter[]" class="form-control" value="<?=$judge->twitter?>" >
								   </div>
								</div>
								<div class="form-group">
								   <label class="col-md-3 control-label">linked in</label>
								   <div class="col-md-7">
										<input type="text" name="judges_linken[]" class="form-control" value="<?=$judge->linken?>">
								   </div>
								</div>
								<input type="hidden" name="judges_photo_hidden[]" value="<?=$judge->photo?>" >
							</div>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
					
					

				
				 
				</div>
			
			</div>
		</div>
		
		<div class="widget">
			<div class="widget-content-white glossed">
				<div class="padded">
					<div class="widget-controls pull-right">
                          <a href="javascript:void(0)" class="widget-link-remove" onclick="addPages(); return false;">[<i class="icon-plus"></i>]</a>
                    </div>
					<h3 class="form-title form-title-first"><i class="icon-th-list"></i> Pages</h3>
					<div id="pages_div">
						<?php if(!isset($pages)): ?>
							<div class="form-group">
							   <label class="col-md-3 control-label">Page Name</label>
							   <div class="col-md-7">
									<input type="text" name="page_name[]" class="form-control" >
							   </div>
							</div>
							
							<div class="form-group" style="display:none;">
							   <label class="col-md-3 control-label">Background Image</label>
							   <div class="col-md-7">
								<input type="file" name="pages_bg[]" class="form-control" >
							   </div>
							</div>
							
							<div class="form-group">
							   <label class="col-md-3 control-label">Content</label>
							   <div class="col-md-7">
									<div class="pages_content"></div>
							   </div>
							</div>
						<?php else: ?>
							<?php foreach($pages as $page): ?>
							<div>
								<div class="form-group">
								   <label class="col-md-3 control-label">Page Name</label>
								   <div class="col-md-7">
										<input type="text" name="page_name[]" class="form-control" value="<?=$page->nama?>">
								   </div>
								   <div  class="col-md-2"> <a href="javascript:void(0)" class="widget-link-remove" onclick="removePages(this); return false;">[<i class="icon-minus"></i>]</a></div>
								</div>
								
								<div class="form-group" style="display:none;">
								   <label class="col-md-3 control-label">Background Image</label>
								   <div class="col-md-7">
									<input type="file" name="pages_bg[]" class="form-control" >
								   </div>
								</div>
								
								<div class="form-group">
								   <label class="col-md-3 control-label">Content</label>
								   <div class="col-md-7">
										<div class="pages_content" id="pages_content_<?=str_slug($page->nama,'-')?>"></div>
								   </div>
								</div>
							</div>
							<?php endforeach; ?>
						<?php endif;?>
					</div>
					
					

				
				 
				</div>
			
			</div>
		</div>
		
		<div class="col-md-12">
			<button type="submit" style="background-color:#27ae60;width:100%;" class="g-recaptcha"
									data-sitekey="6LefTCgUAAAAALVNjhNVvcBCntixyAm-0KBQ4u2m"
									data-callback="submitEvent">Submit</button>
		</div>
		<input type="hidden" name="event_id" value="<?=$event_id?>" />
		</form>
	</div>
	
</div>