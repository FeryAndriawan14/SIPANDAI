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
        Schema::create('permohonans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_tiket')->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('jenis_layanan_id')->constrained('jenis_layanans')->onDelete('cascade');
            $table->string('nik_pemohon', 16);
            $table->string('nama_pemohon');
            $table->text('detail_permohonan');


            // Kolom berkas persyaratan dipecah menjadi 3 untuk mendukung multi-file
            $table->string('berkas_kk')->nullable();
            $table->string('berkas_pengantar')->nullable();
            $table->string('berkas_pendukung')->nullable();

            $table->string('status')->default('Menunggu');
            $table->text('catatan_operator')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonans');
    }
};
