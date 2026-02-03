<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable = [
        "student_id",
        "brief_id",
        "competence_id",
        "teacher_id",
        "level",
        "comment",
        "evaluated_at"
    ];


    protected $casts = [
        'level' => EvaluationLevelEnum::class
    ];


    public function student() {
        return $this->belongsTo(User::class, "student_id");
    }

    public function teacher(){
        return $this->belongsTo(User::class,"teacher_id");
    }

    public function brief() {
        return $this->belongsTo(Brief::class);
    }

    public function competence(){
        return $this->belongsTo(Competence::class);
    }
}
