<?php

namespace Fadion\Sanitizer\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Fadion\Sanitizer\Sanitizer
 */
class Sanitizer extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'sanitizer'; }

}
