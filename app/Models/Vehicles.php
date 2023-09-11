<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicles extends Model
{
    protected $fillable = [
        'id_vehicle',
        'name',
        'model',
        'vehicle_class',
        'manufacturer',
        'length',
        'cost_in_credits',
        'crew',
        'passengers',
        'max_atmosphering_speed',
        'cargo_capacity',
        'consumables',
        'films',
        'pilots',
        'url',
        'created',
        'edited',
        'count', // Campo para el inventario
    ];
}
