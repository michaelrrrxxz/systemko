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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignId('venue_id')->constrained()->onDelete('cascade');
            $table->foreignId('added_by')->nullable(); // user who created the event
            $table->datetime('start_time');
            $table->datetime('end_time');

            // ✅ Approval columns
            $table->foreignId('approved_by')->nullable(); // user who approved/disapproved
            $table->datetime('approved_at')->nullable(); // when approval happened
            $table->text('remarks')->nullable(); // reason for approval/disapproval

            $table->softDeletes();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
