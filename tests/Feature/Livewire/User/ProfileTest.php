<?php

namespace Tests\Feature\Livewire\User;

use App\Http\Livewire\Dashboard\Profile;
use App\Models\User;
use App\Traits\FeatureTestTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ProfileTest extends TestCase
{
 
    use FeatureTestTrait, AuthorizesRequests;

        //test authorised users can edit parents
        public function test_authorised_users_can_edit_user()
        {
    
    
            // make fake user && assign role && acting as that user
            $user1 = User::factory()->create();
    
            // test
            Livewire::actingAs($user1)
                ->test(Profile::class)

                ->set('name', 'waziribig')
                ->set('email', 'waziri567@gmail.com')
                ->set('password', '0653039317')
                ->set('password_confirmation', '0653039317')
                ->call('updateUser');
    
            // test if data exist in database
            $this->assertDatabaseHas('users', [
                'name' => 'waziribig'
            ]);

        }

}
