<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class HKUser extends Model implements Authenticatable
{
    use CrudTrait;
    use AuthenticableTrait;
	//
	protected $table = 'users';
	protected $connection = 'mysql';
	protected $fillable = [ 'name', 'email', 'password', 'provider', 'provider_id'];
	public $timestamps = true;
	
	/* function getAuthIdentifierName(){}
	function getAuthIdentifier(){}
	function getAuthPassword(){}
	function getRememberToken(){}
	function setRememberToken($value){}
	function getRememberTokenName(){} */

}
