<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;

class project extends Model
{
    protected $fillable = [
        'title', 'category', 'info', 'thumb', 'client', 'type', 'size', 'live'
    ];

    public function project_images() {
        return $this->hasMany(\App\project_image::class);
    }

    public function category() {
        return $this->hasOne(\App\Category::class);
    }

    public function addImage($file) {


        $allowedfileExtension=['jpg','png', 'jpeg', 'JPG'];
        $filename = "[prj$this->id]" . $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $check = in_array($extension,$allowedfileExtension);

        if (in_array($extension,$allowedfileExtension)) {
            $file->move(public_path('images/project_images/'), $filename);
            $this->project_images()->create(['name' => $filename]);
        } else {
            return "Image upload fail.";
        }
    }


}
