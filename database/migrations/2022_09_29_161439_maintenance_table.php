<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MaintenanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenances_pc_laptop', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('maintenance_date')->nullable();
            $table->string('category')->nullable();
            $table->string('item_name')->nullable();
            $table->string('brand')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('user_name')->nullable();
            $table->string('status')->nullable();
            $table->string('password_8_chars')->nullable();
            $table->string('password_combination')->nullable();
            $table->string('description')->nullable();
            $table->boolean('signed')->default(0);
            $table->timestamps();
        });

        Schema::create('maintenances_network', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('maintenance_date')->nullable();
            $table->string('category')->nullable();
            $table->string('brand')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('power')->nullable();
            $table->string('connection')->nullable();
            $table->string('restarted')->nullable();
            $table->string('description')->nullable();
            $table->boolean('signed')->default(0);
            $table->timestamps();
        });

        Schema::create('maintenances_software', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('maintenance_date')->nullable();
            $table->string('client')->nullable();
            $table->string('cloud')->nullable();
            $table->string('vm_name')->nullable();
            $table->string('status')->nullable();
            $table->string('restarted')->nullable();
            $table->string('description')->nullable();
            $table->boolean('signed')->default(0);
            $table->timestamps();
        });

        Schema::create('maintenances_cctv', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('maintenance_date')->nullable();
            $table->string('category')->nullable();
            $table->string('brand')->nullable();
            $table->string('location')->nullable();
            $table->string('status')->nullable();
            $table->string('description')->nullable();
            $table->boolean('signed')->default(0);
            $table->timestamps();
        });

        Schema::create('maintenances_email', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('maintenance_date')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('status')->nullable();
            $table->string('description')->nullable();
            $table->boolean('signed')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maintenances_pc_laptop');
        Schema::dropIfExists('maintenances_network');
        Schema::dropIfExists('maintenances_software');
        Schema::dropIfExists('maintenances_cctv');
        Schema::dropIfExists('maintenances_email');
    }
}
