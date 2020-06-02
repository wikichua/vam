<?php

namespace Wikichua\VAM\Facades;

use Illuminate\Support\Facades\Facade;

class VAM extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'vam';
    }
}
