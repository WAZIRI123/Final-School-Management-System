<?php

namespace App\Http\Livewire\Dashboard\Exam;

use App\Models\Exam;
use Livewire\Component;
use \Illuminate\View\View;
use App\Models\ExamRecord;

class ExamRecordCrudChild extends Component
{

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
        'item.semester_id' => 'required',
        'item.class_id' => 'required',
        'item.section_id' => 'required',
        'item.exam_id' => 'required',
        'item.subject_id' => 'required',
        'item.student_id' => 'required',
        'item.marks' => 'required',
    ];

    /**
     * @var array
     */
    protected $validationAttributes = [
        'item.semester_id' => 'Semester Id',
        'item.class_id' => 'Class Id',
        'item.section_id' => 'Section Id',
        'item.exam_id' => 'Exam Id',
        'item.subject_id' => 'Subject Id',
        'item.student_id' => 'Student Id',
        'item.marks' => 'Marks',
    ];

    /**
     * @var bool
     */
    public $confirmingItemDeletion = false;


    public $examrecord;

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
        return view('livewire.dashboard.exam.exam-record-crud-child');
    }

    public function showDeleteForm(ExamRecord $examrecord): void
    {
        $this->confirmingItemDeletion = true;
        $this->examrecord= $examrecord;
    }

    public function deleteItem(): void
    {
        ExamRecord::destroy($this->primaryKey);
        $this->confirmingItemDeletion = false;
        $this->examrecord= '';
        $this->reset(['item']);
        $this->emitTo('dashboard.exam.exam-record-crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Deleted Successfully');
    }
 
    public function showCreateForm(): void
    {
        $this->confirmingItemCreation = true;
        $this->resetErrorBag();
        $this->reset(['item']);
    }

    public function createItem(): void
    {
        $this->validate();
        $item = ExamRecord::create([
            'semester_id' => $this->item['semester_id'], 
            'class_id' => $this->item['class_id'], 
            'section_id' => $this->item['section_id'], 
            'exam_id' => $this->item['exam_id'], 
            'subject_id' => $this->item['subject_id'], 
            'student_id' => $this->item['student_id'], 
            'marks' => $this->item['marks'], 
        ]);
        $this->confirmingItemCreation = false;
        $this->emitTo('dashboard.exam.exam-record-crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Added Successfully');
    }
 
    public function showEditForm(ExamRecord $examrecord): void
    {
        $this->resetErrorBag();
        $this->item = $examrecord;
        $this->confirmingItemEdit = true;
    }

    public function editItem(): void
    {
        $this->validate();
        $this->item->save();
        $this->confirmingItemEdit = false;
        $this->examrecord= '';
        $this->emitTo('dashboard.exam.exam-record-crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Updated Successfully');
    }

}
