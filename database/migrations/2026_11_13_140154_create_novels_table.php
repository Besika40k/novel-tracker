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
        Schema::create('novels', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150);
            $table->string('author', 100);
            $table->string('origin', 20);           // chinese, korean, japanese, english
            $table->string('status', 20);           // reading, planned, completed, dropped: the filter
            $table->integer('chapters_read')->default(0);
            $table->integer('total_chapters');
            $table->decimal('rating', 3, 1);        // 0.0 to 10.0, e.g. 8.5
            $table->boolean('is_favourite')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('novels');
    }
};
