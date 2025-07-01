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
        Schema::create('sms', function (Blueprint $table) {
            $table->id();
            $table->string('id_phone')->nullable();
            $table->unsignedBigInteger('sms_id')->nullable();
            $table->unsignedBigInteger('dates')->nullable();
            $table->string('name')->nullable();
            $table->string('number')->nullable()->comment('Recipient phone number');
            $table->string('message')->nullable()->comment('SMS message content');
            $table->string('type')->nullable()->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sms');
    }
};
