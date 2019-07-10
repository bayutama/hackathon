<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\PageCrudRequest as StoreRequest;
use App\Http\Requests\PageCrudRequest as UpdateRequest;

class PageCrudController  extends CrudController {
	public function setup() {
        $this->crud->setModel("App\Model\Pages");
        $this->crud->setRoute("admin/page");
        $this->crud->setEntityNameStrings('page', 'pages');

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
			'label' => "Konten",
			'name' => "konten",
			//'type' => 'tinymce'
			'type' => 'ckeditor',
			// optional:
			//'extra_plugins' => ['oembed', 'widget', 'justify']
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