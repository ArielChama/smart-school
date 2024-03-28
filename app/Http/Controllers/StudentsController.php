<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StudentsController extends Controller
{
    //
    public function show() {
        $students = Student::all();

        return view('students.list', ['students' => $students]);
    }

    public function create() {
        $courses = Course::all();

        return view('students.add')->with('courses', $courses);
    }

    public function store(Request $request) {
        $student = new Student();

        $student->name = $request->name;
        $student->email = $request->email;
        $student->nationality = $request->nationality;
        $student->address = $request->address;
        $student->gender = $request->gender;
        $student->number_phone = $request->number_phone;
        $student->birthday = $request->birthday;
        $student->number_bi = $request->number_bi;
        $student->language_option = $request->language_option;
        $student->process_number = $request->process_number;
        $student->course = $request->course;

        
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image = $request->file('image');
        $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/students'), $imageName);

        $student->image = $imageName;

        $student->save();

        return back()->with('success', 'O estudante foi cadastrado com sucesso.');
    }

    public function profile($id) {
        $student = Student::findOrFail($id);

        return view('students.profile', ['student' => $student]);
    }

    public function delete($id) {
        $student = Student::findOrFail($id);
        $student->delete();

        return back()->with('success', 'Estudante apagado com sucesso');
    }

    public function edit($id) {
        $student = Student::findOrFail($id);

        return view('students.edit')->with('student', $student);
    }

    public function update(Request $request, $id) {
        $student = Student::findOrFail($id);

        $student->name = $request->name;
        $student->email = $request->email;
        $student->nationality = $request->nationality;
        $student->address = $request->address;
        $student->gender = $request->gender;
        $student->number_phone = $request->number_phone;
        $student->birthday = $request->birthday;
        $student->number_bi = $request->number_bi;

        if ($request->image) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            $image = $request->file('image');
            $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/students'), $imageName);
    
            $student->image = $imageName;
        }

        $student->save();

        return back()->with('success', 'Informações atualizadas.');
    }

    public function search() {
        $students = Student::all();

        return response()->json(['students', $students]);
    }
}
