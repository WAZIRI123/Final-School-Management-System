<?php

namespace Tests\Feature\Livewire\Student;

use App\Http\Livewire\Dashboard\Student\CrudChild;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Traits\FeatureTestTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

class CreateStudentTest extends TestCase
{
    use RefreshDatabase;
    use FeatureTestTrait;

    /** @test */
    public function blade_template_is_wired_properly(){
        $this->withoutExceptionHandling();
        Livewire::test('dashboard.student.crud-child')
            ->assertSeeHtml('wire:model.defer="item.name"')
            ->assertSeeHtml('wire:model.defer="item.email"')
            ->assertSeeHtml('wire:model.defer="item.gender"')
            ->assertSeeHtml('wire:model.defer="item.phone"')
            ->assertSeeHtml('wire:model.defer="item.dateofbirth"')
            ->assertSeeHtml('wire:model.defer="item.current_address"')
            ->assertSeeHtml('wire:model.defer="item.permanent_address"')
            ->assertSeeHtml('wire:model.defer="item.parent_id"')
            ->assertSeeHtml('wire:model.defer="item.class_id"')
            ->assertSeeHtml('wire:model.defer="profile_picture"')
            ->assertSeeHtml('wire:click="createItem()"');
      
          
    }


    
    /** @test  */
    
    public function authorized_user_can_create_student()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

       $user->givePermissionTo('create student');
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $this->actingAs($user);
        
        Livewire::test(CrudChild::class)
        ->set('item.name', 'waziri')
        ->set('item.email', 'waziriallyamir@gmail.com')
        ->set('item.admission_no', '0653062266')
        ->set('item.gender', 'male')
        ->set('item.phone', '0653039317')
        ->set('item.dateofbirth', '2000/02/20')
        ->set('item.current_address', 'moshi')
        ->set('item.permanent_address', 'moshi')
        ->set('item.parent_id', 9)
        ->set('item.class_id', 8)
        ->call('createItem');

        $this->assertDatabaseHas('students',[
            'class_id'=>8,
            'permanent_address'=>'moshi'
        ]);
    }
    /** @test  */
    
    public function unauthorized_user_can_not_create_student()
    {

        Livewire::actingAs(User::factory()->create())
         ->test(CrudChild::class)
        ->set('item.name', 'waziri')
        ->set('item.email', 'waziriallyamir@gmail.com')
        ->set('item.admission_no', '0653062266')
        ->set('item.gender', 'male')
        ->set('item.phone', '0653039317')
        ->set('item.dateofbirth', '2000/02/20')
        ->set('item.current_address', 'moshi')
        ->set('item.permanent_address', 'moshi')
        ->set('item.parent_id', 9)
        ->set('item.class_id', 8)
        ->call('createItem')
        ->assertForbidden();

        
        $this->assertDatabaseHas('students',[
            'class_id'=>8,
            'permanent_address'=>'moshi'
        ]);
    }
}
