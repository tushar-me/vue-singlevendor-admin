<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_areas', function (Blueprint $table) {
            $table->id();
            $table->string('area_name');
            $table->string('area_code');
            $table->integer('delivery_charge');
            $table->integer('charge_condition')->nullable();
            $table->integer('charge_condition_price')->nullable();
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
        Schema::dropIfExists('order_areas');
    }
};
