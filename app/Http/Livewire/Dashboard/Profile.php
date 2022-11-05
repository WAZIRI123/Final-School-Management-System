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
    public function mount(){
        $this->user=User::where('id',auth()->user()->id)->first();
        $this->name=$this->user->name;
        $this->email=$this->user->email;
    }
    public function updateUser(){
        $validatedData = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', Rule::unique('users','email')->ignore($this->user->id)->whereNull('deleted_at')],
            'password' => ['confirmed',Password::defaults()],
        ]);

 
        auth()->user()->update($validatedData);
        if ($this->password) {
            auth()->user()->update(['password'=>bcrypt($validatedData['password'])]);
         
        }
        $this->dispatchBrowserEvent('name-updated');
    }
    public function render()
    {
        return view('livewire.dashboard.profile')->layoutData(['title' => 'Profile Dashboard | Grandez']);
    }
}
