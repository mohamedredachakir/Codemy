<?php

namespace App\Models;

use App\Enums\BriefTypeEnum;
use Illuminate\Database\Eloquent\Model;

class Brief extends Model
{
    protected $fillable = [
        "title",
        "description",
        "estimated_time",
        "type","sprint_id",
        "class_id",
        "teacher_id"
    ];


    protected $casts = [
        'type' => BriefTypeEnum::class,
    ];


    public function sprint(){
        return $this->belongsTo(Brief::class);
    }

    public function schoolclass(){
        return $this->belongsTo(Schoolclass::class, 'class_id');
    }

    public function teacher(){
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function submissions(){
        return $this->hasMany(Submission::class);
    }
    public function evaluations(){
        return $this->hasMany(Evaluation::class);
    }
}
