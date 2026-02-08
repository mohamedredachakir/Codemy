<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Brief;

class DashboardController extends Controller
{
    public function index(){
        $user = auth()->user();

        if($user->isAdmin()){
            return view("dashboard.admin");
        }
        if($user->isTeacher()){
            $teacher = auth()->user();
            $classes = $teacher->teachingclasses()->with(['sprints.briefs'])->get();
            return view("dashboard.teacher", compact('classes'));
        }
        if($user->isStudent()){
            $classId = $user->class_id;

            if(!$classId){
                return view("dashboard.student", ['error' => 'You are not assigned to any class yet.']);
            }

            $user->load('schoolclass');
            $briefs = Brief::where('class_id', $classId)
                        ->where('is_published', true)
                        ->with(['sprint', 'submissions' => function($q) {
                            $q->where('student_id', auth()->id());
                        }])->get();

            return view("dashboard.student", compact('briefs', 'user'));
        }else {
            return redirect()->route('login')->with('error', 'No access session.');
        }
    }
}
