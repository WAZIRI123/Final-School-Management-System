<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Classes;
use App\Models\Parents;
use App\Models\Student;
use App\Models\Teacher;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithFileUploads;
    use WithPagination;
    // public $totalRooms;
    public $student;
    public $teacher;
    public $parents;
    public $classes;
    public function render()
    {
        return view('livewire.dashboard.index',['students'=>Student::latest()->paginate(5)])->layoutData(['title' => 'Admin Dashboard | School Management System']);
    }
    public function mount()
    {
        $this->fill([
            'student' =>Student::latest()->count(),
            'classes' => Classes::latest()->count(),
            'teacher' => Teacher::latest()->count(),
            'parents' => Parents::latest()->count(),
        ]);
    }
}
