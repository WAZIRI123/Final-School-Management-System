<?php

namespace App\Http\Livewire\Dashboard\Exam\Result;

use Illuminate\Database\Eloquent\Builder;
use App\Models\ExamRecord;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination,AuthorizesRequests;

    public $semeste_id;

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

    public function render()
    {
        $results = ExamRecord::
        with(['classes','exams','subjects','students','semester'])
       ->where('semester_id',auth()->user()->school?->semester?->id)
       ->where('student_id',auth()->id())
       ->when($this->q, function ($query) {
           return $query->where(function ($query) {
               $query->where('student_id', 'like', '%' . $this->q . '%');
           });
       })
       ->orderBy('marks','DESC');


   $results=$results->paginate($this->per_page);
        return view('livewire.dashboard.exam.result.index',[ 'results' => $results])->layoutData(['title' => 'Manage Exam Record | School Management System']);
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
