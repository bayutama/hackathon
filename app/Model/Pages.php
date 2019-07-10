<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Pages extends Model
{
	use CrudTrait;
    //
	protected $table = 'hk_page';
	protected $connection = 'mysql';
	protected $fillable = ['event_id', 'nama', 'code', 'konten'];
	public $timestamps = true;

	public function event()
    {
        return $this->belongsto('App\Model\Event');
    }
}
