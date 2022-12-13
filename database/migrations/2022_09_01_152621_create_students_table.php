<?php

use App\Enums\ClassSectionEnum;
use App\Enums\GenderEnum;
use App\Enums\StudentStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('admission_no')->unique();
            $table->foreignId('parent_id')->constrained()->onDelete('cascade');
            $table->foreignId('class_id')->constrained()->onDelete('cascade');
            $table->string('gender')->default(GenderEnum::Male->value);
            $table->string('section')->default(ClassSectionEnum::A->value);
            $table->string('Status')->default(StudentStatusEnum::Active->value);
            $table->string('phone');
            $table->boolean('is_graduated')->default(false);
            $table->date('dateofbirth');
            $table->string('current_address');
            $table->string('permanent_address');
            $table->integer('rank')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
