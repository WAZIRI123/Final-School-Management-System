<?php

namespace Tests\Feature\Livewire\Teacher;

use App\Http\Livewire\Dashboard\Teacher\CrudChild;
use App\Models\School;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use App\Traits\FeatureTestTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;


class CreateTeacherTest extends TestCase
{
    use RefreshDatabase;
    use FeatureTestTrait, AuthorizesRequests;
 //test view all teachers cannot be accessed by unauthorised users

 public function test_view_all_teachers_cannot_be_accessed_by_unauthorised_users()
 {
     $this->unauthorized_user();
     Livewire::test('dashboard.teacher.crud')
         ->assertForbidden();
 }
 //test view all teacs can be accessed by authorised users
 public function test_if_only_teacher_under_given_school_can_be_seen_accessed_by_authorised_users()
 {
     $this->withoutExceptionHandling();


     // make fake user && assign role && acting as that user && parent create
     $user = User::factory()->create();
  Teacher::factory()->for($user)->create(['permanent_address'=> 'Waziribig']);
     $user1 = User::factory()->create(['school_id'=>2]);
      Teacher::factory()->for($user1)->create(['permanent_address'=> 'notttt']);

     $user->assignRole('Admin');

      // check if user has given permission/gate   
      $user->can('viewAny', [User::class, 'Teacher']);

     Livewire::actingAs($user)
             ->test('dashboard.teacher.crud')
              ->assertOk()
              ->assertSee('Waziribig')
              ->assertDontSee('notttt');

 }
 /** @test */
 public function blade_template_is_wired_properly()
 {
     $this->withoutExceptionHandling();


     Livewire::test('dashboard.teacher.crud-child')
         ->assertSeeHtml('wire:model.defer="item.name"')
         ->assertSeeHtml('wire:model.defer="item.email"')
         ->assertSeeHtml('wire:model.defer="item.gender"')
         ->assertSeeHtml('wire:model.defer="item.phone"')
         ->assertSeeHtml('wire:model.defer="item.dateofbirth"')
         ->assertSeeHtml('wire:model.defer="item.current_address"')
         ->assertSeeHtml('wire:model.defer="item.permanent_address"')
         ->assertSeeHtml('wire:model.defer="item.class_id"')
         ->assertSeeHtml('wire:model.defer="profile_picture"')
         ->assertSeeHtml('wire:click="createItem()"');
 }

 /** @test  */

 public function authorized_user_can_create_teacher()
 {
   
    $this->withoutExceptionHandling();
     //make fake disk
     Storage::fake('public');

     // make fake image
     $imagename = 'post-image.png';
     $image = UploadedFile::fake()->image($imagename);

     // make fake user && assign permission && acting as that user
     $school = School::factory()->create();
     $user = User::factory()->for($school)->create();
     $user->givePermissionTo('create teacher');
     /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
     $this->actingAs($user);

     // test 
     Livewire::test(CrudChild::class)
         ->set('item.name', 'waziri')
         ->set('profile_picture', $image)
         ->set('item.email', 'waziriallyam@gmail.com')
         ->set('item.admission_no', '0653062266')
         ->set('item.gender', 'male')
         ->set('item.phone', '0653039317')
         ->set('item.dateofbirth', '2000/02/20')
         ->set('item.current_address', 'moshi')
         ->set('item.permanent_address', 'moshi')
         ->set('item.class_id', 2)
         ->call('createItem');

 

     // test if data exist in database
     $this->assertDatabaseHas('teachers', [
         'class_id' => 2,
         'permanent_address' => 'moshi'
     ]);
 }
 /** @test  */

 public function unauthorized_user_can_not_create_teacher()
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
         ->set('item.class_id', 1)
         ->call('createItem')
         ->assertForbidden();
 }
 //test unauthorised users cannot edit teachers

 public function test_unauthorised_users_cannot_edit_teachers()
 {
     // make fake user &&  acting as that user and teacher
     $user = User::factory()->create();
     $teacher = Teacher::factory()->create();
     Livewire::actingAs($user)
         ->test(CrudChild::class, ['item' => $teacher])
         ->call('showEditForm', $teacher)
         ->set('item.permanent_address', 'waziribig')
         ->call('editItem', $teacher)
         ->assertForbidden();
 }

 //test authorised users can edit teachers
 public function test_authorised_users_can_edit_teachers()
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
     $teacher = teacher::factory()->for($user1)->create();

     // check if user has given permission/gate   
     $user1->can('update', [$user1, 'teacher']);

     // make fake image2
     $imagename2 = 'post-image2.png';
     $image2 = UploadedFile::fake()->image($imagename2);

     // test
     Livewire::actingAs($user1)
         ->test(CrudChild::class, ['item' => $teacher, 'oldImage' => $teacher->user->profile_picture])
         ->call('showEditForm', $teacher)

         ->set('item.permanent_address', 'waziribig')

         ->set('profile_picture', $image2)

         ->call('editItem', $teacher);

     // test if data exist in database
     $this->assertDatabaseHas('teachers', [
         'permanent_address' => 'waziribig'
     ]);
     $this->assertDatabaseHas('users', [
         'profile_picture' => 'img/profile_picture/upload/' . $imagename2
     ]);

     // test if image exist and match updated one
     Storage::disk('public')->assertMissing('img/profile_picture/upload/' . $imagename);

     Storage::disk('public')->assertExists('img/profile_picture/upload/' . $imagename2);
 }

 //test unauthorised users cannot edit teachers
 public function test_unauthorised_users_cannot_delete_teachers()
 {
     $user = User::factory()->create();
     $teacher = teacher::factory()->create();
     Livewire::actingAs($user)
         ->test(CrudChild::class, ['item' => $teacher])
         ->call('deleteItem', $teacher)
         ->assertForbidden();
 }
 //test authorised users can edit teachers

 public function test_authorised_users_can_delete_teachers()
 {
     // make fake user && assign role && acting as that user
     $user = User::factory()->create();
     $user->assignRole('admin');
     $user->can('delete', [$user, 'teacher']);
     $teacher = teacher::factory()->for($user)->create();

     // test
     Livewire::actingAs($user)
         ->test(CrudChild::class, ['teacher' => $teacher])
         ->call('showDeleteForm', $teacher)
         ->call('deleteItem', $teacher);

     // test if data is softdeleted
     $this->assertSoftDeleted($teacher);
 }
}
