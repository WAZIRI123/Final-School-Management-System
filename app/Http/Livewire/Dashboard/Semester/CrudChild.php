<?php

namespace App\Http\Livewire\Dashboard\Semester;

use App\Models\AcademicYear;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use \Illuminate\View\View;
use App\Models\Semester;
use Illuminate\Validation\Rule;

class CrudChild extends Component
{
    use AuthorizesRequests;

    public $item;
    
    public  $academicyear;

    public $semester;
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
    protected function rules(){
    return [
        'item.name' =>['required',Rule::unique('semesters','name')->ignore($this->semester->id)->whereNull('deleted_at')],
        'item.academic_year_id' => 'required',
    ];
}
    /**
     * @var array
     */
    protected $validationAttributes = [
        'item.name' => 'Name',
        'item.academic_year_id' => 'Academic Year Id',
    ];


    /**
     * @var bool
     */
    public $confirmingItemDeletion = false;



    /**
     * @var bool
     */
    public $confirmingItemCreation = false;

    /**
     * @var bool
     */
    public $confirmingItemEdit = false;

    public function mount(Semester $semester){
    
      $this->semester=$semester;
      $this->academicyear=AcademicYear::all();

    }

    public function render(): View
    {
        return view('livewire.dashboard.semester.crud-child');
    }

    public function showDeleteForm(Semester $semester): void
    {
        $this->authorize('delete', [$semester, 'semester']);
        $this->confirmingItemDeletion = true;
        $this->semester = $semester;
    }

    public function deleteItem(): void
    {
        $this->authorize('delete', [$this->semester, 'semester']);
        $this->semester->delete();
        $this->confirmingItemDeletion = false;
        
        $this->reset(['item']);
        $this->emitTo('dashboard.semester.crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Deleted Successfully');
    }
 
    public function showCreateForm(): void
    {
        $this->authorize('create', [Semester::class, 'semester']);
        $this->confirmingItemCreation = true;
        $this->resetErrorBag();
        $this->reset(['item']);
    }

    public function createItem(): void
    {
        $this->authorize('create', [Semester::class, 'semester']);
        $this->validate();
        $item = Semester::create([
            'name' => $this->item['name'], 
            'academic_year_id' => $this->item['academic_year_id'], 
            'school_id' => auth()->user()->school_id,
        ]);
        $this->confirmingItemCreation = false;
        $this->emitTo('dashboard.semester.crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Added Successfully');
    }
 
    public function showEditForm(Semester $semester): void
    {
        $this->authorize('update', [$semester, 'semester']);
        $this->resetErrorBag();
        $this->item = $semester;
        $this->confirmingItemEdit = true;
        $this->semester = $semester;
    }

    public function editItem(): void
    {
        $this->authorize('update', [$this->semester, 'semester']);
        $this->validate();
        $this->item->save();
    
        $this->confirmingItemEdit = false;
        $this->emitTo('dashboard.semester.crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Updated Successfully');
    }

}
