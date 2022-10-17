<?php

namespace Tests\Feature\Livewire\TimeTable;

use App\Models\User;
use App\Traits\FeatureTestTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManageTimeTable extends TestCase
{
    use RefreshDatabase;
    use FeatureTestTrait, AuthorizesRequests;

    /** @test  */

    public function authorized_user_can_create_TimeTableRecord()
    {
        $this->withoutExceptionHandling();
        // make fake user && assign role && acting as that user
        $user1 = User::factory()->create();

        // check if user has given permission/gate   
        $user1->can('create', [$user1, 'TimeTableTimeSlot']);

        Livewire::actingAs($user1)
            ->test(TimeSlotCrud::class)
            ->set('selected_class', 1)
            ->set('selected_subject', 1)
            ->set('selected_weekday', 1)
            ->set('selectedSlots', [1])
            ->call('SyncSlotsWithDays');


        // test if data exist in database
        $this->assertDatabaseHas('time_table_time_slot_week_day', [
            'week_day_id' => 1,
            'subject_id' => 1,
        ]);
    }
}
