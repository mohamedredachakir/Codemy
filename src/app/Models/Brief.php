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
        "type",
        "sprint_id",
        "class_id",
        "teacher_id",
        "is_published"
    ];


    protected function casts(): array
    {
        return [
            'type' => BriefTypeEnum::class,
            'is_published' => 'boolean',
        ];
    }


    public function sprint(){
        return $this->belongsTo(Sprint::class);
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

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($brief) {
            if ($brief->submissions()->count() > 0 || $brief->evaluations()->count() > 0) {
                throw new \Exception("Cannot delete brief with existing submissions or evaluations.");
            }
        });
    }
}
