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
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama lengkap
            $table->string('email')->unique(); // Email unik
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('pengguna'); // ← Tambahkan kolom role, default: pengguna
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengguna');
    }
};
