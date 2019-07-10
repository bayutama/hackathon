<?php
$namaevent = "";
$teamname = "";
$teamaddress = "";
$app_name = "";
$dokumen = "";
$video_url = "";
$comment = "";
$status = "";
$action = "/member/createproject";
if(isset($project)){
	$project_id = $project->id;
	$namaevent = $project->event_name;
	$teamname = $project->nama;
	$teamaddress 	= $project->alamat;
	$app_name 	= $project->app_name;
	$dokumen 	= $project->dokumen;
	$video_url 	= $project->video_url;
	$comment 	= $project->comment;
	$status 	= $project->status;
	
	$action = "/member/project/{$project_id}/edit";
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
		<form action="<?=$action?>" role="form" class="form-horizontal" name="project_form" method="POST" enctype="multipart/form-data">
		{!! csrf_field() !!}
		<div class="widget">
			<div class="widget-content-white glossed">
				<div class="padded">
				  
					<h3 class="form-title form-title-first"><i class="icon-th-list"></i> Project Details</h3>
					<div class="form-group">
					  <label class="col-md-3 control-label">Event Name</label>
					  <div class="col-md-9">
						<input type="text" name="namaevent" class="form-control" placeholder="Hackathon Name" value="<?=$namaevent?>" disabled>
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-md-3 control-label">Team Name</label>
					  <div class="col-md-9">
						<input type="text" name="nama" class="form-control" placeholder="Team Name" value="<?=$teamname?>" >
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-md-3 control-label">Team Address</label>
					  <div class="col-md-9">
						<textarea name="alamat" class="form-control" /><?=$teamaddress?></textarea>
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-md-3 control-label">Application Name</label>
					  <div class="col-md-9">
							<input type="text" name="app_name" class="form-control" placeholder="Application Name" value="<?=$app_name?>" >
					  </div>
					  
					</div>
					<div class="form-group">
						   <label class="col-md-3 control-label">Document</label>
						   <div class="col-md-7">
							<input type="file" name="dokumen" class="form-control" >
							<?php if($dokumen): ?>
								<a href="<?=$dokumen?>" download>Download</a>
							<?php endif; ?>
						   </div>
					</div>
					<div class="form-group">
					  <label class="col-md-3 control-label">Video URL</label>
					  <div class="col-md-9">
							<input type="text" name="video_url" class="form-control" placeholder="Video URL" value="<?=$video_url?>" >
					  </div>
					  
					</div>
					<div class="form-group">
					  <label class="col-md-3 control-label">Status</label>
					  <div class="col-md-9">
					    <?php if($status=='reject'): ?>
						<div class="alert alert-danger alert-dismissable">
							<?=ucfirst($status)?>
						</div>
						<?php elseif($status=='accepted'): ?>
						<div class="alert alert-success  alert-dismissable">
							<?=ucfirst($status)?>
						</div>
						<?php else: ?>
						<div class="alert alert-warning  alert-dismissable">
							<?=ucfirst($status)?>
						</div>
						<?php endif; ?>
					  </div>
					</div>
					<?php if($comment): ?>
					<div class="form-group">
					  <label class="col-md-3 control-label">Comment</label>
					  <div class="col-md-9">
							<textarea class="form-control" disabled /><?=$comment?></textarea>
					  </div>
					</div>
					<?php endif; ?>
					
				</div>
			
			</div>
		</div>
		
		
		
		<div class="col-md-12">
			<button type="submit" style="background-color:#27ae60;width:100%;" class="g-recaptcha"
									data-sitekey="6LefTCgUAAAAALVNjhNVvcBCntixyAm-0KBQ4u2m"
									data-callback="submitProject">Submit</button>
		</div>
		</form>
	</div>
	
</div>