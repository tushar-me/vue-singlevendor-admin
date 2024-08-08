<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('address_id')->nullable()->constrained('addresses')->onDelete('cascade');
            $table->float('sub_total')->nullable();
            $table->float('grand_total')->nullable();
            $table->float('vat')->nullable();
            $table->float('pay_bill')->nullable();
            $table->float('pay_due')->nullable();
            $table->string('payment_method')->nullable();
            $table->enum('order_type', ['customer', 'pos'])->default('customer');
            $table->enum('payment_status', ['paid', 'pending', 'cancelled'])->default("pending");
            $table->enum('order_status', ['pending','received','process','shipped','delivered','cancel'])->default("pending");
            $table->date('order_date')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
