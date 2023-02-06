<?php

namespace Onesk\RabbitEcho\Tests;

use Onesk\RabbitEcho\Facades\RabbitEcho;
use Onesk\RabbitEcho\ServiceProvider;
use Orchestra\Testbench\TestCase;

class RabbitEchoTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'rabbit-echo' => RabbitEcho::class,
        ];
    }

    public function testExample()
    {
        $this->assertEquals(1, 1);
    }
}
