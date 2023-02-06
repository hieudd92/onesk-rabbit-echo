<?php

namespace Onesk\RabbitEcho\Facades;

use Illuminate\Support\Facades\Facade;

class RabbitEcho extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'rabbit-echo';
    }
}
