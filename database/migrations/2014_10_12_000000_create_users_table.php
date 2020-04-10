<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('f_name')->nullable();
            $table->string('l_name')->nullable();
            $table->boolean('is_admin')->nullable();
            $table->string('email')->unique();
            $table->text('device_id')->nullable();
            $table->string('account_type')->nullable();
            $table->string('picture_type')->nullable();
            $table->text('profile_pic')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('zip')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('stripe_customer_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('gender')->nullable();
            $table->string('password')->nullable();
            $table->enum('status', ['Activate', 'Deactivate'])->default('Activate');
            $table->string('confirmation_code')->nullable();
            $table->string('remember_me')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
