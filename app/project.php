<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;

class project extends Model
{
    protected $fillable = [
        'title', 'category', 'info', 'thumb', 'client', 'type', 'size'
    ];

    public function project_images() {
        return $this->hasMany(\App\project_image::class);
    }

    public function addImage($file) {


        $allowedfileExtension=['jpg','png', 'jpeg'];
        $filename = "[prj$this->id]" . $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $check = in_array($extension,$allowedfileExtension);

        if (in_array($extension,$allowedfileExtension)) {
            $file->move(public_path('images'), $filename);
            $this->project_images()->create(['name' => $filename]);
        } else {
            return view('project_images.addNew')->withErrors(["file"=>"Your custom error message!"]);
        }


    }
}
