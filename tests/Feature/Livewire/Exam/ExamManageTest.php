<?php

namespace Tests\Feature\Livewire\ExamRecord;

use App\Enums\ClassSectionEnum;
use App\Http\Livewire\Dashboard\Exam\ExamRecordCrud;
use App\Http\Livewire\Dashboard\Exam\Manage\ManageExamRecordChild;
use App\Models\ExamRecord;
use App\Models\User;
use App\Traits\FeatureTestTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ExamManageTest extends TestCase
{
    use RefreshDatabase;
    use FeatureTestTrait, AuthorizesRequests;

        
        /** @test  */
    
        public function unauthorized_user_can_not_create_ExamRecord()
        {
            $this->withoutExceptionHandling();
            $this->unauthorized_user();
            Livewire::test('dashboard.exam.exam-record-crud')
                ->assertForbidden();
        }

        //test view all ExamRecord cannot be accessed by unauthorised users
        public function test_view_all_ExamRecord_cannot_be_accessed_by_unauthorised_users()
        {
            $this->unauthorized_user();
            Livewire::test('dashboard.exam.manage.manage-exam-record')
                ->assertForbidden();
        }
    

    
         /** @test  */
    
        public function authorized_user_can_create_ExamRecord()
        {
            $this->withoutExceptionHandling();
            // make fake user && assign role && acting as that user
            $user1 = User::factory()->create();
            $user1->assignRole('admin');
    
            // check if user has given permission/gate   
            $user1->can('create', [$user1, 'exam record']);
    
            Livewire::actingAs($user1)
                ->test(ExamRecordCrud::class)
                ->set('class', 1)
                ->set('section', ClassSectionEnum::A->value)
                ->set('exam', 1)
                ->set('subject', 1)
                ->set('marks', [25])
                ->call('markStudents');
    
            // test if data exist in database
            $this->assertDatabaseHas('exam_records', [
                'class_id' => 1,
                'marks'=>25,
            ]);
        }
    
        //test unauthorised users cannot edit ExamRecord
        public function test_unauthorised_users_cannot_edit_ExamRecord()
        {
            // make fake user &&  acting as that user and ExamRecord
            $user = User::factory()->create();
            $ExamRecord= ExamRecord::factory()->create();
            Livewire::actingAs($user)
                ->test(ManageExamRecordChild::class, ['item' => $ExamRecord])
                ->call('showEditForm', $ExamRecord)
                ->set('item.class_id', 1)
                ->call('editItem')
                ->assertForbidden();
        }
    
        //test authorised users can edit ExamRecord
        public function test_authorised_users_can_edit_ExamRecord()
        {
            $this->withoutExceptionHandling();
    
            // make fake user && assign role && acting as that user
            $user1 = User::factory()->create();
            $user1->assignRole('admin');
            $ExamRecord = ExamRecord::factory()->create();
    
            // check if user has given permission/gate   
            $user1->can('update', [$user1, 'exam record']);
    
            // test
            Livewire::actingAs($user1)
            ->test(ManageExamRecordChild::class, ['item' => $ExamRecord])
            ->call('showEditForm', $ExamRecord)
            ->set('item.marks', 20)
            ->call('editItem');
    
            // test if data exist in database
            $this->assertDatabaseHas('exam_records', [
                'marks' => 20
            ]);
        }
    
}
