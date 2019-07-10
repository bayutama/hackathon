<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\JudgeCrudRequest as StoreRequest;
use App\Http\Requests\JudgeCrudRequest as UpdateRequest;

class JudgeCrudController  extends CrudController {
	public function setup() {
        $this->crud->setModel("App\Model\Judges");
        $this->crud->setRoute("admin/judge");
        $this->crud->setEntityNameStrings('judge', 'judges');

		$this->crud->setFromDb();
		$this->crud->addColumn([ // n-n relationship (with pivot table)
			'label' => "Event", // Table column heading
			'type' => "select_multiple",
			'name' => 'event', // the method that defines the relationship in your Model
			'entity' => 'event', // the method that defines the relationship in your Model
			'attribute' => "nama", // foreign key attribute that is shown to user
			'model' => "App\Model\Event", // foreign key model
        ]);

		$this->crud->addField([ // n-n relationship (with pivot table)
			'label' => "Event", // Table column heading
			'type' => "select",
			'name' => 'event_id', // the method that defines the relationship in your Model
			'entity' => 'event', // the method that defines the relationship in your Model
			'attribute' => "nama", // foreign key attribute that is shown to user
			'model' => "App\Model\Event", // foreign key model
			//'pivot' => true,
        ]);
		$this->crud->addField([ // image
			'label' => "Photo",
			'name' => "photo",
			'type' => 'image',
			'upload' => true,
			'crop' => false, // set to true to allow cropping, false to disable
			'aspect_ratio' => 1, // ommit or set to 0 to allow any aspect ratio
			//'prefix' => env('APP_URL') . '/assets/upload/banners/' // in case you only store the filename in the database, this text will be prepended to the database value
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
}

?>