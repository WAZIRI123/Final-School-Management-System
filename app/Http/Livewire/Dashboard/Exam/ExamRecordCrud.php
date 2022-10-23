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

class ExamRecordCrud extends Component
{
    use WithPagination;

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


    public function mount()
    {
        if (auth()->user()->roles->pluck('name')->toArray()[0] =='Admin') {
            $this->subjects = Subject::all();
        }
        if (auth()->user()->roles->pluck('name')->toArray()[0] =='Teacher') {
            $this->subjects = Subject::where('id',auth()->user()->teacher()->id);
        }
        $this->classes = Classes::all();

        $this->exams = Exam::where('semester_id',auth()->user()->school->semester->id)->get();
    }


            //Mark student method
            public function markStudents()
            {
                $this->validate();

               //make sure selectedRows is present
               if ( count($this->marks)!=$this->students->count()) {
                return session()->flash('danger', 'Please select student/students to graduate');
            }
    
                // update each student's class
                foreach ($this->students as $student) {


                }
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
