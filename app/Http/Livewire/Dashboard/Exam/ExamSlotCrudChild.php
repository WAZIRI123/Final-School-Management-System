<?php

namespace App\Http\Livewire\Dashboard\Exam;

use App\Models\Exam;
use Livewire\Component;
use \Illuminate\View\View;
use App\Models\ExamSlot;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ExamSlotCrudChild extends Component
{
    use  AuthorizesRequests;
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
        'item.name' => 'required|string|max:255',
        'item.description' => 'nullable|string|max:10000',
        'item.total_marks' => 'required|integer|min:1',
        'item.exam_id' => 'required',
    ];

    /**
     * @var array
     */
    protected $validationAttributes = [
        'item.name' => 'Name',
        'item.description' => 'Description',
        'item.total_marks' => 'Total Marks',
        'item.exam_id' => 'Exam Id',
    ];

    /**
     * @var bool
     */
    public $confirmingItemDeletion = false;
    
    public $exam;

    public $examslot;

    /**
     * @var bool
     */
    public $confirmingItemCreation = false;

    /**
     * @var bool
     */
    public $confirmingItemEdit = false;

    public function mount(){
        $this->exam=Exam::all();
    }
    public function render(): View
    {
        return view('livewire.dashboard.exam.exam-slot-crud-child');
    }

    public function showDeleteForm(ExamSlot $examslot): void
    {
        $this->authorize('delete', [$examslot, 'exam slot']);
        $this->confirmingItemDeletion = true;
        $this->examslot = $examslot;
    }

    public function deleteItem(): void
    {
        $this->authorize('delete', [$this->examslot, 'exam slot']);
        $this->examslot->delete();
        $this->confirmingItemDeletion = false;
        $this->examslot = '';
        $this->reset(['item']);
        $this->emitTo('dashboard.exam.exam-slot-crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Deleted Successfully');
    }
 
    public function showCreateForm(): void
    {
        $this->authorize('create', [ExamSlot::class, 'exam slot']);
        $this->confirmingItemCreation = true;
        $this->resetErrorBag();
        $this->reset(['item']);
    }

    public function createItem(): void
    {
        $this->authorize('create', [ExamSlot::class, 'exam slot']);
        $this->validate();
        $item = ExamSlot::create([
            'name' => $this->item['name'], 
            'description' => $this->item['description'], 
            'total_marks' => $this->item['total_marks'], 
            'exam_id' => $this->item['exam_id'], 
        ]);
        $this->confirmingItemCreation = false;
        $this->emitTo('dashboard.exam.exam-slot-crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Added Successfully');
    }
 
    public function showEditForm(ExamSlot $examslot): void
    {
        $this->authorize('update', [$examslot, 'exam slot']);
        $this->resetErrorBag();
        $this->item = $examslot;
        $this->confirmingItemEdit = true;
        $this->examslot = $examslot;
    }

    public function editItem(): void
    {
        $this->authorize('update', [$this->examslot, 'exam slot']);
        $this->validate();
        $this->item->save();
        $this->confirmingItemEdit = false;
        $this->examslot = '';
        $this->emitTo('dashboard.exam.exam-slot-crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Updated Successfully');
    }

}
