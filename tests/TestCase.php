<?php

namespace Tests;

use Database\Seeders\PermissionSeeder;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

use function Orchestra\Testbench\artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    
    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('migrate:fresh');

        $this->seed([RolesAndPermissionsSeeder::class,PermissionSeeder::class]);
    }



}
