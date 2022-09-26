<?php

namespace App\Http\Livewire\Dashboard\Subject;

use App\Models\Classes;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use \Illuminate\View\View;
use App\Models\Subject;

class CrudChild extends Component
{
    use AuthorizesRequests;

    public $item;

    public  $subject;

    public  $classes;
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
        'item.name' => 'required',
        'item.subject_code' => 'required',
        'item.class_id' => 'required',
    ];

    /**
     * @var array
     */
    protected $validationAttributes = [
        'item.name' => 'Name',
        'item.subject_code' => 'Subject Code',
        'item.class_id' => 'Class Id',
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

    public function mount()
    {
        $this->classes =Classes::all();
    }

    public function render(): View
    {
        return view('livewire.dashboard.subject.crud-child');
    }

    public function showDeleteForm(Subject $subject): void
    {
        $this->authorize('delete', [$subject, 'subject']);

        $this->confirmingItemDeletion = true;
        $this->subject= $subject;
    }

    public function deleteItem(): void
    {
        $this->authorize('delete', [$this->subject, 'subject']);
        $this->subject->delete();
        $this->confirmingItemDeletion = false;
        $this->subject = '';
        $this->reset(['item']);
        $this->emitTo('dashboard.subject.crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Deleted Successfully');
    }
 
    public function showCreateForm(): void
    {
        $this->authorize('create', [Subject::class, 'subject']);
        $this->confirmingItemCreation = true;
        $this->resetErrorBag();
        $this->reset(['item']);
        $this->item['subject_code'] = IdGenerator::generate(['table' => 'subjects', 'field' => 'subject_code', 'length' => 5, 'prefix' => 'S']);
    }

    public function createItem(): void
    {
        $this->authorize('create', [Subject::class, 'subject']);
        $this->validate();
        $item = Subject::create([
            'name' => $this->item['name'], 
            'subject_code' => $this->item['subject_code'], 
            'class_id' => $this->item['class_id'], 
            'school_id'=>auth()->user()->school_id,
        ]);
        $this->confirmingItemCreation = false;
        $this->emitTo('dashboard.subject.crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Added Successfully');
    }
 
    public function showEditForm(Subject $subject): void
    {
        $this->authorize('update', [$subject, 'subject']);
        $this->resetErrorBag();
        $this->item = $subject;
        $this->confirmingItemEdit = true;
        $this->subject= $subject;
    }

    public function editItem(): void
    {
        $this->authorize('update', [$this->subject, 'subject']);
        $this->validate();
        $this->item->save();
        $this->confirmingItemEdit = false;
        $this->subject = '';
        $this->emitTo('dashboard.subject.crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Updated Successfully');
    }

}
