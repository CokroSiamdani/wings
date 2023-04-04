<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maintenance_software extends Model
{
    protected $table = 'maintenances_software';

    protected $primaryKey = 'id';

    protected $fillable = [
        'maintenance_date',
        'client',
        'cloud',
        'vm_name',
        'status',
        'restarted',
        'description',
        'signed'
    ];
}
