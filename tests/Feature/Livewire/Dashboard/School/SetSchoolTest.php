<?php

namespace Tests\Feature\Livewire\Dashboard\School;

use App\Http\Livewire\Dashboard\School\SetSchool;
use App\Models\User;
use App\Traits\FeatureTestTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class SetSchoolTest extends TestCase
{

    use FeatureTestTrait;
    //test authorised users can edit schools

    public function test_authorised_users_can_edit_schools()
    {
        $this->withoutExceptionHandling();
        $user=$this->authorized_user(['setSchool']);

        Livewire::
             test(SetSchool::class)

            ->set('school_id', 1)

            ->call('setSchool');

        $this->assertDatabaseHas('users', [
            'school_id' => 1
        ]);

    }
}
