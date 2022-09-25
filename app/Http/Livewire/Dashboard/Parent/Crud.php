<?php

namespace App\Http\Livewire\Dashboard\Parent;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Database\Eloquent\Builder;
use \Illuminate\View\View;

use App\Models\Parents;

class Crud extends Component
{
    use WithPagination,AuthorizesRequests;

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


    public function mount(): void
    {

    }

    public function render(): View
    {

        $this->authorize('viewAny', [User::class, 'parent']);

        $filterOnlyParentWithinSchool= function($query)  {
            $query->where('school_id', auth()->user()->school_id);
        };

        $results = $this->query()
            ->with(['user','students'])
            ->whereHas('user', $filterOnlyParentWithinSchool)
            ->when($this->q, function ($query) {
                return $query->where(function ($query) {
                    $query->where('admission_no', 'like', '%' . $this->q . '%');
                });
            })
            ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
            ->paginate($this->per_page);

        return view('livewire.dashboard.parent.crud', [
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
        return Parents::query();
    }
}
