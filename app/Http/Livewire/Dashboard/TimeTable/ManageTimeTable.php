<?php

namespace App\Http\Livewire\Dashboard\TimeTable;

use App\Models\Classes;
use App\Models\Semester;
use App\Models\Timetable;
use App\Models\TimeTableTimeSlot;
use App\Models\WeekDay;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use \Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class ManageTimeTable extends Component
{
    use WithPagination, AuthorizesRequests;

    /**
     * @var array
     */
    protected $listeners = ['refresh' => '$refresh'];
    /**
     * @var string
     */
    public $sortBy = 'id';

    /**
     * @var bool
     */
    public $sortAsc = true;


    public $weekdays ;

    public $selected_semester;

   public $selected_class ;

   public $classes;

   public $semesters;
    
    public function mount()
    {
        if (auth()->user()->roles->pluck('name')->toArray()[0] !='Admin') {
            $this->selected_class =auth()->user()->teacher?->class_id?? auth()->user()->student?->class_id;
            $this->selected_semester=AcademicYear()->semester?->id;
           }

            $this->weekdays  = WeekDay::with(['timeSlots','timeSlots.timetableRecord.subjects'])->get();
  
        $this->classes = Classes::all();
        $this->semesters = Semester::all();
    }

    public function test(){

   
    }

    protected function rules()
    {
        return [
            'selected_class'   => ['required','exists:classes,id'],
            'selected_semester'   => ['required','exists:semesters,id'],
        ];
    }


    public function render():View
    {
        $results = $this->query()
            ->where('class_id', $this->selected_class)
            ->where('semester_id',$this->selected_semester)
            ->where('school_id',auth()->user()->school->id)
            ->with(['slots'])
            ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')->get();

        return view('livewire.dashboard.time-table.manage-time-table',['results'=>$results])->layoutData(['title' => 'timetables | School Management System']);
    }

    public function sortBy(string $field): void
    {
        if ($field == $this->sortBy) {
            $this->sortAsc = !$this->sortAsc;
        }
        $this->sortBy = $field;
    }

    public function updatingPerPage(): void
    {
        $this->resetPage();
    }

    public function query(): Builder

    {
        return Timetable::query();
    }


}
