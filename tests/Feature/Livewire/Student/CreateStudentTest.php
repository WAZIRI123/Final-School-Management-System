<?php

namespace Tests\Feature\Livewire\Student;

use App\Http\Livewire\Dashboard\Student\CrudChild;
use App\Models\Student;
use App\Models\User;
use Tests\TestCase;
use App\Traits\FeatureTestTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

class CreateStudentTest extends TestCase
{
    use RefreshDatabase;
    use FeatureTestTrait, AuthorizesRequests;

    //test view all students cannot be accessed by unauthorised users

    public function test_view_all_students_cannot_be_accessed_by_unauthorised_users()
    {
        $this->unauthorized_user();
        Livewire::test('dashboard.student.crud')
            ->assertForbidden();
    }

     //test view all students can be accessed by authorised users
     public function test_if_only_student_under_given_school_can_be_seen_accessed_by_authorised_users()
     {
         $this->withoutExceptionHandling();
 
 
         // make fake user && assign role && acting as that user && parent create
         $user = User::factory()->create();
         Student::factory()->for($user)->create(['permanent_address'=> 'Waziribig','status'=>\App\Enums\StudentStatusEnum::Active]);
         $user1 = User::factory()->create(['school_id'=>2]);
         Student::factory()->for($user1)->create(['permanent_address'=> 'notttty','status'=>\App\Enums\StudentStatusEnum::Inactive]);
 
         $user->assignRole('Admin');
 
          // check if user has given permission/gate   
          $user->can('viewAny', [User::class, 'student']);
 
         Livewire::actingAs($user)
                 ->test('dashboard.student.crud')
                  ->assertOk()
                  ->assertSee('Waziribig')
                  ->assertDontSee('notttty');
 
     }

    /** @test */
    public function blade_template_is_wired_properly()
    {
        $this->withoutExceptionHandling();


        Livewire::test('dashboard.student.crud-child')
            ->assertSeeHtml('wire:model.defer="item.name"')
            ->assertSeeHtml('wire:model.defer="item.email"')
            ->assertSeeHtml('wire:model.defer="item.gender"')
            ->assertSeeHtml('wire:model.defer="item.phone"')
            ->assertSeeHtml('wire:model.defer="item.dateofbirth"')
            ->assertSeeHtml('wire:model.defer="item.current_address"')
            ->assertSeeHtml('wire:model.defer="item.permanent_address"')
            ->assertSeeHtml('wire:model.defer="item.parent_id"')
            ->assertSeeHtml('wire:model.defer="item.class_id"')
            ->assertSeeHtml('wire:model.defer="profile_picture"')
            ->assertSeeHtml('wire:click="createItem()"');
    }

    /** @test  */

    public function authorized_user_can_create_student()
    {
        $this->withoutExceptionHandling();

        //make fake disk
        Storage::fake('public');

        // make fake image
        $imagename = 'post-image.png';
        $image = UploadedFile::fake()->image('post-image.png');

        // make fake user && assign permission && acting as that user
        $user = User::factory()->create();
        $user->givePermissionTo('create student');
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $this->actingAs($user);

        // test 
        Livewire::test(CrudChild::class)
            ->set('item.name', 'waziri')
            ->set('profile_picture', $image)
            ->set('item.email', 'waziriallyamir@gmail.com')
            ->set('item.admission_no', '0653062266')
            ->set('item.gender', 'male')
            ->set('item.phone', '0653039317')
            ->set('item.dateofbirth', '2000/02/20')
            ->set('item.current_address', 'moshi')
            ->set('item.permanent_address', 'moshi')
            ->set('item.parent_id', 1)
            ->set('item.class_id', 1)
            ->call('createItem');

        // test if image exist
        Storage::disk('public')->assertExists('img/profile_picture/upload/' . $imagename);

        // test if data exist in database
        $this->assertDatabaseHas('students', [
            'class_id' => 1,
            'permanent_address' => 'moshi'
        ]);
    }
    /** @test  */

    public function unauthorized_user_can_not_create_student()
    {

        Livewire::actingAs(User::factory()->create())
            ->test(CrudChild::class)
            ->set('item.name', 'waziri')
            ->set('item.email', 'waziriallyamir@gmail.com')
            ->set('item.admission_no', '0653062266')
            ->set('item.gender', 'male')
            ->set('item.phone', '0653039317')
            ->set('item.dateofbirth', '2000/02/20')
            ->set('item.current_address', 'moshi')
            ->set('item.permanent_address', 'moshi')
            ->set('item.parent_id', 1)
            ->set('item.class_id', 1)
            ->call('createItem')
            ->assertForbidden();
    }
    //test unauthorised users cannot edit students

    public function test_unauthorised_users_cannot_edit_students()
    {
        // make fake user &&  acting as that user and student
        $user = User::factory()->create();
        $student = Student::factory()->create();
        Livewire::actingAs($user)
            ->test(CrudChild::class, ['item' => $student])
            ->call('showEditForm', $student)
            ->set('item.permanent_address', 'waziribig')
            ->call('editItem', $student)
            ->assertForbidden();
    }

    //test authorised users can edit students
    public function test_authorised_users_can_edit_students()
    {
        $this->withoutExceptionHandling();

        //make fake disk
        Storage::fake('public');

        // make fake image
        $imagename = 'post-image.png';
        Storage::disk('public')
            ->putFileAs('', UploadedFile::fake()->image($imagename), $imagename);

        // make fake user && assign role && acting as that user
        $user1 = User::factory()->create(['profile_picture' => $imagename, 'remember_token' => null]);
        $user1->assignRole('admin');
        $student = Student::factory()->for($user1)->create();

        // check if user has given permission/gate   
        $user1->can('update', [$user1, 'student']);

        // make fake image2
        $imagename2 = 'post-image2.png';
        $image2 = UploadedFile::fake()->image($imagename2);

        // test
        Livewire::actingAs($user1)
            ->test(CrudChild::class, ['item' => $student, 'oldImage' => $student->user->profile_picture])
            ->call('showEditForm', $student)

            ->set('item.permanent_address', 'waziribig')

            ->set('profile_picture', $image2)

            ->call('editItem', $student);

        // test if data exist in database
        $this->assertDatabaseHas('students', [
            'permanent_address' => 'waziribig'
        ]);
        $this->assertDatabaseHas('users', [
            'profile_picture' => 'img/profile_picture/upload/' . $imagename2
        ]);

        // test if image exist and match updated one
        Storage::disk('public')->assertMissing('img/profile_picture/upload/' . $imagename);

        Storage::disk('public')->assertExists('img/profile_picture/upload/' . $imagename2);
    }

    //test unauthorised users cannot edit students
    public function test_unauthorised_users_cannot_delete_students()
    {
        $user = User::factory()->create();
        $student = Student::factory()->create();
        Livewire::actingAs($user)
            ->test(CrudChild::class, ['item' => $student])
            ->call('deleteItem', $student)
            ->assertForbidden();
    }
    //test authorised users can edit students

    public function test_authorised_users_can_delete_students()
    {
        // make fake user && assign role && acting as that user
        $user = User::factory()->create();
        $user->assignRole('admin');
        $user->can('delete', [$user, 'student']);
        $student = Student::factory()->for($user)->create();

        // test
        Livewire::actingAs($user)
            ->test(CrudChild::class, ['student' => $student])
            ->call('showDeleteForm', $student)
            ->call('deleteItem', $student);

        // test if data is softdeleted
        $this->assertSoftDeleted($student);
    }
}
