<?php

namespace App\Models;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function students(){
        return $this->hasMany(User::class, 'class_id')
                    ->where('role', UserRole::STUDENT);
    }

    public function teachers(){
        return $this->belongsToMany(User::class, 'class_teacher', 'class_id', 'teacher_id')
        ->where('role', UserRole::STUDENT);
    }


    public function briefs(){
        return $this->hasMany(Brief::class, 'class_id');
    }

    public function sprints(){
        return $this->belongsToMany(Sprint::class, 'class_sprint','class_id', 'sprint_id');
    }
}
