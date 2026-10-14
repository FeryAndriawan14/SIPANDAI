@extends('layouts.masyarakat')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Banner / Ilustrasi Portal Layanan (Teks & Fitur Rata Tengah) -->
        <div class="mb-6 bg-gradient-to-r from-sky-600 via-blue-700 to-indigo-800 rounded-2xl shadow-xl overflow-hidden p-6 sm:p-8 text-white flex flex-col items-center justify-center gap-6 relative text-center">
            <!-- Efek Cahaya Latar Belakang -->
            <div class="absolute -top-24 -right-24 w-72 h-72 bg-sky-400/20 rounded-full blur-3xl pointer-events-none"></div>

            <div class="space-y-3 z-10 max-w-2xl flex flex-col items-center">
                <span class="bg-white/20 backdrop-blur-md text-sky-100 text-xs font-semibold px-3 py-1 rounded-full uppercase tracking-wider border border-white/10">Portal Layanan Resmi</span>

                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">SIPANDAI - Pelayanan Kependudukan</h1>

                <p class="text-sky-100 text-sm leading-relaxed">
                    Ajukan permohonan dokumen kependudukan seperti e-KTP, Kartu Keluarga, dan Surat Domisili dengan mudah, cepat, dan transparan langsung dari perangkat Anda.
                </p>

                <div class="flex flex-wrap gap-2 justify-center pt-2">
                    <span class="text-xs bg-sky-900/60 text-sky-200 px-2.5 py-1 rounded-lg border border-sky-400/20 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-sky-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg> Proses Cepat
                    </span>
                    <span class="text-xs bg-sky-900/60 text-sky-200 px-2.5 py-1 rounded-lg border border-sky-400/20 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-sky-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg> Transparan & Akuntabel
                    </span>
                </div>
            </div>
        </div>

        <!-- Form Utama Permohonan -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-6 sm:p-8 border border-slate-100">
            <h2 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sky-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Formulir Permohonan Layanan Baru
            </h2>

            @if ($errors->any())
            <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-xl text-sm">
                <p class="font-bold mb-1">Terjadi Kesalahan Pengisian:</p>
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('masyarakat.permohonan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Input NIK dengan validasi real-time JavaScript -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 mb-1">NIK Pemohon</label>
                    <input type="text" id="nik_input" name="nik_pemohon" class="w-full border-slate-300 rounded-xl shadow-sm focus:border-sky-500 focus:ring-sky-500 p-2.5 border" placeholder="Masukkan 16 digit NIK" required minlength="16" maxlength="16" value="{{ old('nik_pemohon') }}">
                    <!-- Span untuk pesan peringatan real-time -->
                    <span id="nik_error" class="text-xs text-rose-500 mt-1 hidden">NIK harus tepat 16 digit. (Saat ini: <span id="nik_counter">0</span> digit)</span>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap Anda</label>
                    <input type="text" name="nama_pemohon" class="w-full border-slate-300 rounded-xl shadow-sm focus:border-sky-500 focus:ring-sky-500 p-2.5 border" placeholder="Sesuai KTP" required value="{{ old('nama_pemohon') }}">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Pilih Jenis Layanan</label>
                    <select name="jenis_layanan_id" id="jenis_layanan" onchange="toggleFormFields()" class="w-full border-slate-300 rounded-xl shadow-sm focus:border-sky-500 focus:ring-sky-500 p-2.5 border" required>
                        <option value="">-- Pilih Layanan --</option>
                        @foreach ($jenisLayanans as $layanan)
                        <option value="{{ $layanan->id }}" data-nama="{{ strtolower($layanan->nama_layanan) }}" {{ old('jenis_layanan_id') == $layanan->id ? 'selected' : '' }}>
                            {{ $layanan->nama_layanan }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Detail / Keterangan Permohonan</label>
                    <textarea name="detail_permohonan" class="w-full border-slate-300 rounded-xl shadow-sm focus:border-sky-500 focus:ring-sky-500 p-2.5 border" rows="3" placeholder="Tuliskan catatan tambahan jika ada..." required>{{ old('detail_permohonan') }}</textarea>
                </div>

                <!-- Bagian 1: Khusus Pembuatan KTP -->
                <div id="section-ktp" class="space-y-4 mb-6 p-4 bg-slate-50 border border-slate-200 rounded-xl hidden">
                    <p class="font-bold text-slate-800 text-sm flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-sky-600"></span> Persyaratan Pembuatan KTP:
                    </p>
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">1. Upload Kartu Keluarga (KK)</label>
                        <input type="file" name="ktp_berkas_kk" class="w-full border border-slate-300 rounded-xl p-2 bg-white text-sm" accept=".pdf,.jpg,.jpeg,.png">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">2. Upload Surat Pengantar RT/RW</label>
                        <input type="file" name="ktp_berkas_pengantar" class="w-full border border-slate-300 rounded-xl p-2 bg-white text-sm" accept=".pdf,.jpg,.jpeg,.png">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">3. Upload Akta Kelahiran / Ijazah Terakhir (Pendukung)</label>
                        <input type="file" name="berkas_pendukung" class="w-full border border-slate-300 rounded-xl p-2 bg-white text-sm" accept=".pdf,.jpg,.jpeg,.png">
                    </div>
                </div>

                <!-- Bagian 2: Khusus Pembuatan Kartu Keluarga (KK) -->
                <div id="section-kk" class="space-y-4 mb-6 p-4 bg-slate-50 border border-slate-200 rounded-xl hidden">
                    <p class="font-bold text-slate-800 text-sm flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-sky-600"></span> Persyaratan Pembuatan Kartu Keluarga (KK):
                    </p>
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">1. Upload Surat Pengantar RT/RW</label>
                        <input type="file" name="kk_berkas_pengantar" class="w-full border border-slate-300 rounded-xl p-2 bg-white text-sm" accept=".pdf,.jpg,.jpeg,.png">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">2. Upload Buku Nikah / Akta Perkawinan</label>
                        <input type="file" name="berkas_nikah" class="w-full border border-slate-300 rounded-xl p-2 bg-white text-sm" accept=".pdf,.jpg,.jpeg,.png">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">3. Upload Kartu Keluarga (KK) Lama</label>
                        <input type="file" name="kk_berkas_kk" class="w-full border border-slate-300 rounded-xl p-2 bg-white text-sm" accept=".pdf,.jpg,.jpeg,.png">
                    </div>
                </div>

                <!-- Bagian 3: Khusus Surat Keterangan Domisili -->
                <div id="section-domisili" class="space-y-4 mb-6 p-4 bg-slate-50 border border-slate-200 rounded-xl hidden">
                    <p class="font-bold text-slate-800 text-sm flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-sky-600"></span> Persyaratan Surat Keterangan Domisili:
                    </p>
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">1. Upload Foto KTP Pemohon</label>
                        <input type="file" name="domisili_berkas_ktp" class="w-full border border-slate-300 rounded-xl p-2 bg-white text-sm" accept=".pdf,.jpg,.jpeg,.png">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">2. Upload Surat Pengantar RT/RW Setempat</label>
                        <input type="file" name="domisili_berkas_pengantar" class="w-full border border-slate-300 rounded-xl p-2 bg-white text-sm" accept=".pdf,.jpg,.jpeg,.png">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">3. Upload Surat Pernyataan Tempat Tinggal / Pemilik Rumah</label>
                        <input type="file" name="berkas_pernyataan" class="w-full border border-slate-300 rounded-xl p-2 bg-white text-sm" accept=".pdf,.jpg,.jpeg,.png">
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                    <a href="{{ route('masyarakat.dashboard') }}" class="px-5 py-2.5 bg-slate-200 text-slate-700 rounded-xl font-semibold text-sm hover:bg-slate-300 transition">Batal</a>
                    <button type="submit" class="px-6 py-2.5 bg-sky-600 hover:bg-sky-700 text-white rounded-xl font-semibold text-sm shadow-lg shadow-sky-600/30 transition">Ajukan Permohonan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk toggle form berkas berdasarkan jenis layanan
    function toggleFormFields() {
        const select = document.getElementById('jenis_layanan');
        const selectedOption = select.options[select.selectedIndex];
        const namaLayanan = selectedOption ? selectedOption.getAttribute('data-nama') || '' : '';

        const sectionKtp = document.getElementById('section-ktp');
        const sectionKk = document.getElementById('section-kk');
        const sectionDomisili = document.getElementById('section-domisili');

        sectionKtp.classList.add('hidden');
        sectionKk.classList.add('hidden');
        sectionDomisili.classList.add('hidden');

        sectionKtp.querySelectorAll('input').forEach(input => input.required = false);
        sectionKk.querySelectorAll('input').forEach(input => input.required = false);
        sectionDomisili.querySelectorAll('input').forEach(input => input.required = false);

        if (namaLayanan.includes('ktp') || namaLayanan.includes('identitas')) {
            sectionKtp.classList.remove('hidden');
            sectionKtp.querySelectorAll('input').forEach(input => input.required = true);
        } else if (namaLayanan.includes('kartu keluarga') || namaLayanan.includes('kk')) {
            sectionKk.classList.remove('hidden');
            sectionKk.querySelectorAll('input').forEach(input => input.required = true);
        } else if (namaLayanan.includes('domisili')) {
            sectionDomisili.classList.remove('hidden');
            sectionDomisili.querySelectorAll('input').forEach(input => input.required = true);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Jalankan toggle saat halaman pertama kali dimuat
        toggleFormFields();

        // Validasi real-time NIK (Hanya Angka & Wajib 16 Digit)
        const nikInput = document.getElementById('nik_input');
        const nikError = document.getElementById('nik_error');
        const nikCounter = document.getElementById('nik_counter');

        if (nikInput) {
            nikInput.addEventListener('input', function() {
                // Hanya izinkan angka
                this.value = this.value.replace(/[^0-9]/g, '');

                const panjang = this.value.length;
                nikCounter.textContent = panjang;

                if (panjang > 0 && panjang < 16) {
                    nikError.classList.remove('hidden');
                    nikInput.classList.add('border-rose-500', 'focus:border-rose-500', 'focus:ring-rose-500');
                    nikInput.classList.remove('border-slate-300', 'focus:border-sky-500', 'focus:ring-sky-500');
                } else {
                    nikError.classList.add('hidden');
                    nikInput.classList.remove('border-rose-500', 'focus:border-rose-500', 'focus:ring-rose-500');
                    nikInput.classList.add('border-slate-300', 'focus:border-sky-500', 'focus:ring-sky-500');
                }
            });
        }
    });
</script>

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#0284c7',
            confirmButtonText: 'OK'
        });
    });
</script>
@endif
@endsection