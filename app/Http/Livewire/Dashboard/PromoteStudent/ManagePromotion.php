<?php

namespace App\Http\Livewire\Dashboard\PromoteStudent;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use \Illuminate\View\View;

use App\Models\Promotion;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class ManagePromotion extends Component
{
    use WithPagination,AuthorizesRequests;

    public $promotion;

    public $students;

    /**
     * @var array
     */
    protected $listeners = ['refresh' => '$refresh','promotionDetails'=>'promotionDetails'];
    /**
     * @var string
     */
    public $sortBy = 'id';

    /**
     * @var bool
     */
    public $sortAsc = true;

    /**
     * @var bool
     */
    public $confirmingItemResetion = false;

    public $confirmingItemShow = false;
    /**
     * @var string
     */
    public $q;


    /**
     * @var int
     */
    public $per_page = 15;


    public function mount(): void
    {
    }
    public function promotionDetails(Promotion $promotion): void
    {
        $this->authorize('view', $promotion);
        $this->confirmingItemShow = true;
        $this->students=Student::with('user')->where('id',$promotion->student_id)->get();
        $this->promotion = $promotion;
    }


    public function render(): View
    {
        $results = $this->query()
            ->with(['academicYear', 'oldClass', 'newClass','student','student.user'])
            ->where('school_id', auth()->user()->school_id)
            ->when($this->q, function ($query) {
                return $query->where(function ($query) {
                    $query->where('academic_year_id', 'like', '%' . $this->q . '%');
                });
            })
            ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
            ->paginate($this->per_page);

        return view('livewire.dashboard.promote-student.manage-promotion', [
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
        return Promotion::query();
    }
}
