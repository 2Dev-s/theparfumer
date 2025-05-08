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
        Schema::create('perfumes', function (Blueprint $table) {
            $table->id();

            $table->string('name'); // Numele parfumului
            $table->string('slug')->unique(); // Slug SEO-friendly
            $table->unsignedBigInteger('brand_id'); // FK către branduri
            $table->unsignedBigInteger('category_id'); // FK către categorii

            $table->text('description')->nullable(); // Descriere
            $table->json('top_notes')->nullable(); // Note de vârf (JSON)
            $table->json('middle_notes')->nullable(); // Note de mijloc (JSON)
            $table->json('base_notes')->nullable(); // Note de bază (JSON)

            $table->decimal('price', 8, 2)->default(0); // Preț
            $table->string('size')->nullable(); // Ex: 100ml
            $table->string('concentration')->nullable(); // Ex: EDT, EDP
            $table->integer('stock')->default(0); // Stoc
            $table->boolean('active')->default(1);

            $table->timestamps();

            // Foreign keys
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfumes');
    }
};
