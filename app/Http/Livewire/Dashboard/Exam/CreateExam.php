<?php

namespace App\Http\Livewire\Dashboard\Exam;

use Livewire\Component;
use \Illuminate\View\View;
use App\Models\Exam;
use App\Models\Semester;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CreateExam extends Component
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
        'item.name' => 'required|string|max:255',
        'item.description' => 'required|string|max:255',
        'item.semester_id' => 'required|integer|exists:semesters,id',
        'item.start_date' => 'required|date|after_or_equal:today',
        'item.stop_date' => 'required|date|after_or_equal:start_date',
        'item.active' => 'nullable',
        'item.publish_result' => 'nullable',
    ];

    /**
     * @var array
     */
    protected $validationAttributes = [
        'item.name' => 'Name',
        'item.description' => 'Description',
        'item.semester_id' => 'Semester Id',
        'item.start_date' => 'Start Date',
        'item.stop_date' => 'Stop Date',
        'item.active' => 'Active',
        'item.publish_result' => 'Publish Result',
    ];

    /**
     * @var bool
     */
    public $confirmingItemDeletion = false;

    public $exam;

    /**
     * @var bool
     */
    public $confirmingItemCreation = false;

    /**
     * @var bool
     */
    public $confirmingItemEdit = false;

    public function mount(){

        $this->semester=Semester::all();
  
      }
    public function render(): View
    {
        return view('livewire.dashboard.exam.create-exam');
    }

    public function showDeleteForm(Exam $exam): void
    {
        $this->authorize('delete', [$exam, 'exam']);
        $this->confirmingItemDeletion = true;
        $this->exam = $exam;
    }

    public function deleteItem(): void
    {
        $this->authorize('delete', [$this->exam, 'exam']);
        $this->exam->delete();
        $this->confirmingItemDeletion = false;
        $this->exam = '';
        $this->reset(['item']);
        $this->emitTo('dashboard.exam.manage-exam', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Deleted Successfully');
    }
 
    public function showCreateForm(): void
    {
        $this->authorize('create', [Exam::class, 'exam']);
        $this->confirmingItemCreation = true;
        $this->resetErrorBag();
        $this->reset(['item']);
    }

    public function createItem(): void
    {
        $this->authorize('create', [Exam::class, 'exam']);
        $this->validate();
        $item = Exam::create([
            'name' => $this->item['name'], 
            'description' => $this->item['description'], 
            'semester_id' => $this->item['semester_id'], 
            'start_date' => $this->item['start_date'], 
            'stop_date' => $this->item['stop_date'], 
            'active' => $this->item['active'], 
            'publish_result' => $this->item['publish_result'], 
        ]);
        $this->confirmingItemCreation = false;
        $this->emitTo('dashboard.exam.manage-exam', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Added Successfully');
    }
 
    public function showEditForm(Exam $exam): void
    {
        $this->authorize('update', [$exam, 'exam']);
        $this->resetErrorBag();
        $this->item = $exam;
        $this->confirmingItemEdit = true;
        $this->exam = $exam;
    }

    public function editItem(): void
    {
        $this->authorize('update', [$this->exam, 'exam']);
        $this->validate();
        $this->item->save();
        $this->confirmingItemEdit = false;
        $this->exam = '';
        $this->emitTo('dashboard.exam.manage-exam', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Updated Successfully');
    }

}
