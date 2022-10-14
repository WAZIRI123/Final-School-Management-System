<?php

namespace App\Http\Livewire\Dashboard\TimeTable;

use App\Models\Timetable;
use Livewire\Component;
use \Illuminate\View\View;
use App\Models\TimeTableTimeSlot;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TimeSlotCrudChild extends Component
{
    use AuthorizesRequests;
    public $item;

    public $timetable;
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
        'item.start_time' => 'required|date_format:H:i',
        'item.stop_time' => 'required|date_format:H:i|after:start_time',
        'item.timetable_id' => 'required',
    ];

    /**
     * @var array
     */
    protected $validationAttributes = [
        'item.stop_time' => 'Stop Time',
        'item.start_time' => 'Start Time',
        'item.timetable_id' => 'Timetable Id',
    ];

    /**
     * @var bool
     */
    public $confirmingItemDeletion = false;


    public $timetabletimeslot;

    /**
     * @var bool
     */
    public $confirmingItemCreation = false;

    /**
     * @var bool
     */
    public $confirmingItemEdit = false;

    public function mount(){

        $this->timetable=Timetable::all();
  
      }
    public function render(): View
    {
        return view('livewire.dashboard.time-table.time-slot-crud-child');
    }

    public function showDeleteForm(TimeTableTimeSlot $timetabletimeslot): void
    {
        $this->authorize('delete', [$timetabletimeslot, 'timetabletimeslot']);
        $this->confirmingItemDeletion = true;
        $this->timetabletimeslot = $timetabletimeslot;
    }

    public function deleteItem(): void
    {
        $this->authorize('delete', [$this->timetabletimeslot, 'timetabletimeslot']);

        $this->timetabletimeslot->delete();

        $this->confirmingItemDeletion = false;
        $this->timetabletimeslot = '';
        $this->reset(['item']);
        $this->emitTo('dashboard.time-table.time-slot-crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Deleted Successfully');
    }
 
    public function showCreateForm(): void
    {
        $this->authorize('create', [TimeTableTimeSlot::class, 'timetabletimeslot']);

        $this->confirmingItemCreation = true;
        $this->resetErrorBag();
        $this->reset(['item']);
    }

    public function createItem(): void
    {
        $this->authorize('create', [TimeTableTimeSlot::class, 'timetabletimeslot']);

        $this->validate();
        $item = TimeTableTimeSlot::create([
            'stop_time' => $this->item['stop_time'], 
            'start_time' => $this->item['start_time'], 
            'timetable_id' => $this->item['timetable_id'], 
        ]);
        $this->confirmingItemCreation = false;
        $this->emitTo('dashboard.time-table.time-slot-crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Added Successfully');
    }
 
    public function showEditForm(TimeTableTimeSlot $timetabletimeslot): void
    {
        $this->authorize('update', [$timetabletimeslot, 'timetabletimeslot']);

        $this->resetErrorBag();
        $this->item = $timetabletimeslot;
        $this->confirmingItemEdit = true;
        $this->timetabletimeslot = $timetabletimeslot;
    }

    public function editItem(): void
    {
        $this->authorize('update', [$this->timetabletimeslot, 'timetabletimeslot']);
        $this->validate();
        $this->item->save();
        $this->confirmingItemEdit = false;
        $this->timetabletimeslot = '';
        $this->emitTo('dashboard.time-table.time-slot-crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Updated Successfully');
    }

}
