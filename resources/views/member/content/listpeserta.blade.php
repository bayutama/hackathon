<div class="widget">
	<table id="datatable" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Name</th>
					<th>Status</th>
					<th>Application Name</th>
					<th>Document</th>
					<th>Video</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php $i=1; ?>
			<?php foreach($rsPeserta as $rs): ?>
				<tr>
				  <td><?=$i?></td>
				  <td><?=$rs->nama?></td>
				  <td><?=$rs->status?></td>
				  <td><?=$rs->app_name; ?></td>
				  <td><a href="<?=$rs->document ?>" download> Download</a></td>
				  <td><?=$rs->video ?></td>
				  <td><a href="<?=url("member/event/participant/{$rs->id}/detail")?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Detail</a> <a href="<?=url("member/event/participant/{$rs->id}/accept")?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Accept</a> <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="$('#hackaton_form').attr('action','/member/event/participant/<?=$rs->id?>/reject');$('.msg_modal').modal();"><i class="fa fa-trash"></i> Reject</a></td>
				</tr>
			<?php $i++; ?>	
			<?php endforeach; ?>
	</table>
</div>

<div class="modal fade msg_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">Reject Reason</h4>
		</div>
		<div class="modal-body">
			<form action="<?=url("member/event/participant/{$rs->id}/reject")?>" role="form" class="form-horizontal" id="hackaton_form" name="hackaton_form" method="POST" enctype="multipart/form-data">
				{!! csrf_field() !!}
				<textarea class="form-control" name="msgreject" id="msgreject" rows="10"></textarea>
				<br/>
				<input type="hidden" name="peserta_id" id="peserta_id">
				<button class="btn btn-success btn-sm">Send</button> <button class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
			</form>
		</div>
    </div>
  </div>
</div>