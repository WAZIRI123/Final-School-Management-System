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
    public $student;
    public $students;

    public $semester1_result;
    public $semester2_result;
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
        // $studentsResult=ExamRecord::with(['exams', 'subjects', 'students','semester'])
        // ->where('academic_id', $this->academic?? auth()->user()
        // ->school->academicYear->id )
        // ->where('class_id',auth()->user()->student->class_id)->get();
$students=Student::with('examrecords')->whereHas('user.school',
fn($school)=>$school->where('id',auth()->user()->school->id)
)->get();

        dd(  $students);
 
$semester1_students_result=$studentsResult->where('semester_id',1)->sortByDesc('marks');

$semester2_students_result=$studentsResult->where('semester_id',2)->sortByDesc('marks');

        $rank = 1;
        foreach ($semester1_students_result as $result) {
            $result->rank = $rank;
            $rank++;
            $result->save();
        }

        $rank = 1;
        foreach ($semester2_students_result as $result) {
            $result->rank = $rank;
            $rank++;
            $result->save();
        }

   $students_semester1_number=$semester1_students_result->students->count();

   $students_semester2_number=$semester2_students_result->students->count();
   dd( $students_semester2_number);


        $results = ExamRecord::with(['classes', 'exams', 'subjects', 'students', 'semester'])
            ->where('academic_id', $this->academic?? auth()->user()->school->academicYear->id )
            ->where('student_id', auth()->user()->student->id ?? $this->student)
            ->when($this->q, function ($query) {
                return $query->where(function ($query) {
                    $query->where('student_id', 'like', '%' . $this->q . '%');
                });
            })
            ->orderBy('marks', 'DESC');

            dd( $results->get());
    $studentrank=ExamRecord::find($results->get()->first()->id)->rank;

        $results = $results->paginate($this->per_page);

        $semester1_result = $results->where('semester_id', 1);

        $semester2_result = $results->where('semester_id', 2);
       

  $this->semester1_result= $semester1_result;

  $this->semester2_result= $semester2_result;
        return view('livewire.dashboard.exam.result.index', ['semester1_result' => $semester1_result, 'semester2_result' => $semester2_result,'rank'=>$studentrank,'students_semester1_number'=>$students_semester1_number,'students_semester2_number'=>$students_semester2_number])->layoutData(['title' => 'Manage Exam Record | School Management System']);
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
