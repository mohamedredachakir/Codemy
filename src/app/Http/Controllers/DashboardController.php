<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $user = auth()->user();

        if($user->isAdmin()){
            return view("dashboard.admin");
        }
        if($user->isTeacher()){
            return view("dashboard.teacher");
        }
        if($user->isStudent()){
            return view("dashboard.student");
        }else {
            return "error! no access no pages for you!";
        }
    }
}
