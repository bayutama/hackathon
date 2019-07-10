<div class="widget">

	
	<table id="datatable" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Hackathon Name</th>
					<th>Status</th>
					<th>Location</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php $i=1; 
			 if(!$teams) $teams = array();
			?>
			<?php foreach($teams as $ev): ?>
				<tr>
				  <td><?=$i?></td>
				  <td><?=$ev->event_name?></td>
				  <td><?=ucfirst($ev->status)?></td>
				  <td><?=$ev->location_name; ?></td>`
				  <td><a href="<?=url("member/project/{$ev->id}/detail")?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Detail</a> <a href="<?=url("member/project/{$ev->id}/delete")?>" class="btn btn-danger btn-sm" onclick="if(confirm('Delete this project?')){ return true; }else{ return false; }"><i class="fa fa-trash"></i> Delete</a></td>
				</tr>
			<?php $i++; ?>	
			<?php endforeach; ?>
	</table>
</div>