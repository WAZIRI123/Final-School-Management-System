<?php

use App\Http\Livewire\Dashboard\TimeTable\CreateTimeTableRecordSlot;
use App\Http\Livewire\Dashboard\TimeTable\ManageTimeTableRecordSlot;
use App\Models\Classes;
use App\Models\School;
use App\Models\Subject;
use App\Models\Timetable;
use App\Models\TimeTableTimeSlot;
use App\Models\User;
use App\Models\WeekDay;
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

                    $class = Classes::factory()->create();
                    $subject = Subject::factory()->create();
                    $weekday = WeekDay::factory()->create();
                    $weekday1 = WeekDay::factory()->create();
                    $timeTableTimeSlot =TimeTableTimeSlot::factory()->create();

                    $timeTableTimeSlot->weekdays()->attach( $weekday->id,['subject_id'=> $subject->id]);

                    $user1->assignRole('admin');
            
                    // check if user has given permission/gate   
                    $user1->can('create', [$user1, 'TimeTableTimeSlot']);
            
                    Livewire::actingAs($user1)
                        ->test(ManageTimeTableRecordSlot::class)
                        ->set('selected_class', $class->id)
                        ->set('selected_subject', $subject->id)
                        ->set('selected_weekday', $weekday1->id)
                        ->set('selectedSlots', 1)
                        ->call('SyncSlotsWithDays')->assertHasNoErrors();
                        
            
                    // test if data exist in database
                    $this->assertDatabaseHas('time_table_time_slot_week_day', [
                        'week_day_id' => $weekday1->id,
                        'subject_id'=>$subject->id,
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

            $school = School::factory()->create();
            $user1 = User::factory()->for($school)->create();
            $user1->assignRole('admin');
            $class = Classes::factory()->for($school)->create();
            $TimeTable = Timetable::factory()->for($class,'Myclass')->create();

            $TimeTableTimeSlot = TimeTableTimeSlot::factory()->for($TimeTable)->create();
    
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
           
    
            $school = School::factory()->create();

            $user1 = User::factory()->for($school)->create();
            
            $class = Classes::factory()->for($school)->create();

            $TimeTable = Timetable::factory()->for($class,'Myclass')->create();

            $TimeTableTimeSlot = TimeTableTimeSlot::factory()->for($TimeTable)->create();
            $user1->assignRole('admin');
            
            $user1->can('delete timetabletimeslot', [$TimeTableTimeSlot]);
            // test
            Livewire::actingAs($user1)
                ->test(CreateTimeTableRecordSlot::class, ['timeTableTimeSlot' => $TimeTableTimeSlot])
                ->call('showDeleteForm', $TimeTableTimeSlot)
                ->call('deleteItem');
    
            // test if data is softdeleted
            $this->assertSoftDeleted($TimeTableTimeSlot);
        }
}
