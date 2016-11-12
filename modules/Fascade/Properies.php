<?php
/**
 * Created by PhpStorm.
 * User: asolorzano
 * Date: 12/11/16
 * Time: 01:51 AM
 */

namespace Modules\Facades;

use Illuminate\Support\Facades\Facade;


class Properies extends Facade
{
    public static function getFacadeAccessor()
    {
        return Modules\Properies\ProperiesMod::class;
        //return \Modules\Properies\ProductMod::class;
    }
}