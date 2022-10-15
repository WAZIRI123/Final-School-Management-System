<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\School;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        School::updateOrCreate(
            ['id' => 1],
            [
                'name'     => 'Default School',
                'address'  => 'School of Computing',
                'code'     => Str::Random(10),
                'initials' => 'DSI',
            ]
        );

        School::factory()
                ->count(3)
                ->create();
    }
    }

