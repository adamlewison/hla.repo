<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = ['name'];
    public function project() {
        return $this->hasMany(\App\project::class);
    }
}
