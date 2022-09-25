<?php

namespace Tests\Feature\Livewire\Parent;

use App\Http\Livewire\Dashboard\Parent\CrudChild;
use App\Models\Parents;
use App\Models\User;
use App\Traits\FeatureTestTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Livewire\Livewire;
use Tests\TestCase;

class CreateParentTest extends TestCase
{
    use RefreshDatabase;
    use FeatureTestTrait, AuthorizesRequests;


    //test view all parents cannot be accessed by unauthorised users
    public function test_view_all_parents_cannot_be_accessed_by_unauthorised_users()
    {
        $this->unauthorized_user();
        Livewire::test('dashboard.parent.crud')
            ->assertForbidden();
    }

    //test view all parents can be accessed by authorised users
    public function test_if_only_parent_under_given_school_can_be_seen_accessed_by_authorised_users()
    {
        $this->withoutExceptionHandling();


        // make fake user && assign role && acting as that user && parent create
        $user = User::factory()->create();
     Parents::factory()->for($user)->create(['permanent_address'=> 'Waziribig']);
        $user1 = User::factory()->create(['school_id'=>2]);
         Parents::factory()->for($user1)->create(['permanent_address'=> 'notttt']);

        $user->assignRole('Admin');

         // check if user has given permission/gate   
         $user->can('viewAny', [User::class, 'Parent']);

        Livewire::actingAs($user)
                ->test('dashboard.parent.crud')
                 ->assertOk()
                 ->assertSee('Waziribig')
                 ->assertDontSee('notttt');

    }


    /** @test */
    public function blade_template_is_wired_properly()
    {
        $this->withoutExceptionHandling();


        Livewire::test('dashboard.parent.crud-child')
            ->assertSeeHtml('wire:model.defer="item.name"')
            ->assertSeeHtml('wire:model.defer="item.email"')
            ->assertSeeHtml('wire:model.defer="item.gender"')
            ->assertSeeHtml('wire:model.defer="item.phone"')
            ->assertSeeHtml('wire:model.defer="item.current_address"')
            ->assertSeeHtml('wire:model.defer="item.permanent_address"')
            ->assertSeeHtml('wire:model.defer="profile_picture"')
            ->assertSeeHtml('wire:click="createItem()"');
    }


    /** @test  */

    public function unauthorized_user_can_not_create_parent()
    {

        Livewire::actingAs(User::factory()->create())
            ->test(CrudChild::class)
            ->set('item.name', 'waziri')
            ->set('item.email', 'waziriallyamir@gmail.com')
            ->set('item.admission_no', '0653062266')
            ->set('item.gender', 'male')
            ->set('item.phone', '0653039317')
            ->set('item.current_address', 'moshi')
            ->set('item.permanent_address', 'moshi')
            ->call('createItem')
            ->assertForbidden();
    }
    //test unauthorised users cannot edit parents

    public function test_unauthorised_users_cannot_edit_parents()
    {
        // make fake user &&  acting as that user and parent
        $user = User::factory()->create();
        $parent = Parents::factory()->create();
        Livewire::actingAs($user)
            ->test(CrudChild::class, ['item' => $parent])
            ->call('showEditForm', $parent)
            ->set('item.permanent_address', 'waziribig')
            ->call('editItem', $parent)
            ->assertForbidden();
    }

    //test authorised users can edit parents
    public function test_authorised_users_can_edit_parents()
    {
        $this->withoutExceptionHandling();

        //make fake disk
        Storage::fake('public');

        // make fake image
        $imagename = 'parent-image.png';
        Storage::disk('public')
            ->putFileAs('', UploadedFile::fake()->image($imagename), $imagename);

        // make fake user && assign role && acting as that user
        $user1 = User::factory()->create(['profile_picture' => $imagename, 'remember_token' => null]);
        $user1->assignRole('admin');
        $parent = Parents::factory()->for($user1)->create();

        // check if user has given permission/gate   
        $user1->can('update', [$user1, 'parents']);

        // make fake image2
        $imagename2 = 'parent-image2.png';
        $image2 = UploadedFile::fake()->image($imagename2);

        // test
        Livewire::actingAs($user1)
            ->test(CrudChild::class, ['item' => $parent, 'oldImage' => $parent->user->profile_picture])
            ->call('showEditForm', $parent)

            ->set('item.permanent_address', 'waziribig')

            ->set('profile_picture', $image2)

            ->call('editItem', $parent);

        // test if data exist in database
        $this->assertDatabaseHas('parents', [
            'permanent_address' => 'waziribig'
        ]);
        $this->assertDatabaseHas('users', [
            'profile_picture' => 'img/profile_picture/upload/' . $imagename2
        ]);

        // test if image exist and match updated one
        Storage::disk('public')->assertMissing('img/profile_picture/upload/' . $imagename);

        Storage::disk('public')->assertExists('img/profile_picture/upload/' . $imagename2);
    }

    //test unauthorised users cannot edit parents
    public function test_unauthorised_users_cannot_delete_parents()
    {
        $user = User::factory()->create();
        $parent = Parents::factory()->create();
        Livewire::actingAs($user)
            ->test(CrudChild::class, ['item' => $parent])
            ->call('deleteItem', $parent)
            ->assertForbidden();
    }
    //test authorised users can edit parents

    public function test_authorised_users_can_delete_parents()
    {
        // make fake user && assign role && acting as that user
        $user = User::factory()->create();
        $user->assignRole('admin');
        $user->can('delete', [$user, 'parent']);
        $parent = Parents::factory()->for($user)->create();

        // test
        Livewire::actingAs($user)
            ->test(CrudChild::class, ['parent' => $parent])
            ->call('showDeleteForm', $parent)
            ->call('deleteItem', $parent);

        // test if data is softdeleted
        $this->assertSoftDeleted($parent);
    }
}
