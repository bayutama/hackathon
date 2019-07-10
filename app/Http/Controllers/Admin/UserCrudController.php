<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\UserCrudRequest as StoreRequest;
use App\Http\Requests\UserCrudRequest as UpdateRequest;
use Illuminate\Support\Facades\DB;
use App\Model\HKUser;

class UserCrudController  extends CrudController {
	public function setup() {
		$this->crud->setModel("App\Model\User");
		$this->crud->setRoute("admin/member");
		$this->crud->setEntityNameStrings('participant', 'participants');
		$this->crud->removeButton('create');
		$this->crud->setFromDb();
		
		$this->crud->addColumn([ // n-n relationship (with pivot table)
           'label'     => 'Team', 
		   'type' => "model_function",
        	'function_name' => 'getTeam',
        ]);

		$this->crud->addColumn([ // n-n relationship (with pivot table)
           'label'     => 'App Name', 
		   'type' => "model_function",
        	'function_name' => 'getAppName',
        ]);

		$this->crud->addColumn([ // n-n relationship (with pivot table)
           'label'     => 'Hackathon', 
		   'type' => "model_function",
        	'function_name' => 'getHackEvent',
        ]);

		$this->crud->addColumn([ // n-n relationship (with pivot table)
           'label'     => 'Document', 
		   'type' => "model_function",
        	'function_name' => 'getDownloadableLink',
        ]);

		//$this->crud->addButtonFromModelFunction('line','dokumen', 'getDownloadDokumen', 'beginning');

		$this->crud->addField([
			// MANDATORY
			'name'  => 'status', // DB column name (will also be the name of the input)
			'label' => 'Status', // the human-readable label for the input
			'type'  => 'select_from_array', // the field type (text, number, select, checkbox, etc)
			'options' => ['pending' => 'Pending', 'aktif' => 'Aktif', 'banned' => 'Banned'],
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
			$fullname = $request->input('fullname');
			$email = $request->input('email');
			switch ($request->input('status')) {
				case 'pending' :
					$template = 'participant_pending';
					$subject = 'Status Peserta Pending!';
				break;
				case 'aktif' :
					$template = 'participant_aktif';
					$subject = 'Status Peserta Aktif!';
				break;
				case 'banned' :
					$template = 'participant_banned';
					$subject = 'Status Peserta Banned!';
				break;
				default :
					// 
			}

			$user = HKUser::where('id', $request->input('id'))->first();
			$user->status = $request->input('status');
			$user->save();
			
			\Mail::send("member.{$template}", ['fullname' => $fullname, 'email'=> $email], function ($m) use ($fullname, $email, $subject) {
				$m->from('support@hack.id', 'Support of Hack.id');
				$m->to($email, $fullname)->subject($subject);
			});
		}
		
		return $result;
	}
}

?>