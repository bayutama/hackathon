<div class="widget">
	<div class="widget">
		<div class="widget-content-white glossed">
			<div class="padded">
			  
				<h3 class="form-title form-title-first"><i class="icon-th-list"></i> Participant Information</h3>
				<div class="form-group">
				  <label class="col-md-3 control-label">Name</label>
				  <div class="col-md-9">
					<?=$rsPeserta->nama?>
				  </div>
				</div>
				<div style="clear:both"></div>
				
				<div class="form-group">
				  <label class="col-md-3 control-label">Address</label>
				  <div class="col-md-9">
					<?=$rsPeserta->alamat?>
				  </div>
				</div>
				<div style="clear:both"></div>
				
				<div class="form-group">
				  <label class="col-md-3 control-label">Application Name</label>
				  <div class="col-md-9">
					<?=$rsPeserta->app_name?>
				  </div>
				</div>
				<div style="clear:both"></div>
				
				<div class="form-group">
				  <label class="col-md-3 control-label">Document</label>
				  <div class="col-md-9">
					<a href="<?=$rsPeserta->dokumen?>" download>Download</a>
				  </div>
				</div>
				<div style="clear:both"></div>
				
				<div class="form-group">
				  <label class="col-md-3 control-label">Video</label>
				  <div class="col-md-9">
					<a href="<?=$rsPeserta->video?>">Play</a>
				  </div>
				</div>
				<div style="clear:both"></div>
			</div>
		</div>
	</div>
</div>
