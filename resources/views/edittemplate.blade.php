@extends('layouts.main')

@section('content')
<img src="/img/grafis.png" class="position-fixed" style="margin-top: 350px; margin-left: 1000px" alt="">
<ul class="mt-1 ms-3">
    <li>{{ $title }}</li>
</ul>
<div class="card col-lg text-bg-light shadow-lg">
    <h5 class="card-header">Template Surat</h5>
    <div class="card-body">
        <h6 class="card-title">Keperluan Surat</h6>
        <form action="/edittemplate/store" method="post" id="mainForm" target="_blank">
            @csrf

            <!-- Input Tanggal Pengajuan -->
            <div class="mb-1 row">
                <label for="tgl_pengajuan" class="col-sm-2 col-form-label">Tanggal Pengajuan</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control" name="tgl_pengajuan" id="tgl_pengajuan" autofocus required value="{{ old('tgl_pengajuan') }}">
                    @error('tgl_pengajuan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <!-- Input Asal -->
            <div class="mb-1 row">
                <label for="asal" class="col-sm-2 col-form-label">Pengajuan Dari</label>
                <div class="col-sm-9">
                    <select class="form-control" name="asal" id="asal">
                        <option value="Fungsi Perumusan KEKDA Provinsi">Fungsi Perumusan KEKDA Provinsi</option>
                        <option value="Fungsi Data dan Statistik Ekonomi dan Keuangan">Fungsi Data dan Statistik Ekonomi dan Keuangan</option>
                        <option value="Fungsi Pelaksanaan Pengembangan UMKM, KI Dan Syariah">Fungsi Pelaksanaan Pengembangan UMKM, KI Dan Syariah</option>
                        <option value="Fungsi Implementasi Kebijakan SP">Fungsi Implementasi Kebijakan SP</option>
                        <option value="Fungsi Implementasi Pengawasan SP-PUR">Fungsi Implementasi Pengawasan SP-PUR</option>
                        <option value="Fungsi Logistik, SDM, Sekretariat,Pengamanan dan Protokol">Fungsi Logistik, SDM, Sekretariat,Pengamanan dan Protokol</option>
                        <option value="Unit Manajemen Intern">Unit Manajemen Intern</option>
                        <option value="Unit Implementasi PUR">Unit Implementasi PUR</option>
                        <option value="Unit Implementasi SP-PUR">Unit Implementasi SP-PUR</option>
                        <option value="Tim Implementasi SP, PUR dan MI">Tim Implementasi SP, PUR dan MI</option>
                        <option value="Tim Perumusan dan Implementasi KEKDA">Tim Perumusan dan Implementasi KEKDA</option>
                        <option value="Seksi Kehumasan">Seksi Kehumasan</option>
                        <option value="Seksi Layanan dan Pengelolaan Uang">Seksi Layanan dan Pengelolaan Uang</option>
                        <option value="Seksi Keuangan">Seksi Keuangan</option>
                    </select>
                    @error('asal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <!-- Input Tanggal Awal Kegiatan -->
            <div class="mb-1 row">
                <label for="tgl_kegiatanAwal" class="col-sm-2 col-form-label">Tanggal Awal Kegiatan</label>
                <div class="col-sm-9">
                    <select class="form-control" name="tgl_kegiatanAwal" id="tgl_kegiatanAwal">
                        @foreach ($activities->unique('reservation.tgl_mulai') as $activity)
                            <option value="{{ $activity->reservation->tgl_mulai }}" {{ old('tgl_kegiatanAwal') == $activity->reservation->tgl_mulai ? 'selected' : '' }}>
                                {{ $activity->reservation->tgl_mulai }}
                            </option>
                        @endforeach
                    </select>
                    @error('tgl_kegiatanAwal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <!-- Input Tanggal Akhir Kegiatan -->
            <div class="mb-1 row">
                <label for="tgl_kegiatanAkhir" class="col-sm-2 col-form-label">Tanggal Akhir Kegiatan</label>
                <div class="col-sm-9">
                    <select class="form-control" name="tgl_kegiatanAkhir" id="tgl_kegiatanAkhir">
                        @foreach ($activities->unique('reservation.tgl_akhir') as $activity)
                            <option value="{{ $activity->reservation->tgl_akhir }}" {{ old('tgl_kegiatanAkhir') == $activity->reservation->tgl_akhir ? 'selected' : '' }}>
                                {{ $activity->reservation->tgl_akhir }}
                            </option>
                        @endforeach
                    </select>
                    @error('tgl_kegiatanAkhir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <!-- Input ID Reservasi -->
            <div class="mb-1 row">
                <label for="reservation_id" class="col-sm-2 col-form-label">ID Reservasi</label>
                <div class="col-sm-9">
                    <select class="form-select" size="2" multiple name="reservation_id[]" id="reservation_id">
                        @foreach ($activities->unique('reservation_id') as $activity)
                            <option value="{{ $activity->reservation_id }}">{{ $activity->reservation_id }}</option>
                        @endforeach
                    </select>
                    @error('reservation_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <!-- Tombol Tambah Reservasi -->
            <div class="tambah-reservasi" id="tambah-reservasi" style="cursor: pointer;">
                <img src="/img/Tambah.png" alt="">
                <p>Tambah Reservasi</p>
            </div>

            <!-- Data Pegawai 1 -->
            <h6 class="card-title">Menyetujui</h6>
            <div class="mb-1 row">
                <label for="jabatan1" class="col-sm-2 col-form-label">Jabatan Pegawai</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="jabatan1" id="jabatan1" required value="{{ old('jabatan1') }}">
                    @error('jabatan1')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="mb-1 row">
                <label for="nama_pegawai1" class="col-sm-2 col-form-label">Nama Pegawai</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="nama_pegawai1" id="nama_pegawai1" required value="{{ old('nama_pegawai1') }}">
                    @error('nama_pegawai1')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="mb-1 row">
                <label for="pangkat1" class="col-sm-2 col-form-label">Pangkat Pegawai</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="pangkat1" id="pangkat1" required value="{{ old('pangkat1') }}">
                    @error('pangkat1')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <!-- Data Pegawai 2 -->
            <div class="mb-1 row">
                <label for="jabatan2" class="col-sm-2 col-form-label">Jabatan Pegawai</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="jabatan2" id="jabatan2" required value="{{ old('jabatan2') }}">
                    @error('jabatan2')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="mb-1 row">
                <label for="nama_pegawai2" class="col-sm-2 col-form-label">Nama Pegawai</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="nama_pegawai2" id="nama_pegawai2" required value="{{ old('nama_pegawai2') }}">
                    @error('nama_pegawai2')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="mb-1 row">
                <label for="pangkat2" class="col-sm-2 col-form-label">Pangkat Pegawai</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="pangkat2" id="pangkat2" required value="{{ old('pangkat2') }}">
                    @error('pangkat2')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="button-template">
                <button class="btn btn-primary"  type="submit">Lihat Dan Unduh LDP</button>
                <a href="{{ route('upload') }}" class="btn btn-success">Kirim LDP</a>
            </div>
        </form>
    </div>
</div>

<!-- Script untuk mengelola dinamis input -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM fully loaded and parsed');
        
        var activities = @json($activities->unique('reservation_id'));
        var activitiesArray = Object.values(activities);

        // Log to check data type
        console.log('Activities Array:', activitiesArray);

        // Event listener untuk tombol "Tambah Reservasi"
        document.getElementById('tambah-reservasi').addEventListener('click', function() {
            console.log('Tambah Reservasi clicked');
            
            // Container form tempat input baru akan ditambahkan
            var formContainer = document.querySelector('.card-body form');
            var inputContainer = document.createElement('div');
            inputContainer.classList.add('mb-1', 'row');
            var label = document.createElement('label');
            label.classList.add('col-sm-2', 'col-form-label');
            label.innerText = 'ID Reservasi'; // Tambahkan label untuk select baru
            var inputan = document.createElement('div');
            inputan.classList.add('col-sm-9');
            var selectReservasi = document.createElement('select');
            selectReservasi.classList.add('form-select');
            selectReservasi.setAttribute('size', '2');
            selectReservasi.setAttribute('multiple', 'multiple');
            selectReservasi.name = 'reservation_id[]';

            // Mengambil ID reservasi yang sudah dipilih
            var selectedOptions = Array.from(document.querySelectorAll('select[name="reservation_id[]"]'))
                .flatMap(select => Array.from(select.selectedOptions).map(option => option.value));

            console.log('Selected Options:', selectedOptions);

            // Menambahkan opsi yang belum dipilih sebelumnya
            if (Array.isArray(activitiesArray)) {
                activitiesArray.forEach(function(activity) {
                    if (!selectedOptions.includes(activity.reservation_id)) {
                        var option = document.createElement('option');
                        option.value = activity.reservation_id;
                        option.text = activity.reservation_id;
                        selectReservasi.appendChild(option);
                    }
                });
            } else {
                console.error('Activities is not an array:', activitiesArray);
            }

            // Menambahkan select ke dalam input container
            inputan.appendChild(selectReservasi);
            inputContainer.appendChild(label);
            inputContainer.appendChild(inputan);
            formContainer.insertBefore(inputContainer, document.querySelector('.tambah-reservasi'));

            // Panggil fungsi untuk menghapus opsi yang sudah dipilih
            removeSelectedOptions();
        });

        // Event listener untuk submit form
        document.getElementById('mainForm').addEventListener('submit', function(event) {
            var selects = document.querySelectorAll('select[name="reservation_id[]"]');
            selects.forEach(function(select) {
                var selectedOptions = Array.from(select.selectedOptions).map(function(option) {
                    return option.value;
                });

                // Buat input hidden untuk setiap opsi yang dipilih
                selectedOptions.forEach(function(option) {
                    var hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'reservation_id[]';
                    hiddenInput.value = option;
                    event.target.appendChild(hiddenInput);
                });

                // Hapus opsi yang sudah dipilih dari select
                selectedOptions.forEach(function(option) {
                    var index = Array.from(select.options).findIndex(opt => opt.value == option);
                    if (index > -1) {
                        select.remove(index);
                    }
                });
            });
        });

        // Fungsi untuk menghapus opsi yang sudah dipilih
        function removeSelectedOptions() {
            var selectedOptions = new Set();
            document.querySelectorAll('select[name="reservation_id[]"]').forEach(function(select) {
                Array.from(select.selectedOptions).forEach(function(option) {
                    selectedOptions.add(option.value);
                });
            });

            document.querySelectorAll('select[name="reservation_id[]"]').forEach(function(select) {
                Array.from(select.options).forEach(function(option) {
                    if (selectedOptions.has(option.value) && !option.selected) {
                        option.remove();
                    }
                });
            });
        }

        // Event listener untuk setiap perubahan di select
        document.addEventListener('change', function(e) {
            if (e.target.matches('select[name="reservation_id[]"]')) {
                removeSelectedOptions();
            }
        });

        // Panggil fungsi untuk menghapus opsi yang sudah dipilih pada awal pemuatan halaman
        removeSelectedOptions();
    });
</script>
@endsection
