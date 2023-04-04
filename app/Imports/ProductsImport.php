<?php

namespace App\Imports;

use App\Product;
use App\Category;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $category = Category::where('name', $row['category'])->first();
        $buy_date = Carbon::parse($row['buy_date']);
        if ($row['expired_date']) {
            $expired_date = Carbon::parse($row['expired_date']);
            $is_remind = '1';
            $waktu_remind = Carbon::create($row['expired_date'])->subMonth(1);
            $repeat_remind = Carbon::create($row['expired_date'])->subRealWeek(1);
        } else {
            $expired_date = $row['expired_date'];
            $is_remind = '0';
            $waktu_remind = null;
            $repeat_remind = null;
        }

        return new Product([
            'product_name' => $row['product_name'],
            'specification' => $row['specification'],
            'serial_number' => $row['serial_number'],
            'buy_date' => $buy_date,
            'expired_date' => $expired_date,
            'price' => $row['price'],
            'brand' => $row['brand'],
            'category_id' => $category->id,
            'is_remind' => $is_remind,
            'waktu_remind' => $waktu_remind,
            'repeat_remind' => $repeat_remind,
        ]);
    }
}
