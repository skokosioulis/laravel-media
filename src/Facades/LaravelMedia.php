<?php

namespace Skokosioulis\LaravelMedia\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Skokosioulis\LaravelMedia\LaravelMedia
 */
class LaravelMedia extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Skokosioulis\LaravelMedia\LaravelMedia::class;
    }
}
