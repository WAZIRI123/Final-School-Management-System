<?php

namespace App\Http\Livewire\Dashboard\TimeTable;

use App\Models\Classes;
use Livewire\Component;
use \Illuminate\View\View;
use App\Models\Timetable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CrudChild extends Component
{
    use AuthorizesRequests;
    
    public $item;
    public  $class;

    /**
     * @var array
     */
    protected $listeners = [
        'showDeleteForm',
        'showCreateForm',
        'showEditForm',
    ];

    /**
     *             
     * @var array
     */
    protected $rules = [
        'item.name' => 'required|string|max:255',
        'item.description' => 'nullable|string|max:255',
        'item.class_id' => 'required|integer|exists:classes,id',
    ];

    /**
     * @var array
     */
    protected $validationAttributes = [
        'item.name' => 'Name',
        'item.description' => 'Description',
        'item.class_id' => 'Class Id',
    ];

    /**
     * @var bool
     */
    public $confirmingItemDeletion = false;


    public $timetable;

    /**
     * @var bool
     */
    public $confirmingItemCreation = false;

    /**
     * @var bool
     */
    public $confirmingItemEdit = false;

    public function mount(){

        $this->class=Classes::all();
  
      }

    public function render(): View
    {
        return view('livewire.dashboard.time-table.crud-child');
    }

    public function showDeleteForm(Timetable $timetable): void
    {
        $this->authorize('delete', [$timetable, 'timetable']);
        $this->confirmingItemDeletion = true;
        $this->timetable = $timetable;
    }

    public function deleteItem(): void
    {
        $this->authorize('delete', [$this->timetable, 'timetable']);

        $this->timetable->delete();
   
        $this->confirmingItemDeletion = false;
        $this->timetable = '';
        $this->reset(['item']);
        $this->emitTo('dashboard.time-table.crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Deleted Successfully');
    }
 
    public function showCreateForm(): void
    {
        $this->authorize('create', [Timetable::class, 'timetable']);

        $this->confirmingItemCreation = true;
        $this->resetErrorBag();
        $this->reset(['item']);
    }

    public function createItem(): void
    {
        $this->authorize('create', [Timetable::class, 'timetable']);

        $this->validate();
        $item = Timetable::create([
            'name' => $this->item['name'] , 
            'description' => $this->item['description'] , 
            'semester_id' => auth()->user()->school->semester_id , 
            'class_id' => $this->item['class_id'],
            'school_id' => auth()->user()->school->id,
        ]);
        $this->confirmingItemCreation = false;
        $this->emitTo('dashboard.time-table.crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Added Successfully');
    }
 
    public function showEditForm(Timetable $timetable): void
    {
        $this->authorize('create', [$timetable, 'timetable']);

        $this->resetErrorBag();
        $this->item = $timetable;
        $this->confirmingItemEdit = true;
        $this->timetable = $timetable;
    }

    public function editItem(): void
    {
        $this->authorize('create', [$this->timetable, 'timetable']);

        $this->validate();
        $this->item->save();
        $this->confirmingItemEdit = false;
        $this->timetable = '';
        $this->emitTo('dashboard.time-table.crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Updated Successfully');
    }

}
