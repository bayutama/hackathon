<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\UserCrudRequest as StoreRequest;
use App\Http\Requests\UserCrudRequest as UpdateRequest;
use Illuminate\Support\Facades\DB;

class UserbyeventCrudController extends CrudController {
	public function setup() {
		$eventId = \Route::current()->parameter('event_id');
        $this->crud->setModel("App\Model\User");
        $this->crud->setRoute("admin/participant/by-event/". $eventId);
		$hackathon = DB::table('hk_event')->where('id', $eventId)->first();
        $hackathon = json_decode(json_encode($hackathon), true);
        $this->crud->setEntityNameStrings('participant', $hackathon['nama']);
		$this->crud->removeButton('create');
		$this->crud->addClause('join', 'hk_team', function($query) {  
			$eventId = \Route::current()->parameter('event_id');
			$query->on('hk_user.id', '=', 'hk_team.user_id')
				->where('hk_team.event_id', '=', $eventId);
		});
		$this->crud->setFromDb();
		
		$this->crud->addColumn([ // n-n relationship (with pivot table)
           'label'     => 'Team', // Table column heading
           'type'      => 'select_multiple',
           'name'      => 'team', 
           'entity'    => 'team', // the method that defines the relationship in your Model
           'attribute' => 'nama', // foreign key attribute that is shown to user
           'model'     => "app\Model\Team", // foreign key model
        ]);

		$this->crud->addColumn([ // n-n relationship (with pivot table)
           'label'     => 'App Name', // Table column heading
           'type'      => 'select_multiple',
           'name'      => 'team', 
           'entity'    => 'team', // the method that defines the relationship in your Model
           'attribute' => 'app_name', // foreign key attribute that is shown to user
           'model'     => "app\Model\Team", // foreign key model
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
		return parent::updateCrud();
	}

	public function getByEvent($event_id) {
		
	}
}

?>