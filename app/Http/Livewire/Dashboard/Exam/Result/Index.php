<?php

namespace App\Http\Livewire\Dashboard\Exam\Result;

use App\Models\AcademicYear;
use Illuminate\Database\Eloquent\Builder;
use App\Models\ExamRecord;
use App\Models\Semester;
use App\Models\Student;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination,AuthorizesRequests;

    public $semesters;
    public $semeste_id;
    public $academics;
    public $academic;
    public $student;
    public $students;
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

    /**
     * @var string
     */
    public $q;

    /**
     * @var int
     */
    public $per_page = 15;

    public function mount(){
        $this->academics=AcademicYear::all();
        $this->semesters=Semester::all();
        $this->students=Student::with('user')->where('parent_id',auth()->user()->parent?->id)->get();
    }

    public function render()
    {
        $results = ExamRecord::
        with(['classes','exams','subjects','students','semester'])
       ->where('academic_id',$this->academic)
       ->where('student_id',auth()->user()->student->id ?? $this->student)
       ->when($this->q, function ($query) {
           return $query->where(function ($query) {
               $query->where('student_id', 'like', '%' . $this->q . '%');
           });
       })
       ->orderBy('marks','DESC');
       

   $results=$results->paginate($this->per_page);

   $semester1_result=$results->where('semester_id',1);
   $semester2_result=$results->where('semester_id',2);
        return view('livewire.dashboard.exam.result.index',[ 'semester1_result' => $semester1_result,'semester2_result' => $semester2_result])->layoutData(['title' => 'Manage Exam Record | School Management System']);

      
    }
    public function test(){
        dd(auth()->id());
    }
    public function sortBy(string $field): void
    {
        if ($field == $this->sortBy) {
            $this->sortAsc = !$this->sortAsc;
        }
        $this->sortBy = $field;
    }

    public function updatingQ(): void
    {
        $this->resetPage();
    }

    public function updatingPerPage(): void
    {
        $this->resetPage();
    }

    public function query(): Builder
    {
        return ExamRecord::query();
    }

}
