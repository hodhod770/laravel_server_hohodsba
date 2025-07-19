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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
             $table->String('id_phone')->nullable()->comment('ID of the phone associated with the call log');
            $table->string('filename')->nullable()->comment('Name of the image file');
            $table->string('type')->nullable()->comment('Name of the image file');
            $table->string('side_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
