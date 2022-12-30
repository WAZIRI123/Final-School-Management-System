<?php

use App\Enums\ClassSectionEnum;
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
        Schema::create('academic_year_student', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('academic_year_id')->notNullable()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('student_id')->notNullable()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('class_id')->notNullable()->onDelete('cascade')->onUpdate('cascade');
            $table->string('section_id')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
