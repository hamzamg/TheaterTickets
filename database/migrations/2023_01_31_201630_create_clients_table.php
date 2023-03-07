<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('firstname', 35);
            $table->string('lastname', 35);
            $table->string('sex', 6);
            $table->integer('age');
            $table->string('card_id', 18);
            $table->string('phone', 10);
            $table->string('pay_method', 20);
            //$table->bigInteger('baytickets_id')->unsigned();
            //$table->bigInteger('ticket_id')->unsigned();
            $table->timestamps();
        });
    //     Schema::table('clients', function (Blueprint $table) {
    //         $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
    //    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
};
