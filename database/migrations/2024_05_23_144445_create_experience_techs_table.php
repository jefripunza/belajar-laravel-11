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
        Schema::create('experience_techs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exp_id')->constrained('experiences')->onDelete('cascade');
            $table->string('icon_slug');
            $table->timestamps();

            $table->unique(['exp_id', 'icon_slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experience_techs');
    }
};
