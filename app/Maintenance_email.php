<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maintenance_email extends Model
{
    protected $table = 'maintenances_email';

    protected $primaryKey = 'id';

    protected $fillable = [
        'maintenance_date',
        'name',
        'email',
        'status',
        'description',
        'signed'
    ];
}
