<?php

namespace Tests\Feature\Livewire\Dashboard\School;

use App\Http\Livewire\Dashboard\School\SettingSchool;

use App\Models\School;
use App\Traits\FeatureTestTrait;
use Livewire\Livewire;
use Tests\TestCase;

class SettingSchoolTest extends TestCase
{

    
    use FeatureTestTrait;

    //test authorised users can edit schools
    public function test_authorised_users_can_edit_schools()
    {
        $this->withoutExceptionHandling();
        $this->authorized_user(['update school']);

        $school = School::factory()->create();

        Livewire::
             test(SettingSchool::class, ['item' => $school])
            ->set('item.address', 'waziribigwazi')
            ->call('editItem', $school);

        $this->assertDatabaseHas('schools', [
            'address' => 'waziribigwazi'
        ]);


    }
}
