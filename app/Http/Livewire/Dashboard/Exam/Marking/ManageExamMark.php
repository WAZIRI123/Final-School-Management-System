<?php

namespace App\Http\Livewire\Dashboard\Exam\Marking;

use App\Models\Classes;
use App\Models\Exam;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use \Illuminate\View\View;

use App\Models\ExamRecord;
use App\Models\Subject;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ManageExamMark extends Component
{
    use WithPagination,AuthorizesRequests;

    public $class;
    public $classes;
    public $exam;
    public $exams;
    public $section;
    public $subject;
    public $subjects;
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
        if (auth()->user()->roles->count()>0) {

        if (auth()->user()->roles?->pluck('name')->toArray()[0] =='Admin') {
            $this->subjects = Subject::all();
        }
        if (auth()->user()->roles?->pluck('name')->toArray()[0] =='Teacher') {
            $this->subjects = Subject::where('id',auth()->user()->teacher()->id);
        }
    }

        $this->classes = Classes::all();

    $this->exams = Exam::where('semester_id',auth()->user()->school->semester?->id)->get();
    }

    public function render(): View
    {
        $this->authorize('viewAny', [ExamRecord::class]);
        $results = ExamRecord::
             with(['classes','exams','subjects','students','semester'])
            ->where('class_id',$this->class)
            ->where('subject_id',$this->subject)
            ->where('section_id',$this->section)
            ->where('exam_id',$this->exam)
            ->where('semester_id',auth()->user()->school->semester?->id)
            ->when($this->q, function ($query) {
                return $query->where(function ($query) {
                    $query->where('student_id', 'like', '%' . $this->q . '%');
                });
            })
            ->orderBy('marks','DESC');

        $results->each(function($item,$key){
         
            $item->rank=$key+1;
            $item->save();

        });

        $results=$results->paginate($this->per_page);

        return view('livewire.dashboard.exam.marking.manage-exam-mark', [
            'results' => $results
        ])->layoutData(['title' => 'Manage Exam Record | School Management System']);
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
