<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('driver_id')->nullable();;
            $table->integer('billing_address_id');
            $table->string('receipt_no')->nullable();
            $table->enum('payment_type', ['Card', 'Paypal', 'Cash-On-Delivery']);
            $table->enum('status', ['Pending', 'Processing', 'Completed'])->default('Pending');
            $table->text('note')->nullable();
            $table->decimal('total_amount', 10, 6)->nullable();
            $table->decimal('discounted_amount', 10, 6)->nullable();
            $table->integer('coupon_id');
            $table->string('sent_date')->nullable();
            $table->string('sent_time')->nullable();
            $table->text('sent_slot')->nullable();
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
