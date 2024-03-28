<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\SchoolYear;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Traits\YearVerificationTrait;

class SettingsController extends Controller
{
    use YearVerificationTrait;

    public function academic(Request $request)
    {
        $courses = Course::all();
        $years = SchoolYear::all();

        return view('settings.academic')->with('courses', $courses)->with('years', $years);
    }

    public function account()
    {
        return view('settings.account');
    }

    public function storeCourse(Request $request)
    {
        $course = new Course;

        $course->name = $request->name;

        $course->save();

        return back()->with('success', 'O Curso foi adicionado com sucesso!');
    }

    public function storeClasse(Request $request)
    {
        $currentYear = SchoolYear::findOrFail(session('IDschoolYear'));

        if (session('schoolYear')) {
            $classe = new Classe();

            $classe->letter = $request->letter;
            $classe->course = $request->course;
            $classe->shift = $request->shift;
            $classe->grade = $request->grade;
            $classe->schoolYear()->associate($currentYear);
            $classe->save();

            return back()->with('success', 'A turma foi criada com sucesso!');
        }

        return back()->with('error', 'ERRO! Não foi possível criar uma turma, por favor crie um ano lectivo');
    }

    public function storeLesson(Request $request)
    {
        $lesson = new Lesson();

        $grades = json_encode($request->grade);
        $lesson->name = $request->name;
        $lesson->course = $request->course;
        $lesson->grades = $grades;

        $lesson->save();

        return back()->with('success', 'A disciplina foi adicionada com sucesso!');
    }

    public function storeSchoolYear(Request $request)
    {
        function verifySchoolYear($request)
        {
            $currentDate = now()->toDateString();

            $schoolYear = SchoolYear::whereDate('initial', '<=', $currentDate)
                ->whereDate('final', '>=', $currentDate)
                ->first();

            $schoolYearCurrent = $schoolYear->initial . " / " . $schoolYear->final;

            $request->session()->put('schoolYear', $schoolYearCurrent);
        }

        $school_year = new SchoolYear();

        $school_year->initial = $request->initial;
        $school_year->final = $request->final;

        $school_year->save();


        if (!session('schoolYear')) {
            verifySchoolYear($request);
        }

        return back()->with('success', 'Ano lectivo adicionado com sucesso');
    }

    public function schoolYear(Request $request)
    {
        $this->verifyYear($request, $request->schoolYear);

        return back()->with('success', 'Está agora navegando pelas informações do ano selecionado');
    }


    /* Atualizar senha */
    public function changePassword(Request $request)
    {


        $id = Auth::user()->id;

        $request->validate([
            'password_old' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        //if (!Hash::check($request->password_old, $request->password)) {
        //  return redirect()->back()->with('error', 'A senha atual está incorreta.');
        //}

        $user = User::findOrFail($id);

        dd($user);
        //$user->password = bcrypt($request->input('password_new'));
        //$user->save();

        //return redirect()->route('dashboard')->with('success', 'Senha alterada com sucesso.');
    }
}
