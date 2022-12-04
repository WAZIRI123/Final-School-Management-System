<?php

namespace App\Http\Livewire\Dashboard\Parent;

use Livewire\Component;
use \Illuminate\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Parents;
use App\Models\User;
use App\Services\User\UserService;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;

class CrudChild extends Component
{
    use AuthorizesRequests, WithFileUploads;

    public $item;
    public  $user;
    public $parent;
    public $oldImage;
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
    public $users = [];

    /**
     * @var array
     */
    protected function rules()
    {
    return[
        'item.gender' => 'required',
        'item.name' => 'required',
        'item.email' =>['required','email',Rule::unique('users','email')->ignore($this->user->id)->whereNull('deleted_at')],
        'item.admission_no' => 'required',
        'item.phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        'item.current_address' => 'required',
        'item.permanent_address' => 'required',
    ];
}

    /**
     * @var array
     */
    protected $validationAttributes = [
        'item.gender' => 'Gender',
        'item.admission_no' => 'Admission No',
        'item.email' =>'Email',
        'item.phone' => 'Phone',
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
        return view('livewire.dashboard.parent.crud-child');
    }

    public function showDeleteForm(Parents $parent): void
    {
        $this->authorize('delete', [$parent->user, 'parent']);
        $this->confirmingItemDeletion = true;
        $this->parent = $parent;
    }

    public function deleteItem(Parents $parent): void
    {
        $this->authorize('delete', [$parent->user, 'parent']);
        User::find($this->parent->user_id)->delete();
        $this->parent->delete();
        $this->confirmingItemDeletion = false;
        $this->reset(['item']);
        $this->emitTo('dashboard.parent.crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Deleted Successfully');
    }
 
    public function showCreateForm(): void
    {
        $this->authorize('create', [User::class, 'parent']);
        $this->confirmingItemCreation = true;
        $this->resetErrorBag();
        $this->reset(['item','profile_picture']);
        $this->admission_no = $this->item['admission_no'] = IdGenerator::generate(['table' => 'parents', 'field' => 'admission_no', 'length' => 5, 'prefix' => 'P']);
        
    }

    public function createItem(): void
    {
        $this->authorize('create', [User::class, 'parent']);
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
        $user->assignRole('parent');
       Parents::create([
            'gender' => $this->item['gender'], 
            'admission_no' => $this->item['admission_no'], 
            'phone' => $this->item['phone'], 
            'current_address' => $this->item['current_address'], 
            'permanent_address' => $this->item['permanent_address'], 
            'user_id' => $user->id,
        ]);
        DB::commit();
        $this->confirmingItemCreation = false;
        $this->emitTo('dashboard.parent.crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Added Successfully');
    }
 
    public function showEditForm(Parents $parent): void
    {

        $this->authorize('update', [$parent->user, 'parent']);
        $this->resetErrorBag();
        $this->reset(['profile_picture']);
        $this->parent = $parent;
        $this->user=$parent->user;
        $this->item['admission_no'] = $parent->admission_no;
        $this->item['gender']=$parent->gender;
        $this->item['phone']=$parent->phone;
        $this->item['current_address']=$parent->current_address;
        $this->item['permanent_address']=$parent->permanent_address;
        $this->item['name']=$parent->user->name;
        $this->item['email']=$parent->user->email;
        $this->oldImage=$parent->user->profile_picture;
        $this->confirmingItemEdit = true;

        $this->users = User::orderBy('name')->get();
    }

    public function editItem(Parents $parent): void
    {
        $this->authorize('update', [$parent->user, 'parent']);
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
        $this->parent->update([
            'admission_no' => $this->item['admission_no'],
            'gender' => $this->item['gender'],
            'phone' => $this->item['phone'],
            'current_address' => $this->item['current_address'],
            'permanent_address' => $this->item['permanent_address'],
        ]);
        DB::commit();
        $this->confirmingItemEdit = false;

        $this->emitTo('dashboard.parent.crud', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Updated Successfully');
    }

}
