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
        Schema::create('baytickets', function (Blueprint $table) {
            $table->id();
            $table->string('client_id', 100);
            $table->string('show_id', 100);
            $table->string('ticket_id', 100);
            $table->string('qrcode',120);
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
        Schema::dropIfExists('baytickets');
    }
};
