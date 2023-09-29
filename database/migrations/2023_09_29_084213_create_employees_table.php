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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 10);
            $table->string('nik', 16);
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone', 20);
            $table->string('front_title')->nullable();
            $table->string('rear_title')->nullable();
            $table->enum('gender', ['MALE', 'FEMALE']);
            $table->enum('religion', ['ISLAM', 'PROTESTAN', 'KATHOLIK', 'BUDDHA', 'HINDU', 'KONGHUCU']);
            $table->string('birth_place');
            $table->date('birth_date');
            $table->text('address');
            $table->string('zip_code', 5);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
