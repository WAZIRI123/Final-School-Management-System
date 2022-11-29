<?php

namespace App\Http\Livewire\Dashboard\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use \Illuminate\View\View;

use App\Models\Admin;

class Crud extends Component
{
    use AuthorizesRequests,WithPagination;

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
        $this->authorize('viewAny', [User::class, 'admin']);

        $filterOnlyTeacherWithinSchool= function($query)  {
            $query->where('school_id', auth()->user()->school_id);
        };

        $results = $this->query()
        ->with(['user'])
        ->whereHas('user', $filterOnlyTeacherWithinSchool)
         ->when($this->q, function ($query) {
             return $query->where(function ($query) {
                 $query->where('admission_no', 'like', '%' . $this->q . '%');
             });
         })

         ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
         ->paginate($this->per_page);


        return view('livewire.dashboard.admin.crud',[
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
        return Admin::query();
    }
}
