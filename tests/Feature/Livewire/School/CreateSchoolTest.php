<?php

namespace Tests\Feature\Livewire\School;

use App\Http\Livewire\Dashboard\School\CrudChild;
use App\Models\School;
use App\Traits\FeatureTestTrait;

use Livewire\Livewire;
use Tests\TestCase;

class CreateSchoolTest extends TestCase
{
   
    use FeatureTestTrait;

    //test view all schools cannot be accessed by unauthorised users

    public function test_view_all_schools_cannot_be_accessed_by_unauthorised_users()
    {
        $this->unauthorized_user();
        Livewire::test('dashboard.school.crud')
             ->assertForbidden();
    }

    /** @test */
    public function blade_template_is_wired_properly()
    {
        $this->withoutExceptionHandling();
        Livewire::test('dashboard.school.crud-child')
            ->assertSeeHtml('wire:model.defer="item.name"')
            ->assertSeeHtml('wire:model.defer="item.email"')
            ->assertSeeHtml('wire:model.defer="item.initials"')
            ->assertSeeHtml('wire:model.defer="item.phone"')
            ->assertSeeHtml('wire:model.defer="item.code"')
            ->assertSeeHtml('wire:model.defer="item.address"')
            ->assertSeeHtml('wire:click="createItem()"')
            ->assertSeeHtml('wire:click="editItem()"');
    }

    /** @test  */

    public function authorized_user_can_create_school()
    {
        $this->withoutExceptionHandling();

       $this->authorized_user(['create school']);

        Livewire::test(CrudChild::class)
            ->set('item.name', 'waziri')
            ->set('item.email', 'waziriallyamir@gmail.com')
            ->set('item.code', 'SC002')
            ->set('item.phone', '0653039317')
            ->set('item.address', 'moshimoshimoshimoshi')
            ->set('item.initials', 'wz')
            ->call('createItem');

        $this->assertDatabaseHas('schools', [
            'name' => 'waziri',
            'code' => 'SC002'
        ]);
    }
    /** @test  */

    public function unauthorized_user_can_not_create_school()
    {
        $this->unauthorized_user();
        Livewire::
             test(CrudChild::class)
             ->set('item.name', 'waziri')
             ->set('item.email', 'waziriallyamir@gmail.com')
             ->set('item.code', 'SC002')
             ->set('item.phone', '0653039317')
             ->set('item.address', 'moshimoshimoshimoshi')
             ->set('item.initials', 'wz')
             ->call('createItem')
            ->assertForbidden();
    }
    //test unauthorised users cannot edit schools

    public function test_unauthorised_users_cannot_edit_schools()
    {
        $this->unauthorized_user();
        $school = School::factory()->create();
        Livewire::
             test(CrudChild::class, ['item' => $school])
            ->call('showEditForm', $school)
            ->set('item.address', 'waziribigwassdd')
            ->call('editItem', $school)
            ->assertForbidden();
    }

    //test authorised users can edit schools

    public function test_authorised_users_can_edit_schools()
    {
        $this->withoutExceptionHandling();
        $this->authorized_user(['update school']);

        $school = School::factory()->create();

        Livewire::
             test(CrudChild::class, ['item' => $school])
            ->call('showEditForm', $school)
            ->set('item.address', 'waziribigwazi')
            ->call('editItem', $school);

        $this->assertDatabaseHas('schools', [
            'address' => 'waziribigwazi'
        ]);


    }
    //test unauthorised users cannot edit schools

    public function test_unauthorised_users_cannot_delete_schools()
    {
        $this->unauthorized_user();
        $school = school::factory()->create();
        Livewire::
             test(CrudChild::class, ['item' => $school])
            ->call('deleteItem', $school)
            ->assertForbidden();
    }
    //test authorised users can edit schools

    public function test_authorised_users_can_delete_schools()
    {
        $this->authorized_user(['delete school']);
        $user = School::factory()->create();
        $school = School::factory()->create();
        Livewire::
             test(CrudChild::class, ['school' => $school])
            ->call('showDeleteForm', $school)
            ->call('deleteItem', $school);

        $this->assertSoftDeleted($school);
    }
}
