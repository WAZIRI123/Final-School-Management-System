<?php

namespace App\Http\Livewire;

use Livewire\Component;
use \Illuminate\View\View;
use App\Models\Promotion;

class WertwertChild extends Component
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
        'item.old_class_id' => '',
        'item.new_class_id' => '',
        'item.old_section' => '',
        'item.new_section' => '',
        'item.academic_year_id' => '',
        'item.students' => '',
        'item.school_id' => '',
        'item.created_at' => '',
        'item.updated_at' => '',
    ];

    /**
     * @var array
     */
    protected $validationAttributes = [
        'item.old_class_id' => 'Old Class Id',
        'item.new_class_id' => 'New Class Id',
        'item.old_section' => 'Old Section',
        'item.new_section' => 'New Section',
        'item.academic_year_id' => 'Academic Year Id',
        'item.students' => 'Students',
        'item.school_id' => 'School Id',
        'item.created_at' => 'Created At',
        'item.updated_at' => 'Updated At',
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
        return view('livewire.wertwert-child');
    }

    public function showDeleteForm(int $id): void
    {
        $this->confirmingItemDeletion = true;
        $this->primaryKey = $id;
    }

    public function deleteItem(): void
    {
        Promotion::destroy($this->primaryKey);
        $this->confirmingItemDeletion = false;
        $this->primaryKey = '';
        $this->reset(['item']);
        $this->emitTo('wertwert', 'refresh');
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
        $item = Promotion::create([
            'old_class_id' => $this->item['old_class_id'] ?? '', 
            'new_class_id' => $this->item['new_class_id'] ?? '', 
            'old_section' => $this->item['old_section'] ?? '', 
            'new_section' => $this->item['new_section'] ?? '', 
            'academic_year_id' => $this->item['academic_year_id'] ?? '', 
            'students' => $this->item['students'] ?? '', 
            'school_id' => $this->item['school_id'] ?? '', 
            'created_at' => $this->item['created_at'] ?? '', 
            'updated_at' => $this->item['updated_at'] ?? '', 
        ]);
        $this->confirmingItemCreation = false;
        $this->emitTo('wertwert', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Added Successfully');
    }
 
    public function showEditForm(Promotion $promotion): void
    {
        $this->resetErrorBag();
        $this->item = $promotion;
        $this->confirmingItemEdit = true;
    }

    public function editItem(): void
    {
        $this->validate();
        $this->item->save();
        $this->confirmingItemEdit = false;
        $this->primaryKey = '';
        $this->emitTo('wertwert', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Updated Successfully');
    }

}
