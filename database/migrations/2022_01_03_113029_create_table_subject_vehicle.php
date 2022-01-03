<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSubjectVehicle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_vehicle', function (Blueprint $table) {
            $table->id();
            $table->integer('subject_id');
            $table->integer('vehicle_id');
            $table->string('relationship',50);
            $table->string('updatedfrom');
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
        Schema::dropIfExists('subject_vehicle');
    }
}
