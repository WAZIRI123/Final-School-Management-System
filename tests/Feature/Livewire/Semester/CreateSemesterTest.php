<?php

namespace Tests\Feature\Livewire\Semester;

use App\Http\Livewire\Dashboard\Semester\CrudChild;
use App\Http\Livewire\Dashboard\Semester\SetSemester;
use App\Models\School;
use App\Models\Semester;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Traits\FeatureTestTrait;
use Livewire\Livewire;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateSemesterTest extends TestCase
{
 
    use FeatureTestTrait, AuthorizesRequests;

    //test view all Semester cannot be accessed by unauthorised users
    public function test_view_all_Semester_cannot_be_accessed_by_unauthorised_users()
    {
        $this->unauthorized_user();
        Livewire::test('dashboard.semester.crud')
            ->assertForbidden();
    }

    //test view all Semester can be accessed by authorised users
    public function test_if_only_Semester_under_given_school_can_be_seen_accessed_by_authorised_users()
    {
        $this->withoutExceptionHandling();


        // make fake user && assign role && acting as that user && Semester create
        $user = User::factory()->create();

        Semester::factory()->create(['name' => '2000', 'school_id' => 1]);

        Semester::factory()->create(['name' => '20045', 'school_id' => 2]);

        $user->assignRole('Admin');

        // check if user has given permission/gate   
        $user->can('viewAny', [Semester::class, 'semester']);

        Livewire::actingAs($user)
            ->test('dashboard.semester.crud')
            ->assertOk()
            ->assertSee('2000')
            ->assertDontSee('20045');
    }

        //test authorised users can edit school semester
        public function test_authorised_users_can_edit_school_semester()
        {
            $this->withoutExceptionHandling();
    
            // make fake user && assign role && acting as that user
            $school = School::factory()->create();
            $user1 = User::factory()->for($school)->create();
            $user1->assignRole('admin');

            $semester = Semester::factory()->for($school)->create();
    
            // check if user has given permission/gate   
            $user1->can('set semester', [$user1, 'semester']);
    
            // test
            Livewire::actingAs($user1)
                ->test(SetSemester::class, ['item' => $semester])

                ->set('semester_id', 1)
    
                ->call('setSemester');
    
            // test if data exist in database
            $this->assertDatabaseHas('schools', [
                'semester_id' => 1
            ]);
        }

        
    /** @test */
    public function blade_template_is_wired_properly()
    {
        $this->withoutExceptionHandling();


        Livewire::test('dashboard.semester.crud-child')
            ->assertSeeHtml('wire:model.defer="item.name"')
            ->assertSeeHtml('wire:model.defer="item.academic_year_id"')
            ->assertSeeHtml('wire:click="createItem()"')
            ->assertSeeHtml('wire:click="editItem()"');
    }


    /** @test  */

    public function unauthorized_user_can_not_create_Semester()
    {

        Livewire::actingAs(User::factory()->create())
            ->test(CrudChild::class)
            ->set('item.name', '2000/02/02')
            ->set('item.academic_year_id', 1)
            ->call('createItem')
            ->assertForbidden();
    }

    /** @test  */

    public function authorized_user_can_create_Semester()
    {
        // make fake user && assign role && acting as that user
        $user1 = User::factory()->create();
        $user1->assignRole('admin');

        // check if user has given permission/gate   
        $user1->can('create', [$user1, 'semester']);

        Livewire::actingAs($user1)
            ->test(CrudChild::class)
            ->set('item.name', '2000')
            ->set('item.academic_year_id', 1)
            ->call('createItem');

        // test if data exist in database
        $this->assertDatabaseHas('semesters', [
            'name' => '2000',
            
        ]);
    }

    //test unauthorised users cannot edit Semester
    public function test_unauthorised_users_cannot_edit_Semester()
    {
        // make fake user &&  acting as that user and Semester
        $user = User::factory()->create();
        $Semester =Semester::factory()->create();
        Livewire::actingAs($user)
            ->test(CrudChild::class, ['item' => $Semester])
            ->call('showEditForm', $Semester)
            ->set('item.name', '2000')
            ->call('editItem')
            ->assertForbidden();
    }

    //test authorised users can edit Semester
    public function test_authorised_users_can_edit_Semester()
    {
        $this->withoutExceptionHandling();

        // make fake user && assign role && acting as that user
        $user1 = User::factory()->create();
        $user1->assignRole('admin');
        $Semester = Semester::factory()->create();

        // check if user has given permission/gate   all
        $user1->can('update', [$user1, 'semester']);

        // test
        Livewire::actingAs($user1)
            ->test(CrudChild::class, ['item' => $Semester])
            ->call('showEditForm', $Semester)

            ->set('item.name', '2000')

            ->call('editItem');

        // test if data exist in database
        $this->assertDatabaseHas('semesters', [
            'name' => '2000'
        ]);
    }

    //test unauthorised users cannot edit Semester
    public function test_unauthorised_users_cannot_delete_Semester()
    {
        $user = User::factory()->create();
        $Semester = Semester::factory()->create();
        Livewire::actingAs($user)
            ->test(CrudChild::class, ['item' => $Semester])
            ->call('deleteItem', $Semester)
            ->assertForbidden();
    }
    //test authorised users can edit Semester

    public function test_authorised_users_can_delete_Semester()
    {
        // make fake user && assign role && acting as that user
        $user = User::factory()->create();
        $user->assignRole('admin');
        $user->can('delete', [$user, 'semester']);
        $Semester = Semester::factory()->create();

        // test
        Livewire::actingAs($user)
            ->test(CrudChild::class, ['Semester' => $Semester])
            ->call('showDeleteForm', $Semester)
            ->call('deleteItem');

        // test if data is softdeleted
        $this->assertSoftDeleted($Semester);
    }


}
