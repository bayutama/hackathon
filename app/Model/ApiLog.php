<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Intervention\Image\Facades\Image;

class ApiLog extends Model
{
	use CrudTrait;
    //
	protected $table = 'api_log';
	protected $connection = 'mysql';
	public $timestamps = true;


}
