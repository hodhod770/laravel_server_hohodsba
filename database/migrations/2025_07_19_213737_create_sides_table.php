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
        Schema::create('sides', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->comment('Name of the side');
            $table->string('uuid')->nullable()->comment('UUID of the side');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sides');
    }
};
