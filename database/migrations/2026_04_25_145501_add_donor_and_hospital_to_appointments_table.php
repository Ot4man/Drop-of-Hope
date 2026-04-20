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
        Schema::table('appointments', function (Blueprint $table) {
            $table->foreignId('response_id')->nullable()->change();
            $table->foreignId('donor_id')->nullable()->after('response_id')->constrained('donor_profiles')->cascadeOnDelete();
            $table->foreignId('hospital_id')->nullable()->after('donor_id')->constrained('hospital_profiles')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['donor_id']);
            $table->dropForeign(['hospital_id']);
            $table->dropColumn(['donor_id', 'hospital_id']);
            $table->foreignId('response_id')->nullable(false)->change();
        });
    }
};
