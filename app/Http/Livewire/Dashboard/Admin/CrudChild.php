<?php

namespace App\Http\Livewire\Dashboard\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use \Illuminate\View\View;
use App\Models\Admin;
use App\Models\User;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;


class CrudChild extends Component
{
    use AuthorizesRequests, WithFileUploads;

    public $item;
    public $admin;
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
    protected function rules()
    {
        return [
        'item.admission_no' => 'required',
        'item.name' => 'required',
        'item.email' =>['required','email',Rule::unique('users','email')->ignore($this->user->id)->whereNull('deleted_at')],
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
        'item.gender' => 'Gender',
        'item.phone' => 'Phone',
        'profile_picture' => 'profile',
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

    public function showDeleteForm(Admin $admin): void
    {
        $this->confirmingItemDeletion = true;
        $this->admin = $admin;
    }

    public function deleteItem(Admin $admin): void
    {
        $this->authorize('delete', [$admin->user, 'admin']);
        User::find($this->admin->user_id)->delete();
        $this->admin->delete();
        $this->confirmingItemDeletion = false;
        $this->primaryKey = '';
        $this->reset(['item']);
        $this->emitTo('dashboard.admin.crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Deleted Successfully');
    }

    public function showCreateForm(): void
    {
        $this->authorize('create', [User::class, 'admin']);
        $this->confirmingItemCreation = true;
        $this->resetErrorBag();
        $this->reset(['item','profile_picture']);
        $this->admission_no = $this->item['admission_no'] = IdGenerator::generate(['table' => 'admins', 'field' => 'admission_no', 'length' => 5, 'prefix' => 'AD']);

        $this->users = User::orderBy('name')->get();
    }
    
    public function render()
    {
        return view('livewire.dashboard.admin.crud-child');
    }

    public function createItem(): void
    {
        $this->authorize('create', [User::class, 'admin']);

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
        $user->assignRole('admin');
        Admin::create([
            'user_id' => $user->id,
            'admission_no' => $this->item['admission_no'],
            'gender' => $this->item['gender'],
            'phone' => $this->item['phone'],
            'dateofbirth' => $this->item['dateofbirth'],
            'current_address' => $this->item['current_address'],
            'permanent_address' => $this->item['permanent_address'],
        ]);
        DB::commit();
        $this->confirmingItemCreation = false;
        $this->emitTo('dashboard.admin.crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Added Successfully');
    }

    public function showEditForm(Admin $admin): void
    {
        $this->authorize('update', [$admin->user, 'admin']);
        $this->resetErrorBag();
        $this->reset(['profile_picture']);
        $this->admin=$admin;
        $this->user=$admin->user;
        $this->item['admission_no'] = $admin->admission_no;
        $this->item['gender']=$admin->gender;
        $this->item['phone']=$admin->phone;
        $this->item['dateofbirth']=$admin->dateofbirth;
        $this->item['current_address']=$admin->current_address;
        $this->item['permanent_address']=$admin->permanent_address;
        $this->item['name']=$admin->user->name;
        $this->item['email']=$admin->user->email;
        $this->oldImage=$admin->user->profile_picture;
        $this->confirmingItemEdit = true;

        $this->users = User::orderBy('name')->get();
    }

    public function editItem(Admin $admin): void
    {
        $this->authorize('update', [$admin->user, 'admin']);
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
        $this->admin->update([
            'admission_no' => $this->item['admission_no'],
            'gender' => $this->item['gender'],
            'phone' => $this->item['phone'],
            'dateofbirth' => $this->item['dateofbirth'],
            'current_address' => $this->item['current_address'],
            'permanent_address' => $this->item['permanent_address'],
        ]);

        DB::commit();
        $this->confirmingItemEdit = false;

        $this->primaryKey = '';
        $this->emitTo('dashboard.admin.crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Updated Successfully');
    }



}
