<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\EventCrudRequest as StoreRequest;
use App\Http\Requests\EventCrudRequest as UpdateRequest;
use Illuminate\Support\Facades\DB;

class EventCrudController  extends CrudController {
	public function setup() {
        $this->crud->setModel("App\Model\Event");
        $this->crud->setRoute("admin/event");
        $this->crud->setEntityNameStrings('event', 'events');
		$this->crud->removeButton('create');
		$this->crud->addButtonFromModelFunction('line', 'open_google', 'getViewParticipant', 'beginning');
		$this->crud->setFromDb();
		//$this->crud->enableDetailsRow();
		
		$this->crud->addColumn([ // n-n relationship (with pivot table)
			'label' => "Created By", 
			'name' => "createdby",
			'type' => "model_function",
   			'function_name' => 'getCreatedBy'
        ]);
		
   		$this->crud->addColumn([ // n-n relationship (with pivot table)
			'label' => "Participant", // Table column heading
			'name' => "totalparticipants",
			'type' => "model_function",
   			'function_name' => 'getTotalParticipants'
        ]);

		$this->crud->addField([
			// MANDATORY
			'name'  => 'status', // DB column name (will also be the name of the input)
			'label' => 'Status', // the human-readable label for the input
			'type'  => 'select_from_array', // the field type (text, number, select, checkbox, etc)
			'options' => ['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected', 'deleted' => 'Deleted'],
		]);
		
    }

	public function store(StoreRequest $request)
	{
		return parent::storeCrud();
	}

	public function update(UpdateRequest $request)
	{
		$result = parent::updateCrud();
		if ($result) {
			$user = DB::table('users')
					->join('hk_event', 'users.id', '=', 'hk_event.user_id')
					->select('users.*')
					->where('hk_event.id',$request->input('id'))
					->get()[0];
			$fullname = $user->name;
			$email = $user->email;
			switch ($request->input('status')) {
				case 'pending' :
					$template = 'event_pending';
					$subject = 'Status Event Pending!';
				break;
				case 'approved' :
					$template = 'event_approved';
					$subject = 'Status Event Disetujui!';
				break;
				case 'rejected' :
					$template = 'event_rejected';
					$subject = 'Status Event Ditolak!';
				break;
				case 'deleted' :
					$template = 'event_deleted';
					$subject = 'Status Event Dihapus!';
				break;
				default :
					// expired
			}
			
			\Mail::send("member.{$template}", ['fullname' => $fullname, 'email'=> $email], function ($m) use ($fullname, $email, $subject) {
				$m->from('support@hack.id', 'Support of Hack.id');
				$m->to($email, $fullname)->subject($subject);
			});
		}
		
		return $result;
	}
}

?>