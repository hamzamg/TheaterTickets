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
        Schema::table('tickets_types', function (Blueprint $table) {
            $table->string('slug', 120)->nullable()->after('type');
            $table->text('description')->nullable()->after('slug');
            $table->decimal('price_modifier', 8, 2)->default(0)->after('description');
            $table->boolean('active')->default(true)->after('price_modifier');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets_types', function (Blueprint $table) {
            $table->dropColumn(['slug', 'description', 'price_modifier', 'active']);
        });
    }
};
