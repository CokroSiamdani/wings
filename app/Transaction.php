<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $primaryKey = 'id';

    protected $fillable = [
        'transaction_date',
        'total_item',
        'purchase_note'
    ];

    public function product()
    {
        return $this->hasMany('App\Product', 'transaction_id');
    }
}
