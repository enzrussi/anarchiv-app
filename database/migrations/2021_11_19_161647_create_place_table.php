<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            //
            $table->id();
            $table->string('name',100);
            $table->string('address',150)->nullable();
            $table->string('city',50)->nullable();
            $table->string('zipcode',15)->nullable();
            $table->string('relationship',150)->nullable();
            $table->foreignId('subject_id')->constrained();
            $table->timestamps();
            $table->string('updatedfrom',150);
            $table->text('note')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('places', function (Blueprint $table) {
            //
        });
    }
}
