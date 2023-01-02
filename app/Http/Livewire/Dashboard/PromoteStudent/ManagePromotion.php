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

    public $selectedRows = [];

    public $selectedAllRows = false;

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

    public function promotionDetails(Promotion $promotion): void
    {
        $this->authorize('view', $promotion);
        $this->confirmingItemShow = true;
        $this->students=Student::with('user')->where('id',$promotion->student_id)->get();
        $this->promotion = $promotion;
    }

    public function getPromotionsProperty()
    {
        $filterOnlyPromotionsWithinSchool = function ($query) {
            $query->where('school_id', auth()->user()->school_id);
        };

        return $this->query()
           ->with(['academicYear','oldClass', 'newClass','student','student.user'])
            ->where('academic_year_id', auth()->user()->school->academicYear->id)
            ->where('school_id', $filterOnlyPromotionsWithinSchool)
            ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
            ->paginate($this->per_page);
    }


    public function render(): View
    {
        $results = $this->promotions;

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

    public function resetPromotion(Promotion $promotion)
    {
        dd($results = $this->promotions);
     $students = $this->query()->find($promotion->student_id);
        $currentAcademicYear = auth()->user()->school->academicYear;

        foreach ($students as $student) {
            $student->studentRecord->load('academicYears')->academicYears()->syncWithoutDetaching([$currentAcademicYear->id => [
                'my_class_id' => $promotion->old_class_id,
                'section_id'  => $promotion->old_section_id,
            ]]);
            $student->studentRecord()->update([
                'my_class_id' => $promotion->old_class_id,
                'section_id'  => $promotion->old_section_id,
            ]);
        }

        $promotion->delete();
    }

    public function query(): Builder
    {
        return Promotion::query();
    }
}
