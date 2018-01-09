<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->increments('id');

            $table->dateTime('started_at');
            $table->dateTime('end_at');
            $table->dateTime('ended_at')->nullable();

            $table->integer('place_id')->unsigned();
            $table->foreign('place_id')
                ->references('id')->on('places')
                ->onDelete('cascade');

            $table->integer('zone_id')->unsigned();
            $table->foreign('zone_id')
                ->references('id')->on('zones')
                ->onDelete('cascade');

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
        Schema::dropIfExists('sessions');
    }
}
