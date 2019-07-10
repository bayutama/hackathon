<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Illuminate\Support\Facades\DB;

class User extends Model
{
    use CrudTrait;
	//
	protected $table = 'hk_user';
	protected $connection = 'mysql';
	protected $fillable = ['email', 'fullname', 'status'];
	public $timestamps = true;

	public function team()
    {
        return $this->hasMany('App\Model\Team');
    }

	public function event()
    {
        return $this->hasMany('App\Model\Event');
    }

    public function getTeam() {
        if (!empty($this->team[0])) {
            $hackathon = DB::table('hk_team')->where('id', $this->team[0]->id)->first();
            $hackathon = json_decode(json_encode($hackathon), true);
            return $hackathon['nama'];
        } elseif (!empty($this)) {
            $hackathon = DB::table('hk_team')->where('id', $this->id)->first();
            $hackathon = json_decode(json_encode($hackathon), true);
            if ($hackathon) 
                return $hackathon['nama'];
            else 
                return '-';
        }
    }

    public function getAppName() {
        if (!empty($this->team[0])) {
            $hackathon = DB::table('hk_team')->where('id', $this->team[0]->id)->first();
            $hackathon = json_decode(json_encode($hackathon), true);
            return $hackathon['app_name'];
        } elseif (!empty($this)) {
            $hackathon = DB::table('hk_team')->where('id', $this->id)->first();
            $hackathon = json_decode(json_encode($hackathon), true);
            if ($hackathon) 
                return $hackathon['app_name'];
            else 
                return '-';
        }
    }

    public function getHackEvent() {
        if (!empty($this->team[0])) {
            $hackathon = DB::table('hk_event')->where('id', $this->team[0]->event_id)->first();
            $hackathon = json_decode(json_encode($hackathon), true);
            return $hackathon['nama'];
        } elseif (!empty($this)) {
            $hackathon = DB::table('hk_event')->where('id', $this->event_id)->first();
            $hackathon = json_decode(json_encode($hackathon), true);
            if ($hackathon) 
                return $hackathon['nama'];
            else 
                return '-';
        }
    }

    public function getDownloadableLink() {
        // Replace proofAttach with the name of your field
		if (!empty($this->team[0]->dokumen)) {
        	    return '<a href="'. $this->team[0]->dokumen .'" target="_blank">Download</a>';
		} else if (!empty($this->dokumen)) {
        	    return '<a href="'. $this->dokumen .'" target="_blank">Download</a>';
		} else {
            return 'No Document';
        }
    }

}
