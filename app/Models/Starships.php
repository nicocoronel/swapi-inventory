<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Starships extends Model
{
    protected $fillable = [
        'id_starship',
        'name',
        'model',
        'starship_class',
        'manufacturer',
        'cost_in_credits',
        'length',
        'crew',
        'passengers',
        'max_atmosphering_speed',
        'hyperdrive_rating',
        'MGLT',
        'cargo_capacity',
        'consumables',
        'films',
        'pilots',
        'url',
        'created',
        'edited',
        'count' // Campo para el inventario
    ];
}
