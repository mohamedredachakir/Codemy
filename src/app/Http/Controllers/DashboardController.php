<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
            return view("dashboard.student");
        }else {
            return "error! no access no pages for you!";
        }
    }
}
