<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('surname',50)->nullable();
            $table->string('name',50)->nullable();
            $table->date('birthdate')->nullable();
            $table->string('placebirth',100)->nullable();
            $table->string('photo')->nullable();
            $table->string('cuicode',20)->nullable();
            $table->string('fiscalcode',16)->nullable();
            $table->string('nickname',255)->nullable();
            $table->timestamps();
            $table->string('updatedfrom',100);
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subjects', function (Blueprint $table) {
            //

        });
    }
}
