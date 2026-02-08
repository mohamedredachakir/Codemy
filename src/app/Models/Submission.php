<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'student_id',
        'brief_id',
        'content',
        'submitted_at'
    ];


    public function student(){
        return $this->belongsTo(User::class, 'student_id');
    }

    public function brief(){
        return $this->belongsTo(Brief::class);
    }

    public function evaluations(){
        return $this->hasMany(Evaluation::class);
    }
}
