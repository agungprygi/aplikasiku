@extends('layouts/main')

@section('content')
{{-- Tampilan utama --}}
    <img src="/img/grafis.png" class="position-fixed" style="margin-top: 350px; margin-left: 1000px" alt="">
    <ul class="mt-1 ms-3">
        <li>{{ $title }}</li>
    </ul>
    <div class="card text-bg-light shadow-lg">
        <h5 class="card-header">Reservasi </h5>
            <div class="card-body">
                <form method="POST" action="{{ route('reservasi.update', $reservation->id) }}" >
                    @csrf
                    @method('put')
                    <div class="mb-1 row">
                        <label for="pegawai" class="col-sm-2 col-form-label">Nama Pegawai</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('pegawai') is-invalid @enderror" name="pegawai" id="pegawai" required value="{{ old('pegawai', $reservation->pegawai) }}">
                            @error('pegawai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label for="telepon" class="col-sm-2 col-form-label">No. Telepon Pegawai</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control @error('telepon') is-invalid @enderror" name="telepon" id="telepon" required value="{{ old('telepon', $reservation->telepon) }}">
                            @error('telepon')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label for="kegiatan" class="col-sm-2 col-form-label">Nama Kegiatan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('kegiatan') is-invalid @enderror" name="kegiatan" id="kegiatan" required value="{{ old('kegiatan', $reservation->kegiatan) }}">
                            @error('kegiatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label for="lokasi" class="col-sm-2 col-form-label">Lokasi Kegiatan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('lokasi') is-invalid @enderror" name="lokasi" id="lokasi" value="{{ old('lokasi', $reservation->lokasi) }}">
                            @error('lokasi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label for="tgl_mulai" class="col-sm-2 col-form-label">Tanggal Mulai</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control @error('tgl_mulai') is-invalid @enderror" name="tgl_mulai" id="tgl_mulai" value="{{ old('tgl_mulai', $reservation->tgl_mulai) }}">
                            @error('tgl_mulai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label for="tgl_akhir" class="col-sm-2 col-form-label">Tanggal Akhir</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control @error('tgl_akhir') is-invalid @enderror" name="tgl_akhir" id="tgl_akhir" value="{{ old('tgl_akhir', $reservation->tgl_akhir) }}">
                            @error('tgl_akhir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label for="waktu" class="col-sm-2 col-form-label">Waktu</label>
                        <div class="col-sm-9">
                            <input type="time" class="form-control @error('waktu') is-invalid @enderror" name="waktu" id="waktu" value="{{ old('waktu', $reservation->waktu) }}">
                            @error('waktu')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    @if($countAvailableDrivers > 0)
                        <div class="mb-1 row">
                            <label for="jumlah_driver" class="col-sm-2 col-form-label">Jumlah Driver</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="jumlah_driver" value="{{ old('jumlah_driver', $reservation->jumlah_driver) }}">
                                    @for ($i = 1; $i <= $countAvailableDrivers; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    @endif

                    <div class="mb-1 row">
                        <label for="unit_id" class="col-sm-2 col-form-label">Jenis Unit</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="unit_id" id="unit_id" val>
                                @foreach ($units as $unit)
                                    @if (old('unit_id') == $unit->id)
                                    <option value="{{ $unit->id }}" selected>{{ $unit->jenis }}</option>
                                    @else
                                    <option value="{{ $unit->id }}">{{ $unit->jenis}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('unit_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan" value="{{ old('keterangan', $reservation->keterangan) }}">
                            @error('keterangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label for="jenis_kegiatan" class="col-sm-2 col-form-label">Jenis Kegiatan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('jenis_kegiatan') is-invalid @enderror" name="jenis_kegiatan" id="jenis_kegiatan" value="{{ old('jenis_kegiatan', $reservation->jenis_kegiatan) }}">
                            @error('jenis_kegiatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    @foreach ($activities as $item)
                    <div class="mb-1 row">
                        <label for="driver_id" class="col-sm-2 col-form-label">Driver</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('driver_id') is-invalid @enderror" name="driver_id" id="driver_id" value="{{ old('driver_id', $item->driver->nama) }}">
                            @error('driver_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    @endforeach
                    
                    <button class="btn btn-primary mt-3 col-md-1" style="margin-left: 190px" type="submit">Ubah</button>
                    </form>
            </div>
    </div>
@endsection
