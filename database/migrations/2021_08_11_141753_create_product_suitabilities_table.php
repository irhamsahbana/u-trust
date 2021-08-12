<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSuitabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_suitabilities', function (Blueprint $table) {
            $table->foreignId('series_variety_id')->constrained('series_varieties')->onDelete('cascade');
            $table->foreignId('product_variety_id')->constrained('product_varieties')->onDelete('cascade');
            $table->primary(['series_variety_id', 'product_variety_id'], 'product_suitabilities_primary');
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
        Schema::dropIfExists('product_suitabilities');
    }
}
