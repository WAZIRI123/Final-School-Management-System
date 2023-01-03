<?php

namespace Tests;

use Database\Seeders\PermissionSeeder;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

use function Orchestra\Testbench\artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    use RefreshDatabase;
    
    public function setUp(): void
    {
        parent::setUp();
        // permissions
        $role = DB::table('roles')->count();

if ( $role== 0) {
    $this->seed([RolesAndPermissionsSeeder::class,PermissionSeeder::class]);
}

    }





}
