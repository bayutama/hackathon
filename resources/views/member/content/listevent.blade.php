<div class="widget">
	<?/*<div class="alert alert-warning alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<i class="icon-exclamation-sign"></i> <strong>Hi, <?=$userinfo->name?>!</strong> 
		<p>You can create event own hackaton here.</p>
	</div>*/?>
	<div style="margin-bottom:10px;text-align:right;">
		<a class="btn btn-primary" href="<?=url("member/createhackathon")?>" style="background-color:#27ae60;">Create Hackathon</a>
	</div>
	<table id="datatable" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Name</th>
					<th>Status</th>
					<th>Participants</th>
					<th>Start Date</th>
					<th>End Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php $i=1; ?>
			<?php foreach($events as $ev): ?>
				<tr>
				  <td><?=$i?></td>
				  <td><?=$ev->nama?></td>
				  <td><?=$ev->status?></td>
				  <td><?=$ev->total_participants; ?></td>
				  <td><?=date("d F Y", strtotime($ev->startdate)) ?></td>
				  <td><?=date("d F Y", strtotime($ev->enddate)) ?></td>
				  <td><a href="<?=url("member/event/{$ev->id}/peserta")?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> List Participant</a> <a href="<?=url("member/event/{$ev->id}/edit")?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a> <a href="<?=url("member/event/{$ev->id}/hapus")?>" class="btn btn-danger btn-sm" onclick="if(confirm('Delete event <?=@$ev->nama; ?>?')){ return true; }else{ return false; }"><i class="fa fa-trash"></i> Delete</a></td>
				</tr>
			<?php $i++; ?>	
			<?php endforeach; ?>
	</table>
</div>