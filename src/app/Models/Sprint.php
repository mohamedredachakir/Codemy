<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sprint extends Model
{
    protected $fillable = [
        "name",
        "duration",
        "order"
    ];


    public function breif(){
        return $this->hasMany(Brief::class);
    }

    public function classes() {
        return $this->belongsToMany(SchoolClass::class, "class_sprint",
        'sprint_id',
        'class_id');
    }

    public function competences(){
        return $this->belongsToMany(Competence::class,"competence_sprint");
    }



}
