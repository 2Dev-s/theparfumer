<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('room_perfumes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->text('description')->nullable();
            $table->text('fragrance_notes')->nullable();
            $table->decimal('price', 8, 2);
            $table->string('size')->nullable();
            $table->integer('duration_hours')->nullable();
            $table->string('room_type')->nullable();
            $table->integer('stock')->default(0);
            $table->string('price_id')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('room_perfumes');
    }
};
