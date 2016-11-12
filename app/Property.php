<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    //
    protected $table = 'property';

    protected $fillable = [
        'title',
        'description',
        'address',
        'town',
        'country',
        'state_id',
        'user_id',
        'created_at',
        'updated_at'];

    /**
     * Get the properies facilities .
     *
     */
    public function property_facilities()

    {
        return $this->hasMany('App\PropertyFacilities', 'id_property', 'id');
    }


}
