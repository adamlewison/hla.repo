<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class project_image extends Model
{
    protected $fillable = ['name'];

    public function project() {
        return $this->belongsTo(\App\project::class);
    }

    public static function getRandomImage($project_id = -1) {

        if ($project_id != -1) {
            $project = project::find($project_id);
            if ($project != null) {
                return $project->project_images->random();
            }
        }

        return parent::all()->random();

    }
}
