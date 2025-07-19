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
        Schema::create('create_contacts_tables', function (Blueprint $table) {
            $table->id();
              $table->string('id_phone')->nullable(); 
            $table->string('side_id')->nullable();
                // الاسم اختياري
              $table->string('name')->nullable();   // الاسم اختياري
              $table->string('id_number')->nullable();   // الاسم اختياري
        $table->string('number')->nullable();   // رقم الجوال يكون فريد
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('create_contacts_tables');
    }
};
