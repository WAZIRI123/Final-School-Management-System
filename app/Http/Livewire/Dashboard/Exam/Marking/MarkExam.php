<?php

namespace App\Http\Livewire\Dashboard\Exam\Marking;

use App\Models\Classes;
use App\Models\Exam;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use \Illuminate\View\View;

use App\Models\ExamRecord;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MarkExam extends Component
{
    use WithPagination,AuthorizesRequests;

    public $class;
    public $classes;
    public $exam;
    public $exams;
    public $section;
    public $subject;
    public $subjects;
    
    public $student=[] ;//marks

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
    /**
     * @var array
     */
    protected $rules = [
        'class' => 'required',
        'section' => 'required',
        'exam' => 'required',
        'subject' => 'required',
        'student.*' => 'required|numeric|min:0|max:100',
    ];

    protected $messages=[
'student.*.min'=>'The marks for :attribute must be at least 0 or greater',
'student.*.max'=>'The marks for :attribute must be at most 100 or less'
    ];

    public function mount()
    {
        if (auth()->user()->roles->count()>0) {

        if (auth()->user()->roles?->pluck('name')->toArray()[0] =='Admin') {
            $this->subjects = Subject::all();
        }
        if (auth()->user()->roles?->pluck('name')->toArray()[0] =='Teacher') {

            $subject=auth()->user()->teacher->subjects->toArray();

           $teacherSubjects=[];
            foreach ($subject as $key => $value) {
                $teacherSubjects[]=$value['id'];
            }
            
            $this->subjects = Subject::whereIn('id',$teacherSubjects)->get();
        }
    }

        $this->classes = Classes::all();

    $this->exams = Exam::where('semester_id',auth()->user()->school->semester?->id)->get();
    }
public function  Markstudent(){
            $this->validate();
              //make sure selectedRows is present
              if ( count($this->student)!=$this->students->count()) {
                return session()->flash('danger', 'Please make sure that you have entered mark for all students in the class');
            }

                // update each student's class
              collect($this->student)->map(function($mark,$student){
                    ExamRecord::create([
                        'semester_id' =>auth()->user()->school->semester?->id?? 1, 
                        'class_id' => $this->class, 
                        'section_id' => $this->section, 
                        'academic_id' => auth()->user()->school->academicYears?->id, 
                        'exam_id' => $this->exam, 
                        'subject_id' => $this->subject,
                        'student_id' => $student,
                        'marks' => $mark, 
                    ]);
                });

                $this->reset(['student']);
                $this->emitTo('livewire-toast', 'show', 'Student Graduated Successfully');
    }

    public function getStudentsProperty()
    {
    if ($this->subject !=null && $this->exam !=null) {
    return $this->query()
    ->where('class_id', $this->class)
    ->where('section',$this->section)
   -> whereDoesntHave('examrecords', function (Builder $query) {
        $query->where([['exam_id',  $this->exam],['subject_id',  $this->subject]]);
    })
    ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC');
}
    }

    public function render(): View
    {
        $this->authorize('create', [ExamRecord::class, 'exam record']);

        $results = $this->students?->paginate($this->per_page);

        return view('livewire.dashboard.exam.marking.mark-exam', [
            'results' => $results
        ])->layoutData(['title' => ' Exam Record | School Management System']);
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
        return Student::query();
    }
}
