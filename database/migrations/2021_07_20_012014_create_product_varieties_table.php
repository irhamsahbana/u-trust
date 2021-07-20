<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVarietiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_varieties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')
            ->onDelete('cascade');
            $table->string('no_part_or_material');
            $table->bigInteger('price');
            $table->timestamps();

            //laravel 6 and below syntax
            //$table->unsignedBigInteger('product_id');
            //$table->foreign('product_id)')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_varieties');
    }
}
