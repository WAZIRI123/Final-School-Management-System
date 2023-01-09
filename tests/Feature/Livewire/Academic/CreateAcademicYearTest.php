<?php

namespace Tests\Feature\Livewire\Academic;

use App\Http\Livewire\Dashboard\AcademicYear\CrudChild;
use App\Http\Livewire\Dashboard\AcademicYear\SetAcademicYear;
use App\Models\AcademicYear;
use App\Models\School;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Livewire;
use App\Traits\FeatureTestTrait;
use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateAcademicYearTest extends TestCase
{
    use RefreshDatabase;
    use FeatureTestTrait, AuthorizesRequests;

    //test view all academicyear cannot be accessed by unauthorised users
    public function test_view_all_academicyear_cannot_be_accessed_by_unauthorised_users()
    {
        $this->unauthorized_user();
        Livewire::test('dashboard.academic-year.crud')
            ->assertForbidden();
    }

    //test view all academicyear can be accessed by authorised users
    public function test_if_only_academicyear_under_given_school_can_be_seen_accessed_by_authorised_users()
    {
        $this->withoutExceptionHandling();


        // make fake user && assign role && acting as that user && academicyear create
        $school = School::factory()->create();

        $user = User::factory()->for($school)->create();
        
        AcademicYear::factory()->create(['start_year' => '2000', 'school_id' => 1]);

        AcademicYear::factory()->create(['start_year' => '2001/02/20', 'school_id' => 2]);

        $user->assignRole('Admin');

        // check if user has given permission/gate   
        $user->can('viewAny', [academicyear::class]);

        Livewire::actingAs($user)
            ->test('dashboard.academic-year.crud')
            ->assertOk()
            ->assertSee('2000')
            ->assertDontSee('2001/02/20');
    }


    /** @test */
    public function blade_template_is_wired_properly()
    {
        $this->withoutExceptionHandling();


        Livewire::test('dashboard.academic-year.crud-child')
            ->assertSeeHtml('wire:model.defer="item.start_year"')
            ->assertSeeHtml('wire:model.defer="item.stop_year"')
            ->assertSeeHtml('wire:click="createItem()"')
            ->assertSeeHtml('wire:click="editItem()"');
    }


    /** @test  */

    public function unauthorized_user_can_not_create_academicyear()
    {

        Livewire::actingAs(User::factory()->create())
            ->test(CrudChild::class)
            ->set('item.start_year', '2000/02/02')
            ->set('item.stop_year', '2001/02/02')
            ->call('createItem')
            ->assertForbidden();
    }

    /** @test  */

    public function authorized_user_can_create_academicyear()
    {
        // make fake user && assign role && acting as that user
        $user1 = User::factory()->create();
        $user1->assignRole('admin');

        // check if user has given permission/gate   
        $user1->can('create', [$user1, 'academic year']);

        Livewire::actingAs($user1)
            ->test(CrudChild::class)
            ->set('item.start_year', '2000')
            ->set('item.stop_year', '2001')
            ->call('createItem');

        // test if data exist in database
        $this->assertDatabaseHas('academic_years', [
            'start_year' => '2000',
            
        ]);
    }

    //test unauthorised users cannot edit academicyear
    public function test_unauthorised_users_cannot_edit_academicyear()
    {
        // make fake user &&  acting as that user and academicyear
        $user = User::factory()->create();
        $academicyear =AcademicYear::factory()->create();
        Livewire::actingAs($user)
            ->test(CrudChild::class, ['item' => $academicyear])
            ->call('showEditForm', $academicyear)
            ->set('item.start_year', '2000')
            ->call('editItem')
            ->assertForbidden();
    }

    //test authorised users can edit academicyear
    public function test_authorised_users_can_edit_academicyear()
    {
        $this->withoutExceptionHandling();

        // make fake user && assign role && acting as that user
        $user1 = User::factory()->create();
        $user1->assignRole('admin');
        $academicyear = AcademicYear::factory()->create(['school_id'=>$user1->school_id]);

        // check if user has given permission/gate   
        $user1->can('update', [$academicyear]);

        // test
        Livewire::actingAs($user1)
            ->test(CrudChild::class, ['item' => $academicyear])
            ->call('showEditForm', $academicyear)

            ->set('item.start_year', '2000')

            ->call('editItem');

        // test if data exist in database
        $this->assertDatabaseHas('academic_years', [
            'start_year' => '2000'
        ]);
    }

        //test authorised users can edit school academicyear
        public function test_authorised_users_can_edit_school_academicyear()
        {
            $this->withoutExceptionHandling();
    
            // make fake user && assign role && acting as that user
            $user1 = User::factory()->create();
            $user1->assignRole('admin');
            $school = School::factory()->create();
    
            // check if user has given permission/gate   
            $user1->can('set academic year', [$user1, 'academic year']);
    
            // test
            Livewire::actingAs($user1)
                ->test(SetAcademicYear::class, ['item' => $school])

                ->set('academic_year_id', 1)
    
                ->call('setAcademicYear');
    
            // test if data exist in database
            $this->assertDatabaseHas('schools', [
                'academic_year_id' => 1
            ]);
        }

    //test unauthorised users cannot edit academicyear
    public function test_unauthorised_users_cannot_delete_academicyear()
    {
        $user = User::factory()->create();
        $academicyear = academicyear::factory()->create();
        Livewire::actingAs($user)
            ->test(CrudChild::class, ['item' => $academicyear])
            ->call('deleteItem', $academicyear)
            ->assertForbidden();
    }
    
    //test authorised users can edit academicyear
    public function test_authorised_users_can_delete_academicyear()
    {
        // make fake user && assign role && acting as that user
        $user = User::factory()->create();
        $user->assignRole('admin');
        $user->can('delete', [$user, 'academic year']);
        $academicyear = academicyear::factory()->create();

        // test
        Livewire::actingAs($user)
            ->test(CrudChild::class, ['academicyear' => $academicyear])
            ->call('showDeleteForm', $academicyear)
            ->call('deleteItem');

        // test if data is softdeleted
        $this->assertSoftDeleted($academicyear);
    }
}
