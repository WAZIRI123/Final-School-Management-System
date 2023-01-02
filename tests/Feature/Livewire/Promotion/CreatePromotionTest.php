<?php

namespace Tests\Feature\Livewire\Promotion;

use App\Http\Livewire\Dashboard\PromoteStudent\ManagePromotion;
use App\Http\Livewire\Dashboard\PromoteStudent\PromoteStudent;
use App\Models\AcademicYear;
use App\Models\Classes;
use App\Models\Promotion;
use App\Models\School;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Livewire;
use App\Traits\FeatureTestTrait;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreatePromotionTest extends TestCase
{

    use FeatureTestTrait, AuthorizesRequests;

    /** @test  */
    public function authorized_user_can_create_promotion()
    {
        $this->withoutExceptionHandling();

        // make fake user && assign role && acting as that user
        $school = School::factory()->create();
        $AcademicYear=AcademicYear::factory()->for($school)->create();
     
       
        $user1 = User::factory()->for($school)->create();
      

        $class1 = Classes::factory()->create();
        $class2 = Classes::factory()->create();
        $user1->assignRole('admin');
        $user=User::factory()->create();
        $student = Student::factory()->for($user)->create();

        // check if user has given permission/gate   
        $user1->can('promote', Promotion::class);

        Livewire::actingAs($user1)
            ->test(PromoteStudent::class,['student' => $student])
            ->set('old_section', \App\Enums\ClassSectionEnum::A)
            ->set('old_class', $class1->id)
            ->set('new_class', $class2->id)
            ->set('new_section', \App\Enums\ClassSectionEnum::A)
            ->set('selectedRows', [1])
            ->call('promoteStudents')->assertHasNoErrors();

        // test if data exist in database
        $this->assertDatabaseHas('students', [
            'section' => \App\Enums\ClassSectionEnum::A,
        ]);

        // test if data exist in database
        $this->assertDatabaseHas('promotions', [
            'new_class_id' =>$class2->id,
            'old_class_id' => $class1->id,
        ]);
    }

     /** @test  */
     public function authorized_user_can_reset_promotion()
     {
         $this->withoutExceptionHandling();
 
         // make fake user && assign role && acting as that user
         $school = School::factory()->create();
         $AcademicYear=AcademicYear::factory()->for($school)->create();
      
        
         $user1 = User::factory()->for($school)->create();
       
 
         $class1 = Classes::factory()->create();
         $class2 = Classes::factory()->create();
         $user1->assignRole('admin');
         $user=User::factory()->create();
         $student = Student::factory()->for($user)->create();

         $promotion=Promotion::factory()->for($student)->create();
$promotion1=Promotion::factory()->for($student)->create();
         // check if user has given permission/gate   
         $user1->can('promote', Promotion::class);
 
         Livewire::actingAs($user1)
             ->test(ManagePromotion::class)
             ->set('selectedRows',[1])
             ->call('resetPromotion');

             $studentYear =  $student->academicYears;

             $this->assertTrue($studentYear->contains($promotion->first()->old_class_id));

        // test if class_id and section changed
        $this->assertDatabaseHas('students', [
            'class_id' => $promotion->first()->old_class_id,
            'section'  => $promotion->first()->old_section,
        ]);

            // test if data exist in database
            $this->assertSoftDeleted($promotion);
     }


    
    

}
