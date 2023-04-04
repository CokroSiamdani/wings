<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Maintenance_pc_laptop;

class MaintenanceApiController extends Controller
{
    public function maintenance_pc_laptop()
    {
        $maintenances_pc_laptop = Maintenance_pc_laptop::get();
        return $maintenances_pc_laptop;
    }
}
