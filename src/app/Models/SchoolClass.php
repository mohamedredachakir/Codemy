<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function student(){
        return $this->hasMany(User::class, 'class_id')
        ->where('role', 'student');
    }

    public function teacher(){
        return $this->belongsToMany(User::class, 'class_teacher', 'class_id', 'teacher_id');
    }

    public function briefs(){
        return $this->hasMany(Brief::class);
    }

    public function sprints(){
        return $this->belongsToMany(Sprint::class, 'class_sprint');
    }
}
