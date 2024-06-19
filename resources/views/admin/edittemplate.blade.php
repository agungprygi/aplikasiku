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
            <form action="/edittemplate/store" method="post" id="mainForm">
                @csrf
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
                <div class="mb-1 row">
                    <label for="reservation_id" class="col-sm-2 col-form-label">ID Reservasi</label>
                    <div class="col-sm-9">
                        <select class="form-select" size="2" multiple name="reservation_id[]" id="reservation_id">
                            @foreach ($activities as $activity)
                            @if (old('activity_id') == $activity->activity)
                            <option value="{{ $activity->reservation_id }}">{{ $activity->reservation_id }}</option>
                            @else
                            <option value="{{ $activity->reservation_id }}">{{ $activity->reservation_id}}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('activity_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="tambah-reservasi" id="tambah-reservasi">
                    <img src="/img/Tambah.png" alt="">
                    <p>Tambah Reservasi</p>
                </div>
                <div class="mb-1 row">
                    <label for="pengirim" class="col-sm-2 col-form-label">Nama Pengirim</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="pengirim" id="pengirim" required value="{{ old('pengirim') }}">
                        @error('pengirim')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="mb-1 row">
                    <label for="email_pengirim" class="col-sm-2 col-form-label">Email Pengirim</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" name="email_pengirim" id="email_pengirim" required value="{{ old('email_pengirim') }}">
                        @error('email_pengirim')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="button-template">
                    <button class="btn btn-primary" type="submit">Lihat Dan Unduh LDP</button>
                    <a href="{{ route('uploadldp', ) }}" class="btn btn-success">Kirim LDP</a>
                </div>
            </form>
            </div>
    </div>

    <script>
        document.getElementById('tambah-reservasi').addEventListener('click', function() {
            // Dapatkan kontainer form
            var formContainer = document.querySelector('.card-body form');

            // Buat elemen baru untuk div input
            var inputContainer = document.createElement('div');
            inputContainer.classList.add('mb-1', 'row');

            // Buat elemen untuk label
            var label = document.createElement('label');
            label.classList.add('col-sm-2', 'col-form-label');

            // Buat elemen baru untuk div inputan
            var inputan = document.createElement('div');
            inputan.classList.add('col-sm-9');

            // Buat elemen baru untuk select dengan multiple selection
            var selectReservasi = document.createElement('select');
            selectReservasi.setAttribute('size', '2');
            selectReservasi.setAttribute('multiple', 'multiple'); // Set multiple selection
            selectReservasi.classList.add('form-select');
            selectReservasi.name = 'reservation_id[]'; // Set name as array to handle multiple values

            // Iterasi untuk menambahkan option-option ke dalam select
            @foreach ($activities as $unit)
                var option = document.createElement('option');
                option.value = '{{ $unit->reservation_id }}';
                option.text = '{{ $unit->reservation_id }}';
                selectReservasi.appendChild(option);
            @endforeach

            // Tambahkan label dan select ke dalam div inputan
            inputan.appendChild(selectReservasi);

            // Tambahkan label dan div inputan ke dalam div inputContainer
            inputContainer.appendChild(label);
            inputContainer.appendChild(inputan);

            // Tambahkan div input ke dalam form
            formContainer.insertBefore(inputContainer, formContainer.children[4]);
        });

        // Mengirim formulir saat tombol submit ditekan
        document.getElementById('mainForm').addEventListener('submit', function(event) {
            // Dapatkan semua elemen select dengan name reservation_id[] dan setiap pilihan yang dipilih
            var selects = document.querySelectorAll('select[name="reservation_id[]"]');
            selects.forEach(function(select) {
                var selectedOptions = Array.from(select.selectedOptions).map(function(option) {
                    return option.value;
                });

                // Hapus opsi yang dipilih dari inputan select agar tidak di-submit berkali-kali
                selectedOptions.forEach(function(option) {
                    var index = select.selectedIndex;
                    if (index > -1) {
                        select.remove(index);
                    }
                });

                // Buat input hidden untuk setiap nilai yang dipilih dan tambahkan ke dalam formulir
                selectedOptions.forEach(function(option) {
                    var hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'reservation_id[]';
                    hiddenInput.value = option;
                    event.target.appendChild(hiddenInput);
                });
            });
        });
    </script>


@endsection
