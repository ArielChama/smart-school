<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Lesson;
use App\Models\SchoolYear;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function home(Request $request)
    {
        function createSchoolYear($request)
        {
            $currentDate = now()->toDateString();

            $schoolYear = SchoolYear::whereDate('initial', '<=', $currentDate)
                ->whereDate('final', '>=', $currentDate)
                ->first();

            if ($schoolYear) {
                if (($schoolYear->initial <= $currentDate) && ($schoolYear->final >= $currentDate)) {
                    $request->session()->put('yearCurrent', true);
                } else {
                    $request->session()->put('yearCurrent', false);
                }
                
                $schoolYearCurrent = $schoolYear->initial . " / " . $schoolYear->final;

                $request->session()->put('schoolYear', $schoolYearCurrent);
                $request->session()->put('IDschoolYear', $schoolYear->id);
            }
        }

        $lenght_students = count(Student::all());
        $lenght_classes = count(Classe::where('school_year_id', session('IDschoolYear'))->get());
        $lenght_lessons = count(Lesson::all());

        $teachers = User::where('is_teacher', true)->get();
        $lenght_teachers = count($teachers);


        if (!session('schoolYear')) {
            createSchoolYear($request);
        }


        return view('dashboard')->with('lenght_teacher', $lenght_teachers)->with('lenght_students', $lenght_students)->with('lenght_classes', $lenght_classes)->with('lenght_lessons', $lenght_lessons);
    }
}
