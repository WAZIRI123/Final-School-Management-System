<?php

namespace Tests\Feature\Livewire\Subject;

use App\Http\Livewire\Dashboard\Subject\CrudChild;
use App\Models\Subject;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use App\Traits\FeatureTestTrait;
use App\Models\User;
use Tests\TestCase;

class CreateSubjectTest extends TestCase
{
    use RefreshDatabase;
    use FeatureTestTrait, AuthorizesRequests;

    //test view all subject cannot be accessed by unauthorised users
    public function test_view_all_subject_cannot_be_accessed_by_unauthorised_users()
    {
        $this->unauthorized_user();
        Livewire::test('dashboard.subject.crud')
            ->assertForbidden();
    }

    //test view all subject can be accessed by authorised users
    public function test_if_only_subject_under_given_school_can_be_seen_accessed_by_authorised_users()
    {
        $this->withoutExceptionHandling();


        // make fake user && assign role && acting as that user && subject create
        $user = User::factory()->create();

        Subject::factory()->create(['name' => 'Waziribig', 'school_id' => 1]);

        Subject::factory()->create(['name' => 'notttt2003', 'school_id' => 2]);

        $user->assignRole('Admin');

        // check if user has given permission/gate   
        $user->can('viewAny', [Subject::class, 'subject']);

        Livewire::actingAs($user)
            ->test('dashboard.subject.crud')
            ->assertOk()
            ->assertSee('Waziribig')
            ->assertDontSee('notttt2003');
    }


    /** @test */
    public function blade_template_is_wired_properly()
    {
        $this->withoutExceptionHandling();


        Livewire::test('dashboard.subject.crud-child')
            ->assertSeeHtml('wire:model.defer="item.name"')
            ->assertSeeHtml('wire:model.defer="item.subject_code"')
            ->assertSeeHtml('wire:model.defer="item.class_id"')
            ->assertSeeHtml('wire:click="createItem()"');
    }


    /** @test  */

    public function unauthorized_user_can_not_create_subject()
    {

        Livewire::actingAs(User::factory()->create())
            ->test(CrudChild::class)
            ->set('item.name', 'waziri')
            ->set('item.subject_code', 'waziriallyamir@gmail.com')
            ->call('createItem')
            ->assertForbidden();
    }

    /** @test  */

    public function authorized_user_can_create_subject()
    {
        // make fake user && assign role && acting as that user
        $user1 = User::factory()->create();
        $user1->assignRole('admin');

        // check if user has given permission/gate   
        $user1->can('create', [$user1, 'subject']);

        Livewire::actingAs($user1)
            ->test(CrudChild::class)
            ->set('item.name', 'waziri')
            ->set('item.subject_code', '352655')
            ->set('item.class_id', '1')
            ->call('createItem');

        // test if data exist in database
        $this->assertDatabaseHas('subjects', [
            'name' => 'waziri',
            'class_id'=>'1',
        ]);
    }

    //test unauthorised users cannot edit subject
    public function test_unauthorised_users_cannot_edit_subject()
    {
        // make fake user &&  acting as that user and subject
        $user = User::factory()->create();
        $subject = subject::factory()->create();
        Livewire::actingAs($user)
            ->test(CrudChild::class, ['item' => $subject])
            ->call('showEditForm', $subject)
            ->set('item.name', 'waziribig')
            ->call('editItem')
            ->assertForbidden();
    }

    //test authorised users can edit subject
    public function test_authorised_users_can_edit_subject()
    {
        $this->withoutExceptionHandling();

        // make fake user && assign role && acting as that user
        $user1 = User::factory()->create();
        $user1->assignRole('admin');
        $subject = subject::factory()->create();

        // check if user has given permission/gate   
        $user1->can('update', [$user1, 'subject']);

        // test
        Livewire::actingAs($user1)
            ->test(CrudChild::class, ['item' => $subject])
            ->call('showEditForm', $subject)

            ->set('item.name', 'waziribig')

            ->call('editItem');

        // test if data exist in database
        $this->assertDatabaseHas('subjects', [
            'name' => 'waziribig'
        ]);
    }

    //test unauthorised users cannot edit subject
    public function test_unauthorised_users_cannot_delete_subject()
    {
        $user = User::factory()->create();
        $subject = subject::factory()->create();
        Livewire::actingAs($user)
            ->test(CrudChild::class, ['item' => $subject])
            ->call('deleteItem', $subject)
            ->assertForbidden();
    }
    //test authorised users can edit subject

    public function test_authorised_users_can_delete_subject()
    {
        // make fake user && assign role && acting as that user
        $user = User::factory()->create();
        $user->assignRole('admin');
        $user->can('delete', [$user, 'subject']);
        $subject = subject::factory()->create();

        // test
        Livewire::actingAs($user)
            ->test(CrudChild::class, ['subject' => $subject])
            ->call('showDeleteForm', $subject)
            ->call('deleteItem');

        // test if data is softdeleted
        $this->assertSoftDeleted($subject);
    }
}
