<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database. TimetableSeeder
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SchoolSeeder::class,
            RolesAndPermissionsSeeder::class,
            SchoolSettingsSeeder::class,
            UserSeeder::class,
            SubjectSeeder::class,
            SemesterSeeder::class,
            AcademicYearSeeder::class,
            PromotionSeeder::class,
            ClassesSeeder::class,
            PermissionSeeder::class,
            TimetableSeeder::class,
            TimeTableTimeSlotSeeder::class,
            WeekDaySeeder::class,
            ExamSeeder::class,
            ExamSlotSeeder::class,
        ]);
    }
}
