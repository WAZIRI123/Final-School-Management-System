<?php

namespace Tests\Feature\Livewire\Promotion;

use App\Http\Livewire\Dashboard\PromoteStudent\ManagePromotion;
use App\Http\Livewire\Dashboard\PromoteStudent\PromoteStudent;
use App\Models\Promotion;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Livewire;
use App\Traits\FeatureTestTrait;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreatePromotionTest extends TestCase
{
    use RefreshDatabase;
    use FeatureTestTrait, AuthorizesRequests;

    /** @test  */
    public function authorized_user_can_create_promotion()
    {
        $this->withoutExceptionHandling();


        // make fake user && assign role && acting as that user
        $user1 = User::factory()->create();
        $user1->assignRole('admin');
        $student = Student::factory()->for($user1)->create();

        // check if user has given permission/gate   
        $user1->can('promote', Promotion::class);

        Livewire::actingAs($user1)
            ->test(PromoteStudent::class,['student' => $student])
            ->set('old_section', \App\Enums\ClassSectionEnum::A)
            ->set('old_class', 1)
            ->set('new_class', 1)
            ->set('new_section', \App\Enums\ClassSectionEnum::A)
            ->set('selectedRows', [1])
            ->call('promoteStudents');

        // test if data exist in database
        $this->assertDatabaseHas('students', [
            'section' => \App\Enums\ClassSectionEnum::A,
        ]);

        // test if data exist in database
        $this->assertDatabaseHas('promotions', [
            'new_class_id' => 2,
            'old_class_id' => 1,
        ]);
    }

     /** @test  */
     public function authorized_user_can_reset_promotion()
     {
         $this->withoutExceptionHandling();
 
 
         // make fake user && assign role && acting as that user
         $user1 = User::factory()->create();
         $user1->assignRole('admin');

         $promotion = Promotion::factory()->create();
         
         // check if user has given permission/gate   
         $user1->can('reset', Promotion::class);
 
         Livewire::actingAs($user1)
             ->test(ManagePromotion::class,['promotion' => $promotion])
             ->call('showResetForm', $promotion)
             ->call('resetItem');
 
         // test if data exist in database
         $this->assertDatabaseHas('students', [
             'section' => \App\Enums\ClassSectionEnum::B,
         ]);
 
        // test if data is softdeleted
        $this->assertSoftDeleted($promotion);
     }
}
