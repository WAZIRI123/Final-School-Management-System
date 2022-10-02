<?php

namespace Tests\Feature\Livewire\Graduate;

use App\Http\Livewire\Dashboard\StudentGraduate\StudentGraduate;
use App\Models\Student;
use App\Models\User;
use App\Traits\FeatureTestTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreateGraduateTest extends TestCase
{
    use RefreshDatabase;
    use FeatureTestTrait, AuthorizesRequests;

    /** @test  */
    public function authorized_user_can_create_graduate()
    {
        $this->withoutExceptionHandling();


        // make fake user && assign role && acting as that user
        $user1 = User::factory()->create();
        $user1->assignRole('admin');
        $student = Student::factory()->for($user1)->create();

        // check if user has given permission/gate   
        $user1->can('graduate student', Student::class);

        Livewire::actingAs($user1)
            ->test(StudentGraduate::class,['student' => $student])
            ->set('old_section', \App\Enums\ClassSectionEnum::A)
            ->set('old_class', 1)

            ->set('selectedRows', [1])
            ->call('graduateStudents');

        // test if data exist in database
        $this->assertDatabaseHas('students', [
            'is_graduated' =>true,
        ]);
    }
}
