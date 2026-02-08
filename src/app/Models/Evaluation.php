<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\EvaluationLevelEnum;

class Evaluation extends Model
{
    protected $fillable = [
        "student_id",
        "brief_id",
        "competence_id",
        "teacher_id",
        "submission_id",
        "level",
        "comment",
        "evaluated_at"
    ];


    protected function casts(): array
    {
        return [
            'level' => EvaluationLevelEnum::class,
            'evaluated_at' => 'datetime',
        ];
    }


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

    public function submission(){
        return $this->belongsTo(Submission::class);
    }
}
