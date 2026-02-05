<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolClass;
use App\Models\User;

class AssignController extends Controller
{
        public function index()
    {

        $classes = SchoolClass::all();
        $teachers = User::where('role', 'teacher')->get();
        $students = User::where('role', 'student')->get();

        return view('assign.index', compact('classes', 'teachers', 'students'));
    }

    public function assignTeacher(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:school_classes,id',
            'teacher_id' => 'required|exists:users,id',
        ]);

        $class = SchoolClass::findOrFail($request->class_id);
        $teacher = User::findOrFail($request->teacher_id);


        $class->teachers()->syncWithoutDetaching([$teacher->id]);

        return redirect()->back()->with('success','Teacher assigned to class!');
    }

    public function assignStudent(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:school_classes,id',
            'student_id' => 'required|exists:users,id',
        ]);

        $class = SchoolClass::findOrFail($request->class_id);
        $student = User::findOrFail($request->student_id);

        $student->update(['class_id' => $class->id]);

        return redirect()->back()->with('success','Student assigned to class!');
    }
}
