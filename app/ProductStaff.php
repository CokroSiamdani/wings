<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductStaff extends Model
{
    protected $table = 'product_staff';

    protected $primaryKey = 'id';

    protected $fillable = [
        'product_id',
        'staff_id'
    ];

    public function staff()
    {
        return $this->belongsTo('App\Staff');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
