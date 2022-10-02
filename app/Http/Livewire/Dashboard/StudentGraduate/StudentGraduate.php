<?php

namespace App\Http\Livewire\Dashboard\StudentGraduate;

use App\Models\Classes;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Student;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class StudentGraduate extends Component

{
    use AuthorizesRequests, WithPagination;

    public $class;

    public $selectedRows = [];
    public $selectedAllRows = false;

    
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

    public $old_class;

    public $old_section;

    
    public function mount()
    {
        $this->class = Classes::all();
    }
    protected function rules()
    {
        return [
            'old_class'   => 'required|exists:classes,id',
            'old_section' => 'required',
            'selectedRows.*'   => 'nullable|exists:users,id',
        ];
    }

    public function getStudentsProperty()
    {
        $filterOnlyStudentWithinSchool = function ($query) {
            $query->where('school_id', auth()->user()->school_id);
        };

        return $this->query()
        ->where('is_graduated', false)
            ->where('class_id', $this->old_class)
            ->where('section', $this->old_section)
            ->with(['user', 'parent', 'class'])
            ->whereHas('user', $filterOnlyStudentWithinSchool)
            ->where('status', \App\Enums\StudentStatusEnum::Active)
            ->when($this->q, function ($query) {
                return $query->where(function ($query) {
                    $query->where('user_id', 'like', '%' . $this->q . '%');
                });
            })
            ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
            ->paginate($this->per_page);
    }

    public function render()
    {
        $this->authorize('read student', Student::class);
        $results = $this->students;

        return view('livewire.dashboard.student-graduate.student-graduate',[
            'results' => $results
        ]);
    }

    public function sortBy(string $field): void
    {
        if ($field == $this->sortBy) {
            $this->sortAsc = !$this->sortAsc;
        }
        $this->sortBy = $field;
    }

        //graduate student method
        public function graduateStudents()
        {
            $this->authorize('graduate student', Student::class);
            $this->validate();
            //get all students for promotion
            $users =Student::whereIn('id', $this->selectedRows)->get();
    
           //make sure selectedRows is present
           if ( $this->selectedRows == null) {
            return session()->flash('danger', 'Please select student/students to graduate');
        }

            // update each student's class
            foreach ($users as $user) {
                if (in_array($user->id, $this->selectedRows)) {
                    
                    $user->update([
                        'is_graduated' => true,
                    ]);
                }
            }
            $this->reset(['selectedRows']);
            $this->emitTo('livewire-toast', 'show', 'Student Graduated Successfully');
}

public function UpdatedselectedAllRows($value)
{
    if ($value) {
        $this->selectedRows = $this->Students->pluck('id')->map(function ($id) {
            return (string) $id;
        });
    } else {
        $this->reset(['selectedRows', 'selectedAllRows']);
    }
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