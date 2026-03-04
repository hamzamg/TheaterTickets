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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->date('date_shows');
            $table->time('time_shows');
            $table->integer('nomber_ticket');
            $table->integer('rest_ticket');
            $table->integer('price');
            $table->string('code_ticket');
            $table->string('type');
            $table->foreignId('show_id')->constrained('shows')->cascadeOnDelete();
            $table->foreignId('ticket_type_id')->nullable()->constrained('tickets_types')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
