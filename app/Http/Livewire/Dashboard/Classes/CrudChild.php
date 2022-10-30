<?php

namespace App\Http\Livewire\Dashboard\Classes;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use \Illuminate\View\View;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\Classes;
use Livewire\WithFileUploads;

class CrudChild extends Component
{

    use AuthorizesRequests, WithFileUploads;

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
     * @var array
     */
    protected function rules()
    {
    return
    [
        'item.class_name' => 'required',
        'item.section' => 'required',
        'item.class_code' => 'required',
        
    ];
    }

    /**
     * @var array
     */
    protected $validationAttributes = [
        'item.class_name' => 'Class Name',
        'item.class_code' => 'Class Code',
        'item.section' => 'Section',

    ];

    /**
     * @var bool
     */
    public $confirmingItemDeletion = false;

    /**
     * @var string | int
     */
    public $primaryKey;

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
        return view('livewire.dashboard.classes.crud-child');
    }

    public function showDeleteForm(Classes $class): void
    {
        $this->authorize('delete', [$class, 'class']);
        $this->confirmingItemDeletion = true;
        $this->class= $class;
    }

    public function deleteItem(): void
    {
        $this->authorize('delete', [$this->class, 'class']);

        $this->class->delete();
        $this->confirmingItemDeletion = false;
        $this->class= '';
        $this->reset(['item']);
        $this->emitTo('dashboard.classes.crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Deleted Successfully');
    }
 
    public function showCreateForm(): void
    {
        $this->authorize('create', [Classes::class, 'class']);
        $this->confirmingItemCreation = true;
        $this->resetErrorBag();
        $this->reset(['item']);
       $this->item['class_code'] = IdGenerator::generate(['table' => 'classes', 'field' => 'class_code', 'length' => 5, 'prefix' => 'C']);
    }

    public function createItem(): void
    {
        $this->authorize('create', [Classes::class, 'class']);
        $this->validate();
        Classes::create([
            'class_name' => $this->item['class_name'], 
            'section' => $this->item['section'],
            'class_code' => $this->item['class_code'], 
            'school_id' => auth()->user()->school_id, 
        ]);
        $this->confirmingItemCreation = false;
        $this->emitTo('dashboard.classes.crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Added Successfully');
    }
 
    public function showEditForm(Classes $classes): void
    {
        $this->authorize('update', [$classes, 'class']);
        $this->resetErrorBag();
        $this->item = $classes;
        $this->confirmingItemEdit = true;
        $this->class= $classes;
    }

    public function editItem(): void
    {
        $this->authorize('update', [$this->class, 'class']);
        $this->validate();
        $this->item->save();
        $this->confirmingItemEdit = false;
        $this->class= '';
        $this->emitTo('dashboard.classes.crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Updated Successfully');
    }

}
