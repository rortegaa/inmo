<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_informations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('property_id');
            $table->smallInteger('bedrooms')->nullable();
            $table->smallInteger('bathrooms')->nullable();
            $table->smallInteger('parking_lots')->nullable();
            $table->smallInteger('antiquity')->nullable();
            $table->double('price',15,3)->nullable();
            $table->double('price_per_area',15,3)->nullable();
            $table->double('maintenance',15,3)->nullable();
            $table->double('area',15,3)->nullable();
            $table->double('total_area_lot',15,3)->nullable();
            $table->text('sale_message')->nullable();
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
        Schema::dropIfExists('property_informations');
    }
}
