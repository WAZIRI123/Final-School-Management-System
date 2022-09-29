<?php

use App\Models\School;

function AcademicYear(){
return School::where('id',auth()->user()->id)
->first(); 
// return [,$school->semester->name];

}

?>