<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //
	protected $table = 'hk_member';
	protected $connection = 'mysql';
	protected $fillable = ['nama', 'email', 'phone'];
	public $timestamps = true;

	public function team()
    {
        return $this->belongsto('App\Model\Team');
    }
}
