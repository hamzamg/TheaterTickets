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
            $table->id(); // unique auto-incrementing id column
            $table->unsignedTinyInteger('num_row')->nullable(false)->default(1); // number of rows, with a maximum value of 3
            $table->unsignedTinyInteger('num_col')->nullable(false)->default(1); // number of columns, with a maximum value of 3
            $table->string('name', 18)->nullable(); // a nullable string with a maximum length of 10 characters
            $table->boolean('reservation')->nullable(false)->default(false); // a boolean column indicating whether the place is reserved or not
            $table->boolean('selected')->nullable(false)->default(false); // a boolean column indicating whether the place is reserved or not
            $table->timestamps(); // automatically adds created_at and updated_at columns

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
