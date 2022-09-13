<?php

namespace App\Http\Livewire\Dashboard\Student;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Classes;
use Livewire\Component;
use \Illuminate\View\View;
use App\Models\Student;
use App\Models\Parents;
use App\Models\User;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;

class CrudChild extends Component
{
   use AuthorizesRequests, WithFileUploads;


    public $item;
    public $student;
    public  $user;
    public $admission_no;
    public $profile_picture;
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
    public $parents = [];
    /**
     * @var array
     */
    public $classes = [];

    /**
     * @var array
     */
    public $users = [];

    /**
     * @var array
     */
    protected function rules()
    {
        return [
        'item.admission_no' => 'required',
        'item.parent_id' => 'required',
        'profile_picture' => 'image|mimes:jpeg,png',
        'item.name' => 'required',
        'item.email' => 'required|unique:users,email,'.$this->user->id,
        'item.class_id' => 'required',
        'item.gender' => 'required',
        'item.phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        'item.dateofbirth' => 'required|date|before:' .today()->subYears(7)->format('Y-m-d'),
        'item.current_address' => 'required',
        'item.permanent_address' => 'required',
    ];
}
public function mount(User $user)
{
    $this->user =$user;
}
    /**
     * @var array
     */
    protected $validationAttributes = [
        'item.name' => 'Name',
        'item.email' => 'Email',
        'item.admission_no' => 'Admission No',
        'item.parent_id' => 'Parent Id',
        'item.class_id' => 'Class Id',
        'item.gender' => 'Gender',
        'item.phone' => 'Phone',
        'profile_picture' => 'profile',
        'item.class_id' => 'Class',
        'item.dateofbirth' => 'Dateofbirth',
        'item.current_address' => 'Current Address',
        'item.permanent_address' => 'Permanent Address',
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
        return view('livewire.dashboard.student.crud-child');
    }


    public function showDeleteForm(Student $student): void
    {
        $this->confirmingItemDeletion = true;
        $this->student = $student;
    }

    public function deleteItem(): void
    {
        User::find($this->student->user_id)->delete();
        $this->student->delete();
        $this->confirmingItemDeletion = false;
        $this->primaryKey = '';
        $this->reset(['item']);
        $this->emitTo('dashboard.student.crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Deleted Successfully');
    }

    public function showCreateForm(): void
    {
        $this->confirmingItemCreation = true;
        $this->resetErrorBag();
        $this->reset(['item']);
        $this->admission_no = $this->item['admission_no'] = IdGenerator::generate(['table' => 'students', 'field' => 'admission_no', 'length' => 5, 'prefix' => 'ST']);
        $this->parents = Parents::orderBy('id')->get();
        $this->classes = Classes::orderBy('class_name')->get();
        $this->users = User::orderBy('name')->get();
    }

    public function createItem(): void
    {
        if ($this->profile_picture) {
           $profile_picture=$this->profile_picture->store('img/profile_picture/upload');
        }else {
            $profile_picture=$this->profile_picture=" ";
        }
        $this->validate();
        DB::beginTransaction();
        $user = User::create([
            'name' => $this->item['name'],
            'profile_picture' => $profile_picture,
            'email' => $this->item['email'],
            'school_id' => auth()->user()->school->id,
        ]);
        $user->assignRole('student');
        Student::create([
            'user_id' => $user->id,
            'admission_no' => $this->item['admission_no'],
            'parent_id' => $this->item['parent_id'],
            'class_id' => $this->item['class_id'],
            'gender' => $this->item['gender'],
            'phone' => $this->item['phone'],
            'dateofbirth' => $this->item['dateofbirth'],
            'current_address' => $this->item['current_address'],
            'permanent_address' => $this->item['permanent_address'],
        ]);
        DB::commit();
        $this->confirmingItemCreation = false;
        $this->emitTo('dashboard.student.crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Added Successfully');
    }

    public function showEditForm(Student $student): void
    {
        $this->authorize('update student', [$student, 'student']);
        $this->resetErrorBag();
        $this->student=$student;
        $this->user=$student->user;
        $this->item['admission_no'] = $student->admission_no;
        $this->item['parent_id']=$student->parent_id;
        $this->item['class_id']=$student->class_id;
        $this->item['gender']=$student->gender;
        $this->item['phone']=$student->phone;
        $this->item['dateofbirth']=$student->dateofbirth;
        $this->item['current_address']=$student->current_address;
        $this->item['permanent_address']=$student->permanent_address;
        $this->item['name']=$student->user->name;
        $this->item['email']=$student->user->email;
        $this->confirmingItemEdit = true;

        $this->parents = Parents::orderBy('id')->get();

        $this->classes = Classes::orderBy('class_name')->get();

        $this->users = User::orderBy('name')->get();
    }

    public function editItem(): void
    {
        $this->validate();
        DB::beginTransaction();
        $this->user->update([
            'name' => $this->item['name'],
            'email' => $this->item['email'],
        ]);
        $this->student->update([
            'admission_no' => $this->item['admission_no'],
            'parent_id' => $this->item['parent_id'],
            'class_id' => $this->item['class_id'],
            'gender' => $this->item['gender'],
            'phone' => $this->item['phone'],
            'dateofbirth' => $this->item['dateofbirth'],
            'current_address' => $this->item['current_address'],
            'permanent_address' => $this->item['permanent_address'],
        ]);

        DB::commit();
        $this->confirmingItemEdit = false;

        $this->primaryKey = '';
        $this->emitTo('dashboard.student.crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Updated Successfully');
    }
}
