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
        Schema::create('riwayat_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permohonan_id')->constrained('permohonans')->onDelete('cascade');
            $table->foreignId('user_id')->comment('Petugas/Sistem yang mengubah')->constrained('users');
            $table->string('status_awal');
            $table->string('status_akhir');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_statuses');
    }
};
