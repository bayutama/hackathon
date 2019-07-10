<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\FaqCrudRequest as StoreRequest;
use App\Http\Requests\FaqCrudRequest as UpdateRequest;

class FaqCrudController  extends CrudController {
	public function setup() {
        $this->crud->setModel("App\Model\Faq");
        $this->crud->setRoute("admin/faq");
        $this->crud->setEntityNameStrings('faq', 'faqs');

		$this->crud->setFromDb();
		
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