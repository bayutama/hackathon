<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Intervention\Image\Facades\Image;

class Judges extends Model
{
	use CrudTrait;
    //
	protected $table = 'hk_judges';
	protected $connection = 'mysql';
	protected $fillable = ['event_id', 'nama', 'photo', 'deskripsi', 'fb', 'twitter', 'linken'];
	public $timestamps = true;

    public function event()
    {
        return $this->belongsto('App\Model\Event');
    }

	public function setPhotoAttribute($value)
    {
        $attribute_name = "photo";
        $disk = "judges";
        $destination_path = "assets/upload/judges";

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
}
