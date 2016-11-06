<?php

namespace CityBoard\Entities;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    //
    protected $fillable = [
    	'license_id',
    	'date_visit',
    	'sanctions',
        'act',
        'type_visit',
    ];
}
