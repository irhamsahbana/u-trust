<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeriesVarietiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('series_varieties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('series_id')->constrained('series')->onDelete('cascade');
            $table->string('series_variety_name');
            $table->timestamps();

            //laravel 6 and below syntax
            //$table->unsignedBigInteger('series_id');
            //$table->foreign('series_id')->references('id')->on('series');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('series_varieties');
    }
}
