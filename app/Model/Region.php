<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Region extends Model
{
	use CrudTrait;
    //
	protected $table = 'region';
	protected $connection = 'mysql';
	protected $fillable = [];
	public $timestamps = true;
}

