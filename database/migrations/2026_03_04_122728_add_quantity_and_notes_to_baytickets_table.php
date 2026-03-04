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
        Schema::table('baytickets', function (Blueprint $table) {
            $table->integer('quantity')->default(1)->after('ticket_id');
            $table->text('notes')->nullable()->after('qrcode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('baytickets', function (Blueprint $table) {
            $table->dropColumn(['quantity', 'notes']);
        });
    }
};
