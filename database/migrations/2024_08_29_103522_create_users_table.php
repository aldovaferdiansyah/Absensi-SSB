<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {

            // Data Umum
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->date('date_of_birth');
            $table->string('age_group_category')->nullable();
            $table->string('phone_number')->nullable();

            // Khusus Siswa
            $table->string('parents_name')->nullable();
            $table->string('parents_telephone_number')->nullable();
            $table->string('address')->nullable();

            // Khusus Pelatih
            $table->string('coach_category')->nullable();
            $table->string('age_group_coach_category')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
