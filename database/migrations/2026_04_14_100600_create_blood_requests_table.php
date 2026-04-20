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
        Schema::create('blood_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hospital_id')->constrained('hospital_profiles')->cascadeOnDelete();
            $table->string('blood_type');
            $table->integer('quantity');
            $table->enum('urgency', ['low', 'medium', 'high', 'critical']);
            $table->enum('status', ['open', 'closed', 'fulfilled', 'cancelled']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blood_requests');
    }
};
