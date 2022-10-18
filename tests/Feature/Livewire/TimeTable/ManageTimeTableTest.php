<?php

namespace Tests\Feature\Livewire\TimeTable;

use App\Http\Livewire\Dashboard\TimeTable\ManageTimeTable;
use App\Models\Timetable;
use App\Models\User;
use App\Traits\FeatureTestTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ManageTimeTableTest extends TestCase
{
    use RefreshDatabase;
    use FeatureTestTrait, AuthorizesRequests;

    /** @test  */

    public function authorized_user_can_create_TimeTableRecord()
    {
        $this->withoutExceptionHandling();
        // make fake user && assign role && acting as that user
        $user1 = User::factory()->create();
        $user1->assignRole('admin');
        // check if user has given permission/gate   
        $user1->can('read', [$user1, 'TimeTable']);

        Livewire::actingAs($user1)
            ->test(ManageTimeTable::class)
            ->set('selected_class', 1)
            ->set('selected_semester',1)

            ->call('render')


        // check if timetable shown
        ->assertSee('Monday');
    }
}
