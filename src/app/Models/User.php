<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role',
        'class_id',
    ];

    protected $casts = ['role' => UserRole::class];

    public function schoolclass(){
        return $this->belongsTo(SchoolClass::class);
    }

    public function teachingclasses(){
        return $this->belongsToMany(SchoolClass::class,'class_teacher','teacher_id','class_id');
    }

    public function submitions(){
        return $this->hasMany(Submission::class, 'student_id');
    }

    public function evaluationsGiven(){
        return $this->hasMany(Evaluation::class, 'teacher_id');
    }

    public function evaluationsReceived(){
        return $this->hasMany(Evaluation::class,'student_id');
    }


    public function isStudent()
    {
        return $this->role === UserRole::STUDENT;
    }

    public function isAdmin(){
        return $this->role === UserRole::ADMIN;
    }

    public function isTeacher()
    {
        return $this->role === UserRole::TEACHER;
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
