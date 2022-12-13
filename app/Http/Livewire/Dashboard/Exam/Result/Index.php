<?php

namespace App\Http\Livewire\Dashboard\Exam\Result;

use App\Models\AcademicYear;
use Illuminate\Database\Eloquent\Builder;
use App\Models\ExamRecord;
use App\Models\Semester;
use App\Models\Student;
use App\Services\Print\PrintService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, AuthorizesRequests;

    public $semesters;
    public $semeste_id;
    public $academics;
    public $academic;
    public $student_id;


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
        $this->academics = AcademicYear::all();
        $this->semesters = Semester::all();
        $this->students = Student::with('user')->where('parent_id', auth()->user()->parent?->id)->get();
    }

    public function pdfData()
    {

       return  to_route('result-pdf')->with(['r1'=>$this->semester1_result,'r2'=>$this->semester2_result]);
  
    }


    public function render()
    {
   
$students=Student::with('examrecords','class','examrecords.subjects')->where('class_id',$this->class ?? auth()->user()->student->class->id?? null)->whereHas('examrecords',fn($q)=>$q->where('academic_id',$this->academic_year?? auth()->user()->school->academicYear->id))->get()->sortByDesc(fn($student)=>$student->examrecords->sum('marks'));

$rank=1;

foreach ($students as $result) {
    $result->rank=$rank;
    $result->save();
    $rank++;
}


$student=$students->where('id',$this->student??auth()->user()->student->id)->first();



$student_result=$student->examrecords;

$student_result_semester1=$student_result->where('semester_id',1);

$student_result_semester2=$student_result->where('semester_id',2);
 



        return view('livewire.dashboard.exam.result.index', ['semester1_result' => $student_result_semester1, 'semester2_result' => $student_result_semester2,'student'=>$student,'students'=>$students])->layoutData(['title' => 'Manage Exam Record | School Management System']);
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
