<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVarietySuitablitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variety_suitablities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('series_variety_id')->constrained('series_varieties')->onDelete('cascade');
            $table->foreignId('product_variety_id')->constrained('product_varieties')->onDelete('cascade');
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
        Schema::dropIfExists('product_variety_suitablities');
    }
}
