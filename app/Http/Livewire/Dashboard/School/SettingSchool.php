<?php

namespace App\Http\Livewire\Dashboard\School;

use App\Models\School;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class SettingSchool extends Component
{
    use AuthorizesRequests;

    public $item;

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
            'item.code' => '',
        ];
    }

    public function mount()
    {

        $this->item =School::find(auth()->user()->school_id);;
    }

    public function editItem(): void
    {
        $this->authorize('update school', $this->item);
        $this->validate();
        $this->item->save();
        $this->emitTo('dashboard.school.setting-school', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Updated Successfully');
    }

    public function render()
    {
        return view('livewire.dashboard.school.setting-school')->layoutData(['title' => ' School Setting | School Management System']);
    }
}
