<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyFacilities extends Model
{
    //
    protected $table = 'properies_facilities';

    public $timestamps = false;


    protected $fillable = [
        'id_property',
        'id_facility'
    ];


    function property(){

        return $this->belongsTo('App\Property', 'id', 'id_property');
    }

    function facilities(){

        return $this->belongsTo('Facilities');
    }
}
