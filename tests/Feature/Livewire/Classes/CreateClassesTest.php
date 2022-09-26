<?php

namespace Tests\Feature\Livewire\classes;

use App\Http\Livewire\Dashboard\classes\CrudChild;
use App\Models\Classes;
use App\Models\User;
use App\Traits\FeatureTestTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CreateclassesTest extends TestCase
{
    use RefreshDatabase;
    use FeatureTestTrait, AuthorizesRequests;


    //test view all classes cannot be accessed by unauthorised users
    public function test_view_all_classes_cannot_be_accessed_by_unauthorised_users()
    {
        $this->unauthorized_user();
        Livewire::test('dashboard.classes.crud')
            ->assertForbidden();
    }

    //test view all classes can be accessed by authorised users
    public function test_if_only_classes_under_given_school_can_be_seen_accessed_by_authorised_users()
    {
        $this->withoutExceptionHandling();


        // make fake user && assign role && acting as that user && classes create
        $user = User::factory()->create();

        Classes::factory()->create(['class_name' => 'Waziribig', 'school_id' => 1]);

        Classes::factory()->create(['class_name' => 'notttt', 'school_id' => 2]);

        $user->assignRole('Admin');

        // check if user has given permission/gate   
        $user->can('viewAny', [Classes::class, 'class']);

        Livewire::actingAs($user)
            ->test('dashboard.classes.crud')
            ->assertOk()
            ->assertSee('Waziribig')
            ->assertDontSee('notttt');
    }


    /** @test */
    public function blade_template_is_wired_properly()
    {
        $this->withoutExceptionHandling();


        Livewire::test('dashboard.classes.crud-child')
            ->assertSeeHtml('wire:model.defer="item.class_name"')
            ->assertSeeHtml('wire:model.defer="item.class_code"')
            ->assertSeeHtml('wire:model.defer="item.section"')
            ->assertSeeHtml('wire:model.defer="item.class_description"')
            ->assertSeeHtml('wire:click="createItem()"');
    }


    /** @test  */

    public function unauthorized_user_can_not_create_classes()
    {

        Livewire::actingAs(User::factory()->create())
            ->test(CrudChild::class)
            ->set('item.class_name', 'waziri')
            ->set('item.section', \App\Enums\ClassSectionEnum::A)
            ->set('item.class_code', 'waziriallyamir@gmail.com')
            ->set('item.class_description', '0653062266')
            ->call('createItem')
            ->assertForbidden();
    }

    /** @test  */

    public function authorized_user_can_create_classes()
    {
        // make fake user && assign role && acting as that user
        $user1 = User::factory()->create();
        $user1->assignRole('admin');

        // check if user has given permission/gate   
        $user1->can('create', [$user1, 'classes']);

        Livewire::actingAs($user1)
            ->test(CrudChild::class)
            ->set('item.class_name', 'waziri')
            ->set('item.section', \App\Enums\ClassSectionEnum::A)
            ->set('item.class_code', 'waziriallyamir@gmail.com')
            ->set('item.class_description', '0653062266')
            ->call('createItem');

        // test if data exist in database
        $this->assertDatabaseHas('classes', [
            'class_name' => 'waziri',
            'class_description'=>'0653062266',
        ]);
    }

    //test unauthorised users cannot edit classes
    public function test_unauthorised_users_cannot_edit_classes()
    {
        // make fake user &&  acting as that user and classes
        $user = User::factory()->create();
        $classes = Classes::factory()->create();
        Livewire::actingAs($user)
            ->test(CrudChild::class, ['item' => $classes])
            ->call('showEditForm', $classes)
            ->set('item.class_name', 'waziribig')
            ->call('editItem')
            ->assertForbidden();
    }

    //test authorised users can edit classes
    public function test_authorised_users_can_edit_classes()
    {
        $this->withoutExceptionHandling();

        // make fake user && assign role && acting as that user
        $user1 = User::factory()->create();
        $user1->assignRole('admin');
        $classes = Classes::factory()->create();

        // check if user has given permission/gate   
        $user1->can('update', [$user1, 'classes']);

        // test
        Livewire::actingAs($user1)
            ->test(CrudChild::class, ['item' => $classes])
            ->call('showEditForm', $classes)

            ->set('item.class_name', 'waziribig')

            ->call('editItem');

        // test if data exist in database
        $this->assertDatabaseHas('classes', [
            'class_name' => 'waziribig'
        ]);
    }

    //test unauthorised users cannot edit classes
    public function test_unauthorised_users_cannot_delete_classes()
    {
        $user = User::factory()->create();
        $classes = Classes::factory()->create();
        Livewire::actingAs($user)
            ->test(CrudChild::class, ['item' => $classes])
            ->call('deleteItem', $classes)
            ->assertForbidden();
    }
    //test authorised users can edit classes

    public function test_authorised_users_can_delete_classes()
    {
        // make fake user && assign role && acting as that user
        $user = User::factory()->create();
        $user->assignRole('admin');
        $user->can('delete', [$user, 'classes']);
        $classes = Classes::factory()->create();

        // test
        Livewire::actingAs($user)
            ->test(CrudChild::class, ['classes' => $classes])
            ->call('showDeleteForm', $classes)
            ->call('deleteItem');

        // test if data is softdeleted
        $this->assertSoftDeleted($classes);
    }
}
