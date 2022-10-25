<?php

namespace App\Http\Livewire\Dashboard\Exam;

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

class ExamRecordCrud extends Component
{
    use WithPagination,AuthorizesRequests;

    public $class;
    public $classes;
    public $exam;
    public $exams;
    public $section;
    public $subject;
    public $subjects;
    
    public $marks = [];

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
        'marks.*' => 'required|numeric|min:0|max:100',
    ];


    public function mount()
    {
        if (auth()->user()->roles->count()>0) {

        if (auth()->user()->roles?->pluck('name')->toArray()[0] =='Admin') {
            $this->subjects = Subject::all();
        }
        if (auth()->user()->roles?->pluck('name')->toArray()[0] =='Teacher') {
            $this->subjects = Subject::where('id',auth()->user()->teacher()->id);
        }
    }

        $this->classes = Classes::all();

        $this->exams = Exam::where('semester_id',auth()->user()->school->semester->id)->get();
    }


            //Mark student method
            public function markStudents()
            {
                $this->validate();

                // update each student's class
              collect($this->marks)->map(function($mark,$student){
                    ExamRecord::create([
                        'semester_id' =>auth()->user()->school->semester->id, 
                        'class_id' => $this->class, 
                        'section_id' => $this->section, 
                        'exam_id' => $this->exam, 
                        'subject_id' => $this->subject, 
                        'student_id' => $student, 
                        'marks' => $mark, 
                    ]);
                });

                $this->reset(['marks']);
                $this->emitTo('livewire-toast', 'show', 'Student Graduated Successfully');
    }

    public function getStudentsProperty()
    {
    return $this->query()
    ->where('class_id', $this->class)
    ->where('section',$this->section)

    ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
    ->paginate($this->per_page);
}

    public function render(): View
    {
        $this->authorize('create', [ExamRecord::class, 'exam record']);
        $results = $this->students;

        return view('livewire.dashboard.exam.exam-record-crud', [
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
