<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    //
    protected $table = 'state';

    protected $fillable = ['name'];

    /**
     * Get the property .
     *
     */
    public function property()
    {
        return $this->hasMany('App\Property');
    }
}
