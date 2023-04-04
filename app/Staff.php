<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_staff',
        'position',
        'division'
    ];

    public function product()
    {
        return $this->hasMany(Product::class, 'staff_id');
    }
}
