<?php

namespace Tests\Feature\Livewire\TimeTable;

use App\Http\Livewire\Dashboard\TimeTable\CreateTimeTable;
use App\Models\Timetable;
use App\Models\User;
use App\Traits\FeatureTestTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreateTimeTableTest extends TestCase
{
    use RefreshDatabase;
    use FeatureTestTrait, AuthorizesRequests;

        //test view all TimeTable cannot be accessed by unauthorised users
        public function test_view_all_TimeTable_cannot_be_accessed_by_unauthorised_users()
        {
            $this->unauthorized_user();
            Livewire::test('dashboard.time-table.manage-time-table')
                ->assertForbidden();
        }
    
        // //test view all TimeTable can be accessed by authorised users
        // public function test_if_only_TimeTable_under_given_school_can_be_seen_accessed_by_authorised_users()
        // {
        //     $this->withoutExceptionHandling();
    
    
        //     // make fake user && assign role && acting as that user && TimeTable create
        //     $user = User::factory()->create();
    
        //     Timetable::factory()->create(['name' => 'Waziribig', 'semester_id' => 1]);
    
        //     TimeTable::factory()->create(['name' => 'notttt2003', 'semester_id' => 2]);
    
        //     $user->assignRole('Admin');
    
        //     // check if user has given permission/gate   
        //     $user->can('viewAny', [TimeTable::class, 'TimeTable']);
    
        //     Livewire::actingAs($user)
        //         ->test('dashboard.time-table.crud')
        //         ->assertOk()
        //         ->assertSee('Waziribig')
        //         ->assertDontSee('notttt2003');
        // }
    
    
        /** @test */
        public function blade_template_is_wired_properly()
        {
            $this->withoutExceptionHandling();
    
    
            Livewire::test('dashboard.time-table.create-time-table')
                ->assertSeeHtml('wire:model.defer="item.name"')
                ->assertSeeHtml('wire:model.defer="item.description"')
                ->assertSeeHtml('wire:model.defer="item.class_id"')
                ->assertSeeHtml('wire:click="createItem()"');
        }
    
    
        /** @test  */
    
        public function unauthorized_user_can_not_create_TimeTable()
        {
    
            Livewire::actingAs(User::factory()->create())
                ->test(CreateTimeTable::class)
                ->set('item.name', 'waziri')
                ->set('item.description', 'waziriallyamir@gmail.com')
                ->set('item.semester_id', 1)
                ->set('item.class_id', 1)
                ->call('createItem')
                ->assertForbidden();
        }
    
        /** @test  */
    
        public function authorized_user_can_create_TimeTable()
        {
            // make fake user && assign role && acting as that user
            $user1 = User::factory()->create();
            $user1->assignRole('admin');
    
            // check if user has given permission/gate   
            $user1->can('create', [$user1, 'TimeTable']);
    
            Livewire::actingAs($user1)
                ->test(CreateTimeTable::class)
                ->set('item.name', 'waziri')
                ->set('item.description', 'waziri ally')
                ->set('item.class_id', 2)
                ->set('item.semester_id', 2)
                ->call('createItem');
    
            // test if data exist in database
            $this->assertDatabaseHas('TimeTables', [
                'name' => 'waziri',
                'class_id'=>2,
            ]);
        }
    
        //test unauthorised users cannot edit TimeTable
        public function test_unauthorised_users_cannot_edit_TimeTable()
        {
            // make fake user &&  acting as that user and TimeTable
            $user = User::factory()->create();
            $TimeTable = Timetable::factory()->create();
            Livewire::actingAs($user)
                ->test(CreateTimeTable::class, ['item' => $TimeTable])
                ->call('showEditForm', $TimeTable)
                ->set('item.name', 'waziribig')
                ->call('editItem')
                ->assertForbidden();
        }
    
        //test authorised users can edit TimeTable
        public function test_authorised_users_can_edit_TimeTable()
        {
            $this->withoutExceptionHandling();
    
            // make fake user && assign role && acting as that user
            $user1 = User::factory()->create();
            $user1->assignRole('admin');
            $TimeTable = TimeTable::factory(['semester_id'=>1,'class_id'=>1])->create();
    
            // check if user has given permission/gate   
            $user1->can('update', [$user1, 'TimeTable']);
    
            // test
            Livewire::actingAs($user1)
                ->test(CreateTimeTable::class, ['item' => $TimeTable])
                ->call('showEditForm', $TimeTable)
    
                ->set('item.name', 'waziribig')
    
                ->call('editItem');
    
            // test if data exist in database
            $this->assertDatabaseHas('TimeTables', [
                'name' => 'waziribig'
            ]);
        }
    
        //test unauthorised users cannot edit TimeTable
        public function test_unauthorised_users_cannot_delete_TimeTable()
        {
            $user = User::factory()->create();
            $TimeTable = TimeTable::factory()->create();
            Livewire::actingAs($user)
                ->test(CreateTimeTable::class, ['item' => $TimeTable])
                ->call('deleteItem', $TimeTable)
                ->assertForbidden();
        }
        //test authorised users can edit TimeTable
    
        public function test_authorised_users_can_delete_TimeTable()
        {
            // make fake user && assign role && acting as that user
            $user = User::factory()->create();
            $user->assignRole('admin');
            $user->can('delete', [$user, 'TimeTable']);
            $TimeTable = TimeTable::factory(['school_id'=>1,'semester_id'=>1,'class_id'=>1])->create();
            // test
            Livewire::actingAs($user)
                ->test(CreateTimeTable::class, ['TimeTable' => $TimeTable])
                ->call('showDeleteForm', $TimeTable)
                ->call('deleteItem');
    
            // test if data is softdeleted
            $this->assertSoftDeleted($TimeTable);
        }
}
