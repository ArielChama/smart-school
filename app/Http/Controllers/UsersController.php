<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UsersController extends Controller
{
    //
    public function show()
    {
        $users = User::all();
        $teachers = [];

        foreach ($users as $user) {
            if ($user->is_teacher) {
                array_push($teachers, $user);
            }
        }

        return view('teachers.list', ['teachers' => $teachers]);
    }

    public function create()
    {
        return view('teachers.add');
    }

    public function store(Request $request)
    {
        $teacher = new User();

        $teacher->name = $request->name;
        $teacher->email = $request->email;
        $teacher->password = Hash::make($request->password);
        $teacher->nationality = $request->nationality;
        $teacher->address = $request->address;
        $teacher->gender = $request->gender;
        $teacher->number_phone = $request->number_phone;
        $teacher->is_teacher = true;

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image = $request->file('image');
        $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/user_profile'), $imageName);

        $teacher->image = $imageName;

        $teacher->save();

        return back()->with('success', 'Professor foi cadastrado com sucesso');
    }

    public function profile($id)
    {
        $teacher = User::findOrFail($id);

        return view('teachers.profile', ['teacher' => $teacher]);
    }

    public function edit($id)
    {
        $lessons = Lesson::all();
        $teacher = User::findOrFail($id);

        return view('teachers.edit')->with('lessons', $lessons)->with('teacher', $teacher);
    }

    public function delete($id)
    {
        $teacher = User::findOrFail($id);
        $teacher->delete();

        return back()->with('success', 'Professor apagado com sucesso');
    }

    public function update(Request $request, $id)
    {
        $teacher = User::findOrFail($id);

        $teacher->name = $request->name;
        $teacher->email = $request->email;
        $teacher->nationality = $request->nationality;
        $teacher->address = $request->address;
        $teacher->gender = $request->gender;
        $teacher->number_phone = $request->number_phone;
        $teacher->is_teacher = true;

        if ($request->image) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $image = $request->file('image');
            $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/user_profile'), $imageName);

            $teacher->image = $imageName;
        }

        $teacher->save();

        return back()->with('success', 'Professor foi atualizado com sucesso');
    }

    public function lessons($id)
    {
        $lessons = Lesson::all();

        return view('teachers.lesson')->with('lessons', $lessons)->with('id', $id);
    }

    public function addLesson($id, Request $request)
    {
        $teacher = User::findOrFail($id);

        if ($request->has('lessons')) {
            $teacher->lessons()->sync($request->input('lessons'));
            return back()->with('success', "As disciplinas foram adicionadas com sucesso.");
        } else {
            return back()->with('error', "Erro! Não foi possível adicionar as disciplinas.");
        }
    }

    public function search()
    {
        $teachers = User::where('is_teacher', true)->with('lessons')->get();

        return response()->json(['teachers', $teachers]);
    }

    public function addTeacher($id, Request $request)
    {
        $classe = Classe::findOrFail($id);

        $teacherIds = $request->input('teachers', []);

        foreach ($teacherIds as $teacherId) {
            $teacher = User::findOrFail($teacherId);

            $lessons = $request->input('lessons' . $teacherId, []);

            $lessonsJson = json_encode($lessons);

            $classe->users()->attach($teacherId, ['lesson' => $lessonsJson]);
        }

        return redirect()->back()->with('success', 'Professores adicionados com sucesso à turma.');
    }
}
