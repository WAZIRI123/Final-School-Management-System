<?php

namespace App\Http\Livewire\Dashboard\Semester;

use App\Models\School;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class SetSemester extends Component
{
    use AuthorizesRequests;

    public $semester;
    public $semester_id;

    protected function rules()
    {
        return [
            'semester_id' => 'required:int',
        ];
    }

    public function mount()
    {
        $this->semester =Semester::where('school_id',auth()->user()->school_id)->get();
        $this->semester_id=School::find(auth()->user()->school_id)->semester?->id;
    }

    public function render()
    {
        return view('livewire.dashboard.semester.set-semester');
    }

    public function setSemester()
    {
        $this->authorize('set semester', User::class);
        $this->validate();

        if ($this->semester_id) {

       $school=School::find(auth()->user()->school_id);

       $school->semester_id=$this->semester_id;

       $school->save();

       $this->emitTo('livewire-toast', 'show', 'Record Updated Successfully');

        }
}
}
