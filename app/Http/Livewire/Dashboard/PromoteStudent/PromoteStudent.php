<?php

namespace App\Http\Livewire\Dashboard\PromoteStudent;

use App\Models\Classes;
use App\Models\Promotion;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use \Illuminate\View\View;

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PromoteStudent extends Component
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


    public $new_class;

    public $new_section;

    public function mount()
    {
        $this->classes = Classes::all();
    }

    /**
     * @var array
     */
    protected function rules()
    {
        return [
            'old_class'   => 'required|exists:classes,id',
            'new_class'   => 'required|exists:classes,id',
            'old_section' => 'required',
            'new_section' => 'required',
            'selectedRows.*'   => 'nullable|exists:users,id',
        ];
    }

    public function getStudentsProperty()
    {
        $filterOnlyStudentWithinSchool = function ($query) {
            $query->where('school_id', auth()->user()->school_id);
        };

        return $this->query()
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

    public function render(): View
    {
        $this->authorize('viewAny', Promotion::class);
        $results = $this->students;
        return view('livewire.dashboard.promote-student.promote-student', [
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

    //promote student method
    public function promoteStudents()
    {
        $this->authorize('promote', Promotion::class);
        $this->validate();
        //get all students for promotion
        $users =Student::whereIn('id', $this->selectedRows)->get();

        $academicyear=auth()->user()->school->academic_year_id;
        //make sure academic year is present
        if ( $academicyear == null) {
            return session()->flash('danger', 'Academic year is not set');
        }
       //make sure selectedRows is present
       if ( $this->selectedRows == null) {
        return session()->flash('danger', 'Please select student/students to promote');
    }
        DB::beginTransaction();
        // update each student's class
        foreach ($users as $user) {
            if (in_array($user->id, $this->selectedRows)) {
                
                $user->update([
                    'class_id' => $this->new_class,
                    'section'  => $this->new_section,
                ]);
            }
        }

        // create promotion record
        Promotion::create([
            'old_class_id'     => $this->old_class,
            'new_class_id'     => $this->new_class,
            'old_section'   => $this->old_section,
            'new_section'   => $this->new_section,
            'students'         => $users->pluck('id'),
            'academic_year_id' => $academicyear,
            'school_id'        => auth()->user()->school_id,
        ]);
        DB::commit();
        $this->reset(['selectedRows']);
        $this->emitTo('livewire-toast', 'show', 'Record Updated Successfully');
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
