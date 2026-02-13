<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Perform initial test setup.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Ensure roles/permissions are available for tests that call assignRole()
        $this->seed(\Database\Seeders\RolePermissionSeeder::class);
    }
}
