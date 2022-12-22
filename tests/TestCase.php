<?php

namespace Tests;

use Database\Seeders\PermissionSeeder;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication,RefreshDatabase;


    
    public function setUp(): void
    {
        parent::setUp();
        $this->refreshDatabase();
        $this->seed();
    }


}
