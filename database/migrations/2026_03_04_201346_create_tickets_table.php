<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->date('date_shows');
            $table->time('time_shows');
            $table->integer('nomber_ticket');
            $table->integer('rest_ticket');
            $table->integer('price');
            $table->string('code_ticket', 15);
            $table->string('type', 100);
            $table->foreignId('show_id')->constrained('shows')->onDelete('cascade');
            $table->foreignId('ticket_type_id')->nullable()->constrained('tickets_types')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
