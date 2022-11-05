<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $user = User::create([
            'name'          => 'Admin',
            'school_id'         => 1,
            'email'         => 'super-admin@demo.com', 
            'password'      => bcrypt('12345678'),
            'email_verified_at' => now(),
            'created_at'    => date("Y-m-d H:i:s")
        ]);
        $user->assignRole('super-admin');
        $user = User::create([
            'name'          => 'Admin',
            'school_id'         => 1,
            'email'         => 'admin@demo.com',
            'password'      => bcrypt('12345678'),
            'email_verified_at' => now(),
            'profile_picture'   =>'\img\profile_picture\upload\profile.png',
            'created_at'    => date("Y-m-d H:i:s")
        ]);
        $user->assignRole('admin');

        $user2 = User::create([
            'name'          => 'Teacher',
            'school_id'         => 1,
            'email'         => 'teacher@demo.com',
            'email_verified_at' => now(),
            'password'      => bcrypt('12345678'),
            'created_at'    => date("Y-m-d H:i:s")
        ]);
        $user2->assignRole('Teacher');

        $user3 = User::create([
            'name'          => 'Parent',
            'school_id'         => 1,
            'email'         => 'parent@demo.com',
            'password'      => bcrypt('12345678'),
            'email_verified_at' => now(),
            'created_at'    => date("Y-m-d H:i:s")
        ]);
        $user3->assignRole('Parent');

        $user4 = User::create([
            'name'          => 'Student',
            'school_id'         => 1,
            'email'         => 'student@demo.com',
            'email_verified_at' => now(),
            'password'      => bcrypt('12345678'),
            'created_at'    => date("Y-m-d H:i:s")
        ]);
        $user4->assignRole('Student');


        DB::table('teachers')->insert([
            [
                'user_id'           => $user2->id,
                'gender'            => 'male',
                'class_id'          => 1,
                'phone'             => '0123456789',
                'dateofbirth'       => '1993-04-11',
                'admission_no'       => $faker->numerify('###-###-####'),
                'current_address'   => 'Dhaka-1215',
                'permanent_address' => 'Dhaka-1215',
                'created_at'        => date("Y-m-d H:i:s")
            ]
        ]);

        DB::table('parents')->insert([
            [
                'user_id'           => $user3->id,
                'gender'            => 'male',
                'phone'             => '0123456789',
                'admission_no'       => $faker->numerify('###-###-####'),
                'current_address'   => 'Dhaka-1215',
                'permanent_address' => 'Dhaka-1215',
                'created_at'        => date("Y-m-d H:i:s")
            ]
        ]);

        DB::table('students')->insert([
            [
                'user_id'           => $user4->id,
                'parent_id'         => 1,
                'class_id'          => 1,
                'section'          => 'A',
                'admission_no'       => $faker->numerify('###-###-####'),
                'gender'            => 'male',
                'status'            => 'active',
                'phone'             => '0123456789',
                'dateofbirth'       => '1993-04-11',
                'current_address'   => 'Dhaka-1215',
                'permanent_address' => 'Dhaka-1215',
                'created_at'        => date("Y-m-d H:i:s")
            ]
        ]);

        $user=User::factory()->count(10)->create();
        foreach ($user as $student) {
            DB::table('students')->insert([
                [
                    'user_id'           => $student->id,
                    'parent_id'         => 1,
                    'class_id'          => 1,
                    'section'          => 'A',
                    'admission_no'       => $faker->numerify('###-###-####'),
                    'gender'            => 'male',
                    'status'            => 'active',
                    'phone'             => '0123456789',
                    'dateofbirth'       => '1993-04-11',
                    'current_address'   => 'Dhaka-1215',
                    'permanent_address' => 'Dhaka-1215',
                    'created_at'        => date("Y-m-d H:i:s")
                ]
            ]);
        }
    }
}
