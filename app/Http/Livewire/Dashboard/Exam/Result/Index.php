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
    use WithPagination, AuthorizesRequests;

    public $semesters;
    public $semeste_id;
    public $academic_year;
    public $academic;
    public $student_id;
    
    public $class;

    public $student_result_semester1;

    public $student_result_semester2;

    public  $student;

    public  $select_student;
    
    public  $students;


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

    public function mount()
    {
        $this->academics = AcademicYear::where('school_id',auth()->user()->school->id)->get();
        $this->semesters = Semester::all();
        $this->students = Student::with('user')->where('parent_id', auth()->user()->parent?->id)->get();

        $this->student_result_semester1=collect([]);
        $this->student_result_semester2=collect([]);
    }

    public function examRecords()
    {

        $this->authorize('viewAny', [ExamRecord::class]);

        $this->students=Student::with('examrecords','class','examrecords.subjects')->where('class_id',$this->class ?? auth()->user()->student->class->id?? null)->whereHas('examrecords',fn($q)=>$q->where('academic_id',$this->academic_year?? auth()->user()->school->academicYear->id))->get()->sortByDesc(fn($student)=>$student->examrecords->sum('marks'));
        $rank=1;
        
        foreach ($this->students as $result) {
            $result->rank=$rank;
            $result->save();
            $rank++;
        }
        
        
        $this->student=$this->students->where('id',$this->select_student??auth()->user()->student->id)->first();
        
        
        $student_result=$this->student?->examrecords;
        
        $this->student_result_semester1=$student_result?->where('semester_id',1)?? collect([]);

     
        
        $this->student_result_semester2=$student_result?->where('semester_id',2)?? collect([]);
    }


    public function render()
    {

        return view('livewire.dashboard.exam.result.index')->layoutData(['title' => 'Manage Exam Record | School Management System']);
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
