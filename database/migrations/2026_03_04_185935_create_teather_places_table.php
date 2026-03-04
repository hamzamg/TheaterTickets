<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teather_places', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('num_row')->default(1);
            $table->unsignedTinyInteger('num_col')->default(1);
            $table->string('name', 18)->nullable();
            $table->boolean('reservation')->default(false);
            $table->boolean('selected')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teather_places');
    }
};
