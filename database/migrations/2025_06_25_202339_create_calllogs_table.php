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
        Schema::create('calllogs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_phone')->nullable()->comment('ID of the phone associated with the call log');
            $table->string('name')->nullable()->comment('Name of the contact associated with the call');
            $table->string('number')->nullable()->comment('Phone number of the contact associated with the call');
            $table->string('type')->nullable()->default('unknown')->comment('Type of call (e.g., incoming, outgoing, missed)');
            $table->timestamp('call_time')->nullable()->comment('Timestamp of the call');
            $table->integer('duration')->nullable()->comment('Duration of the call in seconds');
            // $table->string('status')->nullable()->default('completed')->comment('Status of the call (e.g., completed, missed, rejected)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calllogs');
    }
};
