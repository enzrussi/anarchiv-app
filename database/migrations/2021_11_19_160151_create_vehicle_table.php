<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            //
            $table->id();
            $table->string('plate',50)->nullable();
            $table->string('model',150)->nullable();
            $table->string('color', 100)->nullable();
            $table->string('relationship',100)->nullable();
            $table->timestamps();
            $table->foreignId('subject_id')->constrained();
            $table->string('updatedfrom',150);
            $table->string('note',255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            //
        });
    }
}
