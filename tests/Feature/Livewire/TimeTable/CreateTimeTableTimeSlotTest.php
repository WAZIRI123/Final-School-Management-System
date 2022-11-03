<?php

use App\Http\Livewire\Dashboard\TimeTable\CreateTimeTableRecordSlot;
use App\Http\Livewire\Dashboard\TimeTable\ManageTimeTableRecordSlot;
use App\Models\TimeTableTimeSlot;
use App\Models\User;
use App\Traits\FeatureTestTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreateTimeTableTimeSlotTest extends TestCase
{
    use RefreshDatabase;
    use FeatureTestTrait, AuthorizesRequests;

        //test view all TimeTableTimeSlot cannot be accessed by unauthorised users
        public function test_view_all_TimeTableTimeSlot_cannot_be_accessed_by_unauthorised_users()
        {
            $this->unauthorized_user();
            Livewire::test('dashboard.time-table.manage-time-table-record-slot')
                ->assertForbidden();
        }
    

    
    
        /** @test */
        public function blade_template_is_wired_properly()
        {
            $this->withoutExceptionHandling();
    
    
            Livewire::test('dashboard.time-table.create-time-table-record-slot')
                ->assertSeeHtml('wire:model.defer="item.start_time"')
                ->assertSeeHtml('wire:model.defer="item.stop_time"')
                ->assertSeeHtml('wire:model.defer="item.timetable_id"')
                ->assertSeeHtml('wire:click="createItem()"');
        }
    
    
        /** @test  */
    
        public function unauthorized_user_can_not_create_TimeTableTimeSlot()
        {
    
            Livewire::actingAs(User::factory()->create())
                ->test(CreateTimeTableRecordSlot::class)
                ->set('item.start_time', '14:02')
                ->set('item.stop_time', '15:02')
                ->set('item.timetable_id', 1)
                ->call('createItem')
                ->assertForbidden();
        }
    
        /** @test  */
    
        public function authorized_user_can_create_TimeTableTimeSlot()
        {
            $this->withoutExceptionHandling();
            // make fake user && assign role && acting as that user
            $user1 = User::factory()->create();
            $user1->assignRole('admin');
    
            // check if user has given permission/gate   
            $user1->can('create', [$user1, 'TimeTableTimeSlot']);
    
            Livewire::actingAs($user1)
                ->test(CreateTimeTableRecordSlot::class)
                ->set('item.start_time', '14:02')
                ->set('item.stop_time', '15:02')
                ->set('item.timetable_id', 1)
                ->call('createItem');
    
            // test if data exist in database
            $this->assertDatabaseHas('time_table_time_slots', [
                'start_time' => '14:02',
                'timetable_id'=>1,
            ]);
        }
    

                /** @test  */
    
                public function authorized_user_can_create_TimeTableRecord()
                {
                    $this->withoutExceptionHandling();
                    // make fake user && assign role && acting as that user
                    $user1 = User::factory()->create();

                    $user1->assignRole('admin');
            
                    // check if user has given permission/gate   
                    $user1->can('create', [$user1, 'TimeTableTimeSlot']);
            
                    Livewire::actingAs($user1)
                        ->test(ManageTimeTableRecordSlot::class)
                        ->set('selected_class', 1)
                        ->set('selected_subject', 1)
                        ->set('selected_weekday', 1)
                        ->set('selectedSlots', [1])
                        ->call('SyncSlotsWithDays');
                        
            
                    // test if data exist in database
                    $this->assertDatabaseHas('time_table_time_slot_week_day', [
                        'week_day_id' => 1,
                        'subject_id'=>1,
                    ]);
                }

        //test unauthorised users cannot edit TimeTableTimeSlot
        public function test_unauthorised_users_cannot_edit_TimeTableTimeSlot()
        {
            // make fake user &&  acting as that user and TimeTableTimeSlot
            $user = User::factory()->create();
            $TimeTableTimeSlot = TimeTableTimeSlot::factory()->create();
            Livewire::actingAs($user)
                ->test(CreateTimeTableRecordSlot::class, ['item' => $TimeTableTimeSlot])
                ->call('showEditForm', $TimeTableTimeSlot)
                ->set('item.start_time', '14:02')
                ->call('editItem')
                ->assertForbidden();
        }
    
        //test authorised users can edit TimeTableTimeSlot
        public function test_authorised_users_can_edit_TimeTableTimeSlot()
        {
            $this->withoutExceptionHandling();
    
            // make fake user && assign role && acting as that user
            $user1 = User::factory()->create();
            $user1->assignRole('admin');
            $TimeTableTimeSlot = TimeTableTimeSlot::factory()->create();
    
            // check if user has given permission/gate   
            $user1->can('update', [$user1, 'TimeTableTimeSlot']);
    
            // test
            Livewire::actingAs($user1)
                ->test(CreateTimeTableRecordSlot::class, ['item' => $TimeTableTimeSlot])
                ->call('showEditForm', $TimeTableTimeSlot)
    
                ->set('item.start_time', '15:02')
    
                ->call('editItem');
    
            // test if data exist in database
            $this->assertDatabaseHas('time_table_time_slots', [
                'start_time' => '15:02'
            ]);
        }
    
        //test unauthorised users cannot edit TimeTableTimeSlot
        public function test_unauthorised_users_cannot_delete_TimeTableTimeSlot()
        {
            $user = User::factory()->create();
            $TimeTableTimeSlot = TimeTableTimeSlot::factory()->create();
            Livewire::actingAs($user)
                ->test(CreateTimeTableRecordSlot::class, ['item' => $TimeTableTimeSlot])
                ->call('deleteItem', $TimeTableTimeSlot)
                ->assertForbidden();
        }
        //test authorised users can edit TimeTableTimeSlot
    
        public function test_authorised_users_can_delete_TimeTableTimeSlot()
        {
            $this->withoutExceptionHandling();
            // make fake user && assign role && acting as that user
            $user = User::factory()->create();
            $user->assignRole('admin');
            $user->can('delete', [$user, 'timetabletimeslot']);
            $timeTableTimeSlot = TimeTableTimeSlot::factory()->create();

            // test
            Livewire::actingAs($user)
                ->test(CreateTimeTableRecordSlot::class, ['timeTableTimeSlot' => $timeTableTimeSlot])
                ->call('showDeleteForm', $timeTableTimeSlot)
                ->call('deleteItem');
    
            // test if data is softdeleted
            $this->assertSoftDeleted($timeTableTimeSlot);
        }
}
