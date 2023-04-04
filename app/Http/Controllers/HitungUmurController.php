<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HitungUmurController extends Controller
{
    public function hitung_umur($data)
    {
        $tanggal_lahir = date('d-m-Y', strtotime($data));

        $birthDate = new \DateTime($tanggal_lahir);
        $today = new \DateTime("today");
        if ($birthDate > $today) {
            return "0 tahun 0 bulan 0 hari";
        }
        $y = $today->diff($birthDate)->y;
        // dd($y);
        $m = $today->diff($birthDate)->m;
        $d = $today->diff($birthDate)->d;
        $res = [
            "umur" => [
                "year" => $y,
                "month" => $m,
                "day" => $d
            ]
        ];
        // dd($tanggal_lahir);
        return $res;
    }
}
