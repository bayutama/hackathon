<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Illuminate\Support\Facades\DB;

class Team extends Model
{
	use CrudTrait;
    //
	protected $table = 'hk_team';
	protected $connection = 'mysql';
	protected $fillable = ['nama', 'alamat', 'app_name', 'status'];
	public $timestamps = true;

	public function member()
    {
        return $this->hasMany('App\Model\Member');
    }

	public function user()
    {
        return $this->belongsto('App\Model\User');
    }

	public function team()
    {
        return $this->belongsto('App\Model\Team');
    }
	
	public function getEventNameAttribute() {
		$event = DB::table('hk_event')->where('id', $this->event_id)->first();
		return (isset($event->nama)? $event->nama : "");
	}
	
	public function getLocationNameAttribute() {
		$event = DB::table('hk_event')->where('id', $this->event_id)->first();
		$lokasi = "";
		if($event){
			$region = DB::table('region')->where('region_code', $event->location_id)->first();
			$lokasi = (isset($region->region)? $region->region : "");
		}
		
		return $lokasi;
	}
	
	public function getDownloadableLink() {
		if (!empty($this->id)) {
        	    return '<a href="'. $this->dokumen .'" target="_blank">Download</a>';
		} else {
            return 'No Document';
        }
    }

	public function getEmailUser() {
        if (!empty($this->id)) {
            $user = DB::table('users')->where('id', $this->user_id)->first();
            $user = json_decode(json_encode($user), true);
            return $user['email'];
        } 

        return '-';
    }
	
	public function getTimMember() {
        if (!empty($this->id)) {
            $member = DB::table('hk_member')->where('team_id', $this->id)->get();
            $member = json_decode(json_encode($member),true);
			$outs = "";
			foreach($member as $m){
				if(!$m['nama']) continue;
				$outs .= '<div style="margin-bottom:10px;font-size:12px;"><div>'.$m['nama'].'</div>';
				if($m['email']) $outs .= '<div><img src="/assets/images/63098-200.png" style="width:15px">  '.$m['email'].'</div>';
				if($m['phone']) $outs .= '<div><img src="/assets/images/phone-symbol-2.png" style="width:15px">  '.$m['phone'].'</div>';
				$outs .= '</div>';
			}
            return $outs;
        } 

        return '-';
    }

}
