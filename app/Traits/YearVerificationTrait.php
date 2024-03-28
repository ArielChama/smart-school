<?php

namespace App\Traits;

use App\Models\SchoolYear;

trait YearVerificationTrait
{
	public function verifyYear($request, $id)
	{
		$currentDate = now()->toDateString();

		$schoolYear = SchoolYear::findOrFail($id);
		
		/*
			Verifica se o ano escolar é o actual ano escolar
		*/

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
