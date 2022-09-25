<?php

namespace App\Http\Livewire\Dashboard\School;

use App\Models\School;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class SetSchool extends Component
{
    use AuthorizesRequests;

    public $schools;
    public $school_id;
        /**
     * @var array
     */
    protected function rules()
    {
        return [
            'school_id' => 'required:int',
        ];
    }

    public function mount()
    {
        $this->schools =School::all();
        $this->school_id=auth()->user()->school_id;
    }
    public function render()
    {
        return view('livewire.dashboard.school.set-school');
    }
    public function setSchool()
    {
        $this->authorize('setSchool', User::class);
        $this->validate();

        if ($this->school_id) {

       $user=auth()->user();

       $user->school_id=$this->school_id;

       $user->save();

       $this->emitTo('livewire-toast', 'show', 'Record Updated Successfully');

        }
       
      
    }
}
