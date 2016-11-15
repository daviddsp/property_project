<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 8/09/16
 * Time: 09:31 AM
 */

namespace Modules\Token;

use Illuminate\Support\Facades\Config;

class TokenMod
{
    protected $app_key;

    public function __construct()
    {
        $this->app_key = Config::get('app.key');
    }

    public function generate()
    {
        $token = $this->newToken();

        return $token;
    }

    protected function newToken()
    {
        return hash_hmac('sha256', str_random(40), $this->app_key);
    }
}