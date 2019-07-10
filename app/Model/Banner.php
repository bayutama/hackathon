<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

class Banner extends Model
{
	use CrudTrait;
    //
	protected $table = 'hk_banner';
	protected $connection = 'mysql';
	protected $fillable = ['nama', 'type', 'url', 'deskripsi'];
	public $timestamps = true;

    public function event()
    {
        return $this->belongsto('App\Model\Event');
    }

	public function setUrlAttribute($value)
    {
        $attribute_name = "url";
        $disk = "uploads";
        $destination_path = "assets/upload/banners";

        // if the image was erased
        if ($value==null) {
            // delete the image from disk
            \Storage::disk($disk)->delete($this->image);

            // set null in the database column
            $this->attributes[$attribute_name] = null;
        }

        // if a base64 was sent, store it in the db
        if (starts_with($value, 'data:image'))
        {
            // 0. Make the image
            $image = Image::make($value);
            // 1. Generate a filename.
            $filename = md5($value.time()).'.jpg';
            // 2. Store the image on disk.
            \Storage::disk($disk)->put('/'.$filename, $image->stream());
            // 3. Save the path to the database
            $this->attributes[$attribute_name] = env('APP_URL') . '/' . $destination_path.'/' . $filename;
        }
    }

    public function getHackEvent() {
        $hackathon = DB::table('hk_event')->where('id', $this->event_id)->first();
        $hackathon = json_decode(json_encode($hackathon), true);
        return $hackathon['nama'];
    }

}
