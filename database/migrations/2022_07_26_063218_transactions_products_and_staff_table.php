<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TransactionsProductsAndStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('transaction_date');
            $table->string('total_item');
            $table->string('purchase_note');
            $table->timestamps();
        });

        Schema::create('staff', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_staff');
            $table->string('position');
            $table->string('division');
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('transaction_id')->nullable();
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->string('product_name');
            $table->string('specification')->nullable();
            $table->string('serial_number')->nullable();
            $table->date('buy_date')->nullable();
            $table->date('expired_date')->nullable();
            // $table->integer('quantity')->default(0);
            $table->integer('price')->default(0)->nullable();
            // $table->integer('availableQty')->default(0);
            // $table->string('box_id')->nullable();
            // $table->integer('brand_id')->nullable();
            $table->string('brand')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('nilai_asset')->nullable();
            $table->string('deskripsi')->nullable();
            $table->boolean('is_remind')->default(0)->nullable();
            $table->date('waktu_remind')->nullable();
            $table->date('repeat_remind')->nullable();
            $table->timestamps();

            $table->foreign('transaction_id')->references('id')->on('transactions')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('staff_id')->references('id')->on('staff')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::create('product_staff', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('staff_id');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('staff_id')->references('id')->on('staff')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('staff');
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_staff');
    }
}
