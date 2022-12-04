<?php

namespace App\Http\Livewire\Dashboard\Teacher;

use App\Models\Classes;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use \Illuminate\View\View;
use App\Models\Teacher;
use App\Models\User;
use App\Services\User\UserService;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class CrudChild extends Component
{
    use AuthorizesRequests, WithFileUploads;

    public $item;
    public $teacher;
    public  $user;
    public $admission_no;
    public $profile_picture;
    public $oldImage;

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
    public $users = [];
        /**
     * @var array
     */
    public $classes = [];

    /**
     * @var array
     */
    protected function rules()
    {
        return [
        'item.admission_no' => 'required',
        'item.name' => 'required',
        'item.email' =>['required','email',Rule::unique('users','email')->ignore($this->user->id)->whereNull('deleted_at')],
        'item.class_id' => 'required',
        'item.gender' => 'required',
        'item.phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        'item.dateofbirth' => 'required|date|before:' .today()->subYears(7)->format('Y-m-d'),
        'item.current_address' => 'required',
        'item.permanent_address' => 'required',
    ];
}

    /**
     * @var array
     */
    protected $validationAttributes = [
        'item.name' => 'Name',
        'item.email' => 'Email',
        'item.admission_no' => 'Admission No',
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

    public function mount(User $user)
    {
        $this->user =$user;
    }

    public function render(): View
    {
        return view('livewire.dashboard.teacher.crud-child');
    }

    public function showDeleteForm(Teacher $teacher): void
    {
        $this->authorize('delete', [$teacher->user, 'teacher']);
        $this->confirmingItemDeletion = true;
        $this->teacher = $teacher;
    }

    public function deleteItem(Teacher $teacher): void
    {
        $this->authorize('delete', [$teacher->user, 'teacher']);
        User::find($this->teacher->user_id)->delete();
        $this->teacher->delete();
        $this->confirmingItemDeletion = false;
        $this->primaryKey = '';
        $this->reset(['item']);
        $this->emitTo('dashboard.teacher.crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Deleted Successfully');
    }
 
    public function showCreateForm(): void
    {
        $this->authorize('create', [User::class, 'teacher']);
        $this->confirmingItemCreation = true;
        $this->resetErrorBag();
        $this->reset(['item','profile_picture']);
        $this->admission_no = $this->item['admission_no'] = IdGenerator::generate(['table' => 'teachers', 'field' => 'admission_no', 'length' => 5, 'prefix' => 'T']);
        $this->classes = Classes::orderBy('class_name')->get();
        $this->users = User::orderBy('name')->get();
    }

    public function createItem(): void
    {
        $this->authorize('create', [User::class, 'teacher']);
        if ($this->profile_picture) {
            $rule['profile_picture'] = 'image|mimes:jpeg,png';
        }
        $this->validate();
        if ($this->profile_picture) {
            $profile_picture=$this->profile_picture->storeAs('img/profile_picture/upload',$this->profile_picture->getClientOriginalName(),'public');
         }
        DB::beginTransaction();
        $user = User::create([
            'name' => $this->item['name'],
            'profile_picture' => $profile_picture?? auth()->user()->avatarUrl($this->item['email']) ,
            'email' => $this->item['email'],
            'school_id' => auth()->user()->school->id,
        ]);
        $user->assignRole('teacher');
        teacher::create([
            'user_id' => $user->id,
            'admission_no' => $this->item['admission_no'],
            'class_id' => $this->item['class_id'],
            'gender' => $this->item['gender'],
            'phone' => $this->item['phone'],
            'dateofbirth' => $this->item['dateofbirth'],
            'current_address' => $this->item['current_address'],
            'permanent_address' => $this->item['permanent_address'],
        ]);
        DB::commit();
        $this->confirmingItemCreation = false;
        $this->emitTo('dashboard.teacher.crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Added Successfully');
    }
 
    public function showEditForm(Teacher $teacher): void
    {
        $this->authorize('update', [$teacher->user, 'teacher']);
        $this->resetErrorBag();
        $this->reset(['profile_picture']);
        $this->teacher=$teacher;
        $this->user=$teacher->user;
        $this->item['admission_no'] = $teacher->admission_no;
        $this->item['class_id']=$teacher->class_id;
        $this->item['gender']=$teacher->gender;
        $this->item['phone']=$teacher->phone;
        $this->item['dateofbirth']=$teacher->dateofbirth;
        $this->item['current_address']=$teacher->current_address;
        $this->item['permanent_address']=$teacher->permanent_address;
        $this->item['name']=$teacher->user->name;
        $this->item['email']=$teacher->user->email;
        $this->oldImage=$teacher->user->profile_picture;
        $this->confirmingItemEdit = true;

        $this->classes = Classes::orderBy('class_name')->get();

        $this->users = User::orderBy('name')->get();
    }

    public function editItem(Teacher $teacher): void
    {
        $this->authorize('update', [$teacher->user, 'teacher']);
        $this->validate();
        if ($this->profile_picture) {
            $profile_picture=$this->profile_picture->storeAs('img/profile_picture/upload',$this->profile_picture->getClientOriginalName(),'public');
            if ($this->oldImage!=null) {
                Storage::delete($this->oldImage);
            }
         
        }
         else{
            $profile_picture=$this->oldImage;
         }
        
        DB::beginTransaction();
        $this->user->update([
            'name' => $this->item['name'],
            'email' => $this->item['email'],
            'profile_picture' => $profile_picture?? auth()->user()->avatarUrl($this->item['email']) ,
        ]);
        $this->teacher->update([
            'admission_no' => $this->item['admission_no'],
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
        $this->emitTo('dashboard.teacher.crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Updated Successfully');
    }

}
