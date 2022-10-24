<?php

namespace App\Http\Livewire\Dashboard\Exam\Manage;

use Livewire\Component;
use \Illuminate\View\View;
use App\Models\ExamRecord;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ManageExamRecordChild extends Component
{
    use  AuthorizesRequests;

    public $item;

    /**
     * @var array
     */
    protected $listeners = [
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

    public function render(): View
    {
        return view('livewire.dashboard.exam.manage.manage-exam-record-child');
    }
 
    public function showEditForm(ExamRecord $examrecord): void
    {
        $this->authorize('update', [$examrecord, 'exam record']);
        $this->resetErrorBag();
       
        $this->item = $examrecord;
        $this->confirmingItemEdit = true;
        $this->examrecord = $examrecord;
    }

    public function editItem(): void
    {
        $this->authorize('update', [$this->examrecord, 'exam record']);
        $this->validate();
        $this->item->save();
        $this->confirmingItemEdit = false;
        $this->examrecord = '';
        $this->emitTo('dashboard.exam.manage.manage-exam-record', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Updated Successfully');
    }

}
