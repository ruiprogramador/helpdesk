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
        Schema::create('activities_tickets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('ticket_id')->constrained('tickets')->onDelete('cascade');

            $table->timestamp('closed_at')->nullable();
            $table->timestamp('reopened_at')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamp('assigned_at')->nullable();
            $table->timestamp('unassigned_at')->nullable();
            $table->timestamp('escalated_at')->nullable();
            $table->timestamp('deescalated_at')->nullable();
            $table->timestamp('acknowledged_at')->nullable();
            $table->timestamp('unacknowledged_at')->nullable();
            $table->string('assigned_to')->nullable();
            $table->timestamp('closed_by')->nullable();
            $table->timestamp('reopened_by')->nullable();
            $table->timestamp('resolved_by')->nullable();
            $table->timestamp('assigned_by')->nullable();
            $table->timestamp('unassigned_by')->nullable();
            $table->timestamp('escalated_by')->nullable();
            $table->timestamp('deescalated_by')->nullable();
            $table->timestamp('acknowledged_by')->nullable();
            $table->timestamp('unacknowledged_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities_tickets');
    }
};
