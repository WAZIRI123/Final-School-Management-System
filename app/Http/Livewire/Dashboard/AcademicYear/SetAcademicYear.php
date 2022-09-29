<?php

namespace App\Http\Livewire\Dashboard\AcademicYear;

use App\Models\AcademicYear;
use App\Models\School;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class SetAcademicYear extends Component
{
    use AuthorizesRequests;

    public $academicyear;
    public $academic_year_id;

         /**
     * @var array
     */
    protected function rules()
    {
        return [
            'academic_year_id' => 'required:int',
        ];
    }

    public function mount()
    {
        $this->academicyear =AcademicYear::where('school_id',auth()->user()->school_id)->get();
        $this->academic_year_id=School::find(auth()->user()->school_id)->academic_year_id;
    }

    public function render()
    {
        return view('livewire.dashboard.academic-year.set-academic-year');
    }
    
    public function setAcademicYear()
    {
        $this->authorize('set academic year', User::class);
        $this->validate();

        if ($this->academic_year_id) {

       $school=School::find(auth()->user()->school_id);

       $school->academic_year_id=$this->academic_year_id;
       $school->semester_id=null;

       $school->save();

       $this->emitTo('livewire-toast', 'show', 'Record Updated Successfully');

        }
}
}
