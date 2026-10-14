<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\JenisLayanan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Account Admin dengan NIK & No HP Lengkap
        User::firstOrCreate(
            ['email' => 'fery.andriawan14@gmail.com'],
            [
                'nik' => '3171012345679999',
                'name' => 'Administrator SPBE',
                'no_hp' => '08986343641',
                'password' => Hash::make('password123'),
                'role' => UserRole::ADMIN,
            ]
        );

        // Account Operator Verifikator dengan NIK & No HP Lengkap
        User::firstOrCreate(
            ['email' => 'fery.andryawan1@gmail.com'],
            [
                'nik' => '3171012345678888',
                'name' => 'Petugas Operator Verifikasi',
                'no_hp' => '081234567891',
                'password' => Hash::make('password123'),
                'role' => UserRole::OPERATOR,
            ]
        );

        // Account Masyarakat
        User::firstOrCreate(
            ['email' => 'budi@gmail.com'],
            [
                'nik' => '3171012345670001',
                'name' => 'Budi Santoso',
                'no_hp' => '081234567892',
                'password' => Hash::make('password123'),
                'role' => UserRole::MASYARAKAT,
            ]
        );

        // Jenis Layanan Publik
        JenisLayanan::firstOrCreate(
            ['nama_layanan' => 'Izin Usaha Mikro & Kecil'],
            [
                'deskripsi' => 'Pengurusan legalitas UMK skala daerah.',
                'persyaratan' => 'KTP, NPWP'
            ]
        );

        JenisLayanan::firstOrCreate(
            ['nama_layanan' => 'Surat Keterangan Bebas Retribusi'],
            [
                'deskripsi' => 'Permohonan pembebasan retribusi daerah.',
                'persyaratan' => 'KTP, Surat Pengantar RT/RW'
            ]
        );
    }
}
