<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sessions', function (Blueprint $table) {
            $table->integer('user_id')->nullable()->unsigned()->change();

            $table->integer('guest_id')->nullable()->unsigned();
            $table->foreign('guest_id')
                ->references('id')->on('guests')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sessions', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->change();

            $table->dropColumn(['guest_id']);
            $table->dropForeign('guest_id');
        });
    }
}
