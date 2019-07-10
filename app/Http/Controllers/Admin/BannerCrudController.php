<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\BannerCrudRequest as StoreRequest;
use App\Http\Requests\BannerCrudRequest as UpdateRequest;

class BannerCrudController  extends CrudController {
	public function setup() {
        $this->crud->setModel("App\Model\Banner");
        $this->crud->setRoute("admin/banner");
        $this->crud->setEntityNameStrings('banner', 'banners');

		$this->crud->setFromDb();

		$this->crud->addColumn([ // n-n relationship (with pivot table)
           'label'     => 'Hackathon', 
		   'type' => "model_function",
        	'function_name' => 'getHackEvent',
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

		$this->crud->addField([
			// MANDATORY
			'name'  => 'type', // DB column name (will also be the name of the input)
			'label' => 'Type', // the human-readable label for the input
			'type'  => 'number', // the field type (text, number, select, checkbox, etc)
			
			// OPTIONAL + example values
			'default'    => 1, // default value
			'hint'       => 'Input angka 1'
		]);
		$this->crud->addField([ // image
			'label' => "Image file",
			'name' => "url",
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