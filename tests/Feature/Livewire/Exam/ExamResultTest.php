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
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ExamResultTest extends TestCase
{
    use RefreshDatabase;
    use FeatureTestTrait, AuthorizesRequests;



           /** @test  */
    
           public function authorized_user_can_view_Exam_result()
           {
               $this->withoutExceptionHandling();
                
              $class=Classes::factory()->create(['id'=>1]);

              $subject=Subject::factory()->create(['id'=>1]); 

              $semester1=Semester::factory()->create(['id'=>1]); 

              $semester2=Semester::factory()->create(['id'=>2]); 

              
              $student1=Student::factory()->create(['id'=>1]);

              $academic_year=AcademicYear::factory()->create(['id'=>1]);
                            
              $student2=Student::factory()->create(['id'=>2]);  

              $exam=Exam::factory()->create(['id'=>1]);

    ExamRecord::factory()->for($class)->for($exam,'exams')->for($subject,'subjects')->for($student1,'students')->for($academic_year,'academicYear')->create(['semester_id'=>1]);

    
    ExamRecord::factory()->for($class)->for($exam,'exams')->for($subject,'subjects')->for($student1,'students')->for($academic_year,'academicYear')->create(['semester_id'=>2]);

    ExamRecord::factory()->for($class)->for($exam,'exams')->for($subject,'subjects')->for($student2,'students')->for($academic_year,'academicYear')->create(['semester_id'=>1]);

    ExamRecord::factory()->for($class)->for($exam,'exams')->for($subject,'subjects')->for($student2,'students')->for($academic_year,'academicYear')->create(['semester_id'=>2]);


               // make fake user && assign role && acting as that user
 
           
               $user1 = User::factory()->create();
               $user1->assignRole('student');
   
               // check if user has given permission/gate   
               $user1->can('read exam record', [ExamRecord::class]);

       
               Livewire::actingAs($user1)
                   ->test(Index::class)
                   ->set('class', 1)
                   ->set('section', ClassSectionEnum::A->value)
                   ->set('exam', 1)
                   ->set('subject', 1)
                   ->set('student', [1,2,3,4,5,6,7,8,9,10,11,12])
                   ->call('Markstudent');
       
               // test if data exist in database
               $this->assertDatabaseHas('exam_records', [
                   'class_id' => 1,
               ]);
           }
}
