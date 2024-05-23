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
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['academy', 'non_academy']);
            $table->string('degree')->nullable();
            $table->text('description');
            $table->timestamp('start_at');
            $table->timestamp('end_at')->nullable();
            $table->boolean('is_finish')->default(false);
            $table->string('link')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
};
