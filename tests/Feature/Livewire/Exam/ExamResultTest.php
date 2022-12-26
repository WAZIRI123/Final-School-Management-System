<?php

namespace Tests\Feature\Livewire\Exam;

use App\Http\Livewire\Dashboard\Exam\Result\Index;
use App\Models\AcademicYear;
use App\Models\Classes;
use App\Models\Exam;
use App\Models\ExamRecord;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use App\Traits\FeatureTestTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Livewire;
use Tests\TestCase;

class ExamResultTest extends TestCase
{

    use FeatureTestTrait, AuthorizesRequests;



           /** @test  */
    
           public function authorized_user_can_view_Exam_result()
           {
               $this->withoutExceptionHandling();

               $students1 =Student::factory()->has(ExamRecord::factory()->count(5)->state(['marks'=>15]))->create();

               $students2 =Student::factory()->has(ExamRecord::factory()->count(5)->state(['marks'=>95]))->create();

               // make fake user && assign role && acting as that user
 
               $user1 = User::factory()->create();
               $user1->assignRole('student');
   
               // check if user has given permission/gate   
               $user1->can('read exam record', [ExamRecord::class]);

       
               $response=Livewire::actingAs($user1)
                   ->test(Index::class)
                   ->set('class', 1)
                   ->set('academic_year', 1)
                   ->set('select_student', 1)
                   ->call('examRecords');
                   // assert if students sorted corretly
                  $this->assertEquals([$students2->id,$students1->id],$response->viewData('students')->pluck('id')->toArray()) ;

                   // assert if correctly number of exam_records returned for a student
                  $this->assertEquals(5,$response->viewData('student_result')->count());
                
           }
}
