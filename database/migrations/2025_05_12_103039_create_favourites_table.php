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
        Schema::create('favourites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('perfume_id');
            $table->timestamps();

            // Add unique constraint to prevent duplicate favorites
            $table->unique(['user_id', 'perfume_id']);

            // Foreign key constraints with proper table names and cascade delete
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('perfume_id')
                ->references('id')
                ->on('perfumes') // Changed from 'perfume' to 'perfumes' to match Laravel's convention
                ->onDelete('cascade');

            // Add indexes for better performance on queries
            $table->index('user_id');
            $table->index('perfume_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop foreign keys first to avoid errors
        Schema::table('favourites', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['perfume_id']);
        });

        Schema::dropIfExists('favourites');
    }
};
