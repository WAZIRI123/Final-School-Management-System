<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Profile extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $user;

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', Rule::unique('users', 'email')->ignore($this->user->id)->whereNull('deleted_at')],
            'password' => ['confirmed', Password::defaults()],
        ];
    }
    public function mount()
    {
        $this->user = User::where('id', auth()->user()->id)->first();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }
    public function updateUser()
    {

        $this->validate();
        $this->user->update(
            [
                'name' => $this->name,
                'email' => $this->email,
            ]
        );
        if ($this->password) {
            $this->user->update([
                'password' => bcrypt($this->password),
                'name' => $this->name,
                'email' => $this->email,
            ]);
        }
        $this->dispatchBrowserEvent('name-updated');
    }
    public function render()
    {
        return view('livewire.dashboard.profile',['name'=>$this->name,'email'=>$this->email])->layoutData(['title' => 'Profile Dashboard | SMS']);
    }
}
