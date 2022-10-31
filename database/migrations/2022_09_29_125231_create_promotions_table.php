<?php

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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('old_class_id')->constrained('classes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('new_class_id')->constrained('classes')->onDelete('cascade')->onUpdate('cascade');
            $table->string('old_section');
            $table->string('new_section');
            $table->foreignId('academic_year_id')->constrained('academic_years')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('school_id')->constrained('schools')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('promotions');
    }
};
