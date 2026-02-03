<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    protected $fillable = [
        'code',
        'label'
    ];

    public function sprints(){
        return $this->belongsToMany(Sprint::class,'competence_sprint');
    }

    public function evaluations(){
        return $this->hasMany(Evaluation::class);
    }
}
