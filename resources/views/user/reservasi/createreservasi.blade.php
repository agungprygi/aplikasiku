@extends('layouts/main')

@section('content')
{{-- Tampilan utama --}}
    <img src="/img/grafis.png" class="position-fixed" style="margin-top: 350px; margin-left: 1000px" alt="">
    <ul class="mt-1 ms-3">
        <li>{{ $title }}</li>
    </ul>
    <div class="card text-bg-light shadow-lg">
        <h5 class="card-header">Reservasi</h5>
            <div class="card-body">
                <form method="POST" action="/reservasi" >
                    @csrf
                    <input type="hidden" name="driver_id" value="{{ $defaultDriverId }}">
                    <div class="mb-1 row">
                        <label for="pegawai" class="col-sm-2 col-form-label">Nama Pegawai</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="pegawai" id="pegawai" autofocus required value="{{ old('pegawai') }}">
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
                            <input type="text" class="form-control" name="telepon" id="telepon" required value="{{ old('telepon') }}">
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
                            <input type="text" class="form-control" name="kegiatan" id="kegiatan" required value="{{ old('kegiatan') }}">
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
                            <input type="text" class="form-control" name="lokasi" id="lokasi" value="{{ old('lokasi') }}">
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
                            <input type="date" class="form-control" name="tgl_mulai" id="tgl_mulai" value="{{ old('tgl_mulai') }}">
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
                            <input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir" value="{{ old('tgl_akhir') }}">
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
                            <input type="time" class="form-control" name="waktu" id="waktu" value="{{ old('waktu') }}">
                            @error('waktu')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <!-- Input jumlah driver hanya ditampilkan jika ada driver yang tersedia -->
                    @if($countAvailableDrivers > 0)
                        <div class="mb-1 row">
                            <label for="jumlah_driver" class="col-sm-2 col-form-label">Jumlah Driver</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="jumlah_driver">
                                    @for ($i = 1; $i <= $countAvailableDrivers; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    @endif
                    <!-- End of Input jumlah driver -->
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
                            <input type="text" class="form-control" name="keterangan" id="keterangan" value="{{ old('keterangan') }}">
                            @error('keterangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label for="jenis_activity_id" class="col-sm-2 col-form-label">Jenis Kegiatan</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="jenis_activity_id" id="jenis_activity_id" val>
                                @foreach ($kegiatan as $jenis)
                                    @if (old('jenis_activity_id') == $jenis->id)
                                    <option value="{{ $jenis->id }}" selected>{{ $jenis->jenis_kegiatan }}</option>
                                    @else
                                    <option value="{{ $jenis->id }}">{{ $jenis->jenis_kegiatan}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('jenis_activity_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    
    
                    <button class="btn btn-primary mt-3 col-md-1" style="margin-left: 190px" type="submit">Ajukan</button>
                    </form>
            </div>
    </div>
@endsection
