<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 7/09/16
 * Time: 11:32 AM
 */

namespace Modules\Facades;

use Illuminate\Support\Facades\Facade;

class Token extends Facade
{
    public static function getFacadeAccessor()
    {
        return \Modules\Token\TokenMod::class;
    }
}