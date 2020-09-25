<?php

namespace Hypnotract\ViewIdentifier;

/**
 * Class Facade
 * @package Hypnotract\ViewIdentifier
 */
class Facade extends \Illuminate\Support\Facades\Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return ViewIdentifier::class;
    }
}
