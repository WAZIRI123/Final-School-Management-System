<?php

namespace App\Http\Livewire\Dashboard\TimeTable;

use App\Models\Classes;
use App\Models\Subject;
use App\Models\Timetable;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use \Illuminate\View\View;

use App\Models\TimeTableTimeSlot;
use App\Models\WeekDay;
use App\Rules\IsCompositeUnique;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ManageTimeTableRecordSlot extends Component
{
    use WithPagination, AuthorizesRequests;

    /**
     * @var array
     */
    protected $listeners = ['refresh' => '$refresh'];
    /**
     * @var string
     */
    public $sortBy = 'id';

    /**
     * @var bool
     */
    public $sortAsc = true;

    /**
     * @var int
     */
    public $per_page = 15;


    public $selected_weekday;

    public $selected_subject;
    public $selectedAllSlots = false;

    public $selectedSlots=[];

    public $selected_class;

    public $classes;
    public $weekdays;
    public $subjects;
    public $timetables;
    
    public function mount()
    {
        $this->classes = Classes::all();
        $this->weekdays = WeekDay::all();
        $this->subjects = Subject::all();
    }

    protected function rules()
    {
        return [
            'selected_class'   => ['required','exists:classes,id'],
            'selected_subject'   => ['required','exists:subjects,id'],
            'selected_weekday' => ['required','exists:week_days,id',new IsCompositeUnique('time_table_time_slot_week_day', ['week_day_id' => $this->selected_weekday, 'time_table_time_slot_id' => $this->selectedSlots])],
            'selectedSlots.*'   => 'nullable|exists:time_table_time_slots,id',
        ];
    }

    public function getSlotsProperty()
    {

        $filterOnlyTimeSlotWithinClass= function($query)  {
            $query->where('class_id', $this->selected_class);
        };

        return $this->query()
            ->with(['timetable'])
            ->whereHas('timetable', $filterOnlyTimeSlotWithinClass)
            ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
            ->paginate($this->per_page);
    }

    public function UpdatedselectedAllSlots($value)
{
    if ($value) {
        $this->selectedSlots = $this->Slots->pluck('id')->map(function ($id) {
            return (string) $id;
        });
    } else {
        $this->reset(['selectedSlots', 'selectedAllSlots']);
    }
}

    //graduate student method
    public function SyncSlotsWithDays()
    {
    
        $this->authorize('create timetabletimeslot', TimeTableTimeSlot::class);
        $this->validate();
        //get all students for promotion
        $slots = TimeTableTimeSlot::whereIn('id', $this->selectedSlots)->get();
        //make sure selectedSlots is present
        if ($this->selectedSlots == null) {
            return session()->flash('danger', 'Please select slot/slots to sync');
        }

        // sync slots to subjects
        foreach ($slots as $slot) {
         

                $slot->weekdays()->attach($this->selected_weekday,['subject_id'=>$this->selected_subject]);
           
        }
        $this->reset(['selectedSlots']);
        $this->emitTo('livewire-toast', 'show', 'TimeTableRecord Created Successfuly');
    }

    public function render(): View
    {
        $this->authorize('viewAny', [Timetable::class, 'timetable']);

        $results = $this->Slots;

        return view('livewire.dashboard.time-table.manage-time-table-record-slot', [
            'results' => $results
        ]);
    }

    public function sortBy(string $field): void
    {
        if ($field == $this->sortBy) {
            $this->sortAsc = !$this->sortAsc;
        }
        $this->sortBy = $field;
    }

    public function updatingPerPage(): void
    {
        $this->resetPage();
    }

    public function query(): Builder
    {
        return TimeTableTimeSlot::query();
    }
}
