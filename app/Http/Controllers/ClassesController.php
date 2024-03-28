<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\SchoolYear;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    //

    public function list()
    {
        $idyear = session('IDschoolYear');
        $classes = Classe::where('school_year_id', $idyear)->get();

        return view('classes.list')->with('classes', $classes);
    }

    public function delete($id)
    {
        $classe = Classe::findOrFail($id);

        $classe->students()->detach();

        $classe->delete();

        return back()->with('success', 'Turma apagada com sucesso');
    }

    public function edit($id)
    {
        $classe = Classe::findOrFail($id);
        $courses = Course::all();

        return view('classes.edit')->with('classe', $classe)->with('courses', $courses);
    }

    public function update(Request $request, $id)
    {
        $classe = Classe::findOrFail($id);
        $classe->letter = $request->letter;
        $classe->course_id = $request->course_name;
        $classe->save();

        return back()->with('success', 'Os dados da classe foram atualizados');
    }

    public function deleteStudent(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $student->classes()->detach($request->classe);

        return back()->with('success', 'O Aluno ' . $student->name . ' foi eliminado da turma.');
    }

    public function viewTeachers($id)
    {
        $classe = Classe::findOrFail($id);
        $teachers = User::where('is_teacher', true)->get();

        return view('classes.view-teachers')->with('classe', $classe)->with('teachers', $teachers);
    }

    public function classifications(Request $request, $id)
    {
        $classe = Classe::findOrFail($id);
        if ($request->trimester) {
            $semester = $request->trimester;
        } else {
            $semester = "1";
        }

        return view('classes.classifications')->with('classe', $classe)->with('semester', $semester);
    }

    public function info($id)
    {
        $classe = Classe::findOrFail($id);
        $lessons = Lesson::where('course', $classe->course)->get();
        $lessonsGeneral = Lesson::where('course', 'NA')->get();

        return view('classes.info')->with('classe', $classe)->with('lessons', $lessons)->with('lessonsGeneral', $lessonsGeneral);
    }

    public function insertStudent($id)
    {
        $student = Student::findOrFail($id);
        $classes = Classe::where('school_year_id', session('IDschoolYear'))->where('course',  $student->course->name)->get();
        $message = false;

        foreach ($classes as $classe) {
            if ($classe->students->contains($student)) {
                $message = true;
            }
        }

        return view('students.insert')->with('student', $student)->with('classes', $classes)->with('message', $message);
    }

    public function matriculateStudent($id, Request $request)
    {
        $student = Student::findOrFail($id);
        $classe = Classe::where('id', $request->classe)->first();

        $classe->students()->attach($student);

        $message = "O aluno " . $student->name . " foi matriculado na turma " . $classe->letter . " - " . $classe->course;

        return back()->with('success', $message);
    }
}
