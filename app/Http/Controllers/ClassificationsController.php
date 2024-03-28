<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Classification;
use App\Models\SchoolYear;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassificationsController extends Controller
{

    public function storeClassifications(Request $request)
    {
        try {
            $currentYear = SchoolYear::findOrFail(session('IDschoolYear'));
            $datas = $request->all();

            $values = array_filter($datas, function ($key) {
                return strpos($key, 'value') !== false;
            }, ARRAY_FILTER_USE_KEY);

            $students = array_filter($datas, function ($key) {
                return strpos($key, 'student') !== false;
            }, ARRAY_FILTER_USE_KEY);

            foreach ($students as $student) {
                if ($values["value" . $student]) {
                    $classification = new Classification();
                    $classification->values = $values["value" . $student];
                    $studentBD = Student::findOrFail($student);
                    $classification->trimester = $request->trimester;
                    $classification->schoolYear()->associate($currentYear);

                    $studentBD->classifications()->save($classification);
                }
            }

            return back()->with('success', 'As notas foram adicionadas');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function list()
    {
        $classes = Classe::all();

        return view('classifications.list')->with('classes', $classes);
    }
}
