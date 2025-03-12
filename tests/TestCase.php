<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    const Success = 200;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('config:clear');
    }
}
