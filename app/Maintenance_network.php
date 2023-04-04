<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maintenance_network extends Model
{
    protected $table = 'maintenances_network';

    protected $primaryKey = 'id';

    protected $fillable = [
        'maintenance_date',
        'category',
        'brand',
        'serial_number',
        'power',
        'connection',
        'restarted',
        'description',
        'signed'
    ];
}
