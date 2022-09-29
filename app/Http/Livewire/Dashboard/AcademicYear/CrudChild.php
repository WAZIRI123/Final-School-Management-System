<?php

namespace App\Http\Livewire\Dashboard\AcademicYear;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use \Illuminate\View\View;
use App\Models\AcademicYear;

class CrudChild extends Component
{
    use AuthorizesRequests;

    public $item;

    /**
     * @var array
     */
    protected $listeners = [
        'showDeleteForm',
        'showCreateForm',
        'showEditForm',
    ];

    /**
     * @var array
     */
    protected $rules = [

        'item.start_year' => 'required|digits:4|integer|min:1900',
        'item.stop_year' => 'required|digits:4|integer|min:1900|gt:item.start_year',
    ];

    /**
     * @var array
     */
    protected $validationAttributes = [
        'item.start_year' => 'Start Year',
        'item.stop_year' => 'Stop Year',
    ];

    /**
     * @var bool
     */
    public $confirmingItemDeletion = false;

    public $academicyear;

    /**
     * @var bool
     */
    public $confirmingItemCreation = false;

    /**
     * @var bool
     */
    public $confirmingItemEdit = false;

    public function render(): View
    {
        return view('livewire.dashboard.academic-year.crud-child');
    }

    public function showDeleteForm(AcademicYear $academicyear): void
    {
        $this->authorize('delete', [$academicyear, 'academic year']);
        $this->confirmingItemDeletion = true;
        $this->academicyear = $academicyear;
    }

    public function deleteItem(): void
    {
        $this->authorize('delete', [$this->academicyear, 'academic year']);
        $this->academicyear->delete();
        $this->confirmingItemDeletion = false;
        $this->academicyear = '';
        $this->reset(['item']);
        $this->emitTo('dashboard.academic-year.crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Deleted Successfully');
    }

    public function showCreateForm(): void
    {
        $this->authorize('create', [AcademicYear::class, 'academic year']);
        $this->confirmingItemCreation = true;
        $this->resetErrorBag();
        $this->reset(['item']);
    }

    public function createItem(): void
    {
        $this->authorize('create', [AcademicYear::class, 'academic year']);
        $this->validate();
        $item = AcademicYear::create([
            'start_year' => $this->item['start_year'] ,
            'stop_year' => $this->item['stop_year'] ,
            'school_id'=>auth()->user()->school_id,
        ]);
        $this->confirmingItemCreation = false;
        $this->emitTo('dashboard.academic-year.crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Added Successfully');
    }

    public function showEditForm(AcademicYear $academicyear): void
    {
        $this->authorize('update', [$academicyear, 'academic year']);
        $this->resetErrorBag();
        $this->item = $academicyear;
        $this->confirmingItemEdit = true;
        $this->academicyear = $academicyear;
    }

    public function editItem(): void
    {
        $this->authorize('update', [$this->academicyear, 'academic year']);
        $this->validate();
        $this->item->save();
        $this->confirmingItemEdit = false;
        $this->academicyear = '';
        $this->emitTo('dashboard.academic-year.crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Updated Successfully');
    }
}
