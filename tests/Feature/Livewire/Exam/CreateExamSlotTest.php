<?php

namespace Tests\Feature\Livewire\Exam;

use App\Http\Livewire\Dashboard\Exam\CreateExamSlot;
use App\Models\ExamSlot;
use App\Models\User;
use App\Traits\FeatureTestTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreateExamSlotTest extends TestCase
{
    use RefreshDatabase;
    use FeatureTestTrait, AuthorizesRequests;

        //test view all Exam Slot cannot be accessed by unauthorised users
        public function test_view_all_Exam_slot_cannot_be_accessed_by_unauthorised_users()
        {
            $this->unauthorized_user();
            Livewire::test('dashboard.exam.manage-exam-slot')
                ->assertForbidden();
        }
    
    
        /** @test  */
    
        public function unauthorized_user_can_not_create_Exam_slot()
        {
    
            Livewire::actingAs(User::factory()->create())
                ->test(CreateExamSlot::class)
                ->set('item.name', 'waziri')
                ->set('item.description', 'waziriallyamir@gmail.com')
                ->set('item.semester_id', 1)
                ->set('item.start_date', 2000/02/02)
                ->set('item.stop_date', 2000/03/02)
                ->call('createItem')
                ->assertForbidden();
        }
    
        /** @test  */
    
        public function authorized_user_can_create_Exam_slot()
        {
            $this->withoutExceptionHandling();
            // make fake user && assign role && acting as that user
            $user1 = User::factory()->create();
            $user1->assignRole('admin');
    
            // check if user has given permission/gate   
            $user1->can('update', [$user1, 'exam slot']);
    
            Livewire::actingAs($user1)
                ->test(CreateExamSlot::class)
                ->set('item.name', 'waziri')
                ->set('item.description', 'waziriallyamir@gmail.com')
                ->set('item.exam_id', 1)
                ->set('item.total_marks', 50)
                ->call('createItem')
                ->assertHasNoErrors();
    
            // test if data exist in database
            $this->assertDatabaseHas('exam_slots', [
                'name' => 'waziri',
                'exam_id'=>1,
            ]);
        }
    
        //test unauthorised users cannot edit Exam slot
        public function test_unauthorised_users_cannot_edit_Exam_slot()
        {
            // make fake user &&  acting as that user and Exam
            $user = User::factory()->create();
            $ExamSlotSlot = ExamSlot::factory()->create();
            Livewire::actingAs($user)
                ->test(CreateExamSlot::class, ['item' => $ExamSlotSlot])
                ->call('showEditForm', $ExamSlotSlot)
                ->set('item.name', 'waziribig')
                ->call('editItem')
                ->assertForbidden();
        }
    
        //test authorised users can edit Exam slot
        public function test_authorised_users_can_edit_Exam_slot()
        {
            $this->withoutExceptionHandling();
    
            // make fake user && assign role && acting as that user
            $user1 = User::factory()->create();
            $user1->assignRole('admin');
            $ExamSlot = ExamSlot::factory()->create();
    
            // check if user has given permission/gate   
            $user1->can('update', [$user1, 'exam slot']);
    
            // test
            Livewire::actingAs($user1)
                ->test(CreateExamSlot::class, ['item' => $ExamSlot])
                ->call('showEditForm', $ExamSlot)
    
                ->set('item.name', 'waziribig')
    
                ->call('editItem');
    
            // test if data exist in database
            $this->assertDatabaseHas('Exam_slots', [
                'name' => 'waziribig'
            ]);
        }
    
        //test unauthorised users cannot edit Exam slot
        public function test_unauthorised_users_cannot_delete_Exam_slot()
        {
            $user = User::factory()->create();
            $ExamSlot = ExamSlot::factory()->create();
            Livewire::actingAs($user)
                ->test(CreateExamSlot::class, ['item' => $ExamSlot])
                ->call('deleteItem', $ExamSlot)
                ->assertForbidden();
        }
        //test authorised users can edit Exam slot
    
        public function test_authorised_users_can_delete_Exam_slot()
        {
            // make fake user && assign role && acting as that user
            $user = User::factory()->create();
            $user->assignRole('admin');
            $user->can('delete', [$user, 'exam slot']);
            $ExamSlot = ExamSlot::factory()->create();
            // test
            Livewire::actingAs($user)
                ->test(CreateExamSlot::class, ['ExamSlot' => $ExamSlot])
                ->call('showDeleteForm', $ExamSlot)
                ->call('deleteItem');
    
            // test if data is softdeleted
            $this->assertSoftDeleted($ExamSlot);
        }
}
