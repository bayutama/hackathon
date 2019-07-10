<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Illuminate\Support\Facades\DB;

class Event extends Model
{
	use CrudTrait;
    //
	protected $table = 'hk_event';
	protected $connection = 'mysql';
	protected $fillable = ['nama', 'slug', 'deskripsi', 'startdate', 'enddate', 'status'];
	public $timestamps = true;
	

	public function getTotalParticipantsAttribute() {
		$totalPeserta = DB::table('hk_team')->where('event_id', $this->id)->count();
		return $totalPeserta;
	}
	
	public function getLocationNameAttribute() {
		$totalPeserta = DB::table('region')->where('region_code', $this->location_id)->first();
		return (isset($totalPeserta->region)? $totalPeserta->region : "");
	}
	
	public function getDefaultBannerAttribute() {
		$banner = DB::table('hk_banner')->where('event_id', $this->id)->first();
		return $banner->url;
	}

	public function getCreatedByAttribute() {
		$user = DB::table('users')
					->join('hk_event', 'users.id', '=', 'hk_event.user_id')
					->select('users.*')
					->where('hk_event.id',$this->id)
					->get()[0];
		return $user->name;
	}

	public function getTotalParticipants()
	{
		return $this->fresh()->totalparticipants; // make sure you call fresh instance or you'll get an error that fullname is not found or something like that...
	}

	public function getCreatedBy()
	{
		return $this->fresh()->createdby; // make sure you call fresh instance or you'll get an error that fullname is not found or something like that...
	}

	public function getViewParticipant()
    {
        return '<a class="btn btn-xs btn-default" target="_blank" href="participant?event='.$this->id.'" data-toggle="tooltip" title="Get Participants"><i class="fa fa-search"></i> Participant</a>';
    }

	public function banner()
    {
        return $this->hasMany('App\Model\Banner');
    }

	public function team()
    {
        return $this->hasMany('App\Model\Team');
    }

	public function user()
    {
        return $this->belongsto('App\Model\User');
    }

	
	
}
