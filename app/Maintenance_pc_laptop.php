<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maintenance_pc_laptop extends Model
{
    protected $table = 'maintenances_pc_laptop';

    protected $primaryKey = 'id';

    protected $fillable = [
        'maintenance_date',
        'category',
        'item_name',
        'brand',
        'serial_number',
        'user_name',
        'status',
        'password_8_chars',
        'password_combination',
        'description',
        'signed'
    ];
}
