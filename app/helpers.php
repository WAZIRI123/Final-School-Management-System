<?php

use App\Models\School;

function AcademicYear(){
return School::where('id',auth()->user()->school_id)
->first(); 
// return [,$school->semester->name];

}

?>