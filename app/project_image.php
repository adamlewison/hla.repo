<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class project_image extends Model
{
    protected $fillable = ['name'];
    public function project() {
        return $this->belongsTo(\App\project::class);
    }
}
