<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maintenance_cctv extends Model
{
    protected $table = 'maintenances_cctv';

    protected $primaryKey = 'id';

    protected $fillable = [
        'maintenance_date',
        'category',
        'brand',
        'location',
        'status',
        'description',
        'signed'
    ];
}
