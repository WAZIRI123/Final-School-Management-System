<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('time_table_time_slot_week_day', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('time_table_time_slot_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('week_day_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('subject_id')->references('id')->on('subjects')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->unique(['week_day_id', 'time_table_time_slot_id'], 'time_slot_week_day');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('time_table_time_slot_week_day');
    }
};
