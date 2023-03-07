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
        Schema::create('tickets', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            //$table->string('uuid')->unique();
            $table->date('date_shows');
            $table->time('time_shows');
            $table->integer('nomber_ticket');
            $table->integer('rest_ticket');
            $table->integer('price');
            $table->string('code_ticket',15);
            $table->string('type');
            $table->string('show_id');
            //$table->bigInteger('show_id')->unsigned();
            $table->timestamps();
        });
    //     Schema::table('tickets', function (Blueprint $table) {
    //         $table->foreign('show_id')->references('id')->on('shows')->onDelete('cascade');
    //    });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};
