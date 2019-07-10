<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Faq extends Model
{
	use CrudTrait;
    //
	protected $table = 'hk_faq';
	protected $connection = 'mysql';
	protected $fillable = ['group', 'question', 'answer'];
	public $timestamps = true;
}
