<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('category_id')->nullable();
            $table->string('category_name')->nullable();
            $table->integer('sub_category_id')->nullable();
            $table->string('sub_category_name')->nullable();
            $table->tinyInteger('is_featured')->default(0);
            $table->string('type')->nullable();
            $table->string('sku')->nullable();
            $table->string('name')->nullable();
            $table->string('product_slug')->nullable();
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->string('tax_status')->nullable();
            $table->double('weight', 8, 2)->nullable();
            $table->double('length', 8, 2)->nullable();
            $table->double('width', 8, 2)->nullable();
            $table->double('height', 8, 2)->nullable();
            $table->decimal('price', 10, 6)->nullable();
            $table->text('featured_image')->nullable();
            $table->string('color')->nullable();
            $table->string('other_information')->nullable();
            $table->string('extra_discount')->nullable();
            $table->integer('is_deleted')->default(0);
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
        Schema::dropIfExists('products');
    }
}
