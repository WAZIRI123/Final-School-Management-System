<?php

namespace App\Http\Livewire\Dashboard\School;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use \Illuminate\View\View;
use App\Models\School;

class CrudChild extends Component
{
    use AuthorizesRequests;

    public $item;
    public $school;

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
        return [
            'item.name' => 'required|max:255',
            'item.initials' => 'required|min:2',
            'item.address' => 'required|min:8',
            'item.email' => '',
            'item.phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:5',
            'item.semester_id' => '',
            'item.academic_year_id' => '',
            'item.code' => '',
        ];
    }

    /**
     * @var array
     */
    protected $validationAttributes = [
        'item.name' => 'Name',
        'item.initials' => 'Initials',
        'item.address' => 'Address',
        'item.email' => 'Email',
        'item.phone' => 'Phone',
        'item.semester_id' => 'Semester Id',
        'item.academic_year_id' => 'Academic Year Id',
        'item.code' => 'Code',
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

    public function mount(School $school)
    {

        $this->school = $school;
    }
    public function render(): View
    {
        return view('livewire.dashboard.school.crud-child');
    }

    public function showDeleteForm(int $id): void
    {
        $this->confirmingItemDeletion = true;
        $this->primaryKey = $id;
    }

    public function deleteItem(): void
    {
        $this->authorize('delete', $this->school);
        School::destroy($this->primaryKey);
        $this->confirmingItemDeletion = false;
        $this->primaryKey = '';
        $this->reset(['item']);
        $this->emitTo('dashboard.school.crud', 'refresh');
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
        $this->authorize('create', $this->school);
        $this->validate();
        $item = School::create([
            'name' => $this->item['name'] ?? '',
            'initials' => $this->item['initials'] ?? '',
            'address' => $this->item['address'] ?? '',
            'email' => $this->item['email'] ?? '',
            'phone' => $this->item['phone'] ?? '',
            'semester_id' => $this->item['semester_id'] ?? '',
            'academic_year_id' => $this->item['academic_year_id'] ?? '',
            'code' => $this->item['code'] ?? '',
        ]);
        $this->confirmingItemCreation = false;
        $this->emitTo('dashboard.school.crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Added Successfully');
    }

    public function showEditForm(School $school): void
    {
        $this->resetErrorBag();
        $this->item = $school;
        $this->confirmingItemEdit = true;
    }

    public function editItem(): void
    {
        $this->authorize('update', $this->school);
        $this->validate();
        $this->item->save();
        $this->confirmingItemEdit = false;
        $this->primaryKey = '';
        $this->emitTo('dashboard.school.crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Updated Successfully');
    }
}
