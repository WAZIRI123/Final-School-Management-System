<?php

namespace Tests\Feature\Livewire\Student;

use App\Http\Livewire\Dashboard\Student\CrudChild;
use App\Models\Student;
use App\Models\User;
use Tests\TestCase;
use App\Traits\FeatureTestTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

class CreateStudentTest extends TestCase
{
    use RefreshDatabase;
    use FeatureTestTrait;

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
            ->assertSeeHtml('wire:click="createItem()"')
            ->assertSeeHtml('wire:click="editItem()"');
    }

    /** @test  */

    public function authorized_user_can_create_student()
    {
        $this->withoutExceptionHandling();
        Storage::fake('public');
        $imagename = 'post-image.png';
        $image = UploadedFile::fake()->image('post-image.png');
        $user = User::factory()->create();
        $user->givePermissionTo('create student');
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $this->actingAs($user);

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
        Storage::disk('public')->assertExists('img/profile_picture/upload/' . $imagename);

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
        Storage::fake('public');
        $imagename = 'post-image.png';
        $user = User::factory()->create(['profile_picture' => $imagename]);
        Storage::disk('public')
            ->putFileAs('', UploadedFile::fake()->image($imagename), $imagename);
        $user->givePermissionTo('update student');
        $student = Student::factory()->for($user)->create();

        $imagename2 = 'post-image2.png';
        $image2 = UploadedFile::fake()->image($imagename2);
        Livewire::actingAs($user)
            ->test(CrudChild::class, ['item' => $student, 'oldImage' => $student->user->profile_picture])
            ->call('showEditForm', $student)
            ->set('item.permanent_address', 'waziribig')
            ->set('profile_picture', $image2)
            ->call('editItem', $student);

        $this->assertDatabaseHas('students', [
            'permanent_address' => 'waziribig'
        ]);

        $this->assertDatabaseHas('users', [
            'profile_picture' => 'img/profile_picture/upload/' . $imagename2
        ]);

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
        $user = User::factory()->create();
        $user->givePermissionTo('delete student');
        $student = Student::factory()->for($user)->create();
        Livewire::actingAs($user)
            ->test(CrudChild::class, ['student' => $student])
            ->call('showDeleteForm', $student)
            ->call('deleteItem', $student);

            $this->assertSoftDeleted($student);
    }
}
