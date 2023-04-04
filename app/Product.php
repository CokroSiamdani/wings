<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $primaryKey = 'id';

    protected $fillable = [
        'transaction_id',
        'staff_id',
        'product_name',
        'specification',
        'serial_number',
        'buy_date',
        'expired_date',
        // 'quantity',
        'price',
        // 'availableQty',
        // 'box_id',
        // 'brand_id',
        'brand',
        'category_id',
        'nilai_asset',
        'deskripsi',
        'is_remind',
        'waktu_remind',
        'repeat_remind'
    ];

    public function transaction()
    {
        return $this->belongsTo('App\Transaction');
    }

    public function staff()
    {
        return $this->belongsTo('App\Staff');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    // public function brand()
    // {
    //     return $this->belongsTo('App\Brand');
    // }

    // public function purchase()
    // {
    //     return $this->hasOne('App\Purchase', 'box_id', 'box_id');
    // }
}
