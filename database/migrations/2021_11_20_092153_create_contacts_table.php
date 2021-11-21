<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            //
            $table->id();
            $table->string('contact',150);
            $table->enum('contacttype',['TELEFONO','EMAIL','SOCIAL','WEB','ALTRO']);
            $table->string('relationship',100);
            $table->foreignId('subject_id')->constrained();
            $table->timestamps();
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
        Schema::table('contacts', function (Blueprint $table) {
            //
        });
    }
}
