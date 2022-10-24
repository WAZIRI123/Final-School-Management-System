<?php

namespace Tests\Feature\Livewire\ExamRecord;

use App\Enums\ClassSectionEnum;
use App\Http\Livewire\Dashboard\Exam\ExamRecordCrud;
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

        //test view all ExamRecord cannot be accessed by unauthorised users
        public function test_view_all_ExamRecord_cannot_be_accessed_by_unauthorised_users()
        {
            $this->unauthorized_user();
            Livewire::test('dashboard.exam.manage.manage-exam-record')
                ->assertForbidden();
        }
    
    
        /** @test  */
    
        public function unauthorized_user_can_not_create_ExamRecord()
        {
            $this->withoutExceptionHandling();
            Livewire::actingAs(User::factory()->create())
                ->test(ExamRecordCrud::class)
                ->set('semester_id', 1)
                ->set('class_id', 1)
                ->set('section_id', ClassSectionEnum::A->value)
                ->set('exam_id', 1)
                ->set('subject_id', 1)
                ->set('student_id', 1)
                ->set('marks', [25])
                ->call('createItem')
         
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
            $user1->can('update', [$user1, 'examRecord slot']);
    
            Livewire::actingAs($user1)
                ->test(ExamRecordSlotCrudChild::class)
                ->set('item.name', 'waziri')
                ->set('item.description', 'waziriallyamir@gmail.com')
                ->set('item.examRecord_id', 1)
                ->set('item.total_marks', 50)
                ->call('createItem')
                ->assertHasNoErrors();
    
            // test if data exist in database
            $this->assertDatabaseHas('examRecord_slots', [
                'name' => 'waziri',
                'examRecord_id'=>1,
            ]);
        }
    
        //test unauthorised users cannot edit ExamRecord
        public function test_unauthorised_users_cannot_edit_ExamRecord()
        {
            // make fake user &&  acting as that user and ExamRecord
            $user = User::factory()->create();
            $ExamRecordSlotSlot = ExamRecordSlot::factory()->create();
            Livewire::actingAs($user)
                ->test(ExamRecordSlotCrudChild::class, ['item' => $ExamRecordSlotSlot])
                ->call('showEditForm', $ExamRecordSlotSlot)
                ->set('item.name', 'waziribig')
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
            $ExamRecordSlot = ExamRecordSlot::factory()->create();
    
            // check if user has given permission/gate   
            $user1->can('update', [$user1, 'examRecord slot']);
    
            // test
            Livewire::actingAs($user1)
                ->test(ExamRecordSlotCrudChild::class, ['item' => $ExamRecordSlot])
                ->call('showEditForm', $ExamRecordSlot)
    
                ->set('item.name', 'waziribig')
    
                ->call('editItem');
    
            // test if data exist in database
            $this->assertDatabaseHas('ExamRecord_slots', [
                'name' => 'waziribig'
            ]);
        }
    
        //test unauthorised users cannot edit ExamRecord
        public function test_unauthorised_users_cannot_delete_ExamRecord()
        {
            $user = User::factory()->create();
            $ExamRecordSlot = ExamRecordSlot::factory()->create();
            Livewire::actingAs($user)
                ->test(ExamRecordSlotCrudChild::class, ['item' => $ExamRecordSlot])
                ->call('deleteItem', $ExamRecordSlot)
                ->assertForbidden();
        }
        //test authorised users can edit ExamRecord
    
        public function test_authorised_users_can_delete_ExamRecord()
        {
            // make fake user && assign role && acting as that user
            $user = User::factory()->create();
            $user->assignRole('admin');
            $user->can('delete', [$user, 'examRecord slot']);
            $ExamRecordSlot = ExamRecordSlot::factory()->create();
            // test
            Livewire::actingAs($user)
                ->test(ExamRecordSlotCrudChild::class, ['ExamRecordSlot' => $ExamRecordSlot])
                ->call('showDeleteForm', $ExamRecordSlot)
                ->call('deleteItem');
    
            // test if data is softdeleted
            $this->assertSoftDeleted($ExamRecordSlot);
        }
}
