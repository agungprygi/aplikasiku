@extends('layouts.main')

@section('content')
    <img src="/img/grafis.png" class="position-fixed" style="margin-top: 350px; margin-left: 1000px" alt="">
    <ul class="mt-1 ms-3">
        <li>{{ $title }}</li>
    </ul>
    <div class="card col-lg text-bg-light shadow-lg">
        <h5 class="card-header">Template Surat</h5>
            <div class="card-body">
            <h6 class="card-title">Keperluan Surat LDP ke MI</h6>
            <form action="/edittemplate/store" method="post" id="mainForm">
                @csrf
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
                <div class="mb-1 row">
                    <label for="dokumen" class="col-sm-2 col-form-label">Upload Dokumen</label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" name="dokumen" id="dokumen" required value="{{ old('dokumen') }}">
                        @error('dokumen')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="button-template">
                    <button class="btn btn-success" type="submit">Kirim Ke MI</button>
                    <button class="btn btn-primary">Kirim Ke Driver</button>
                </div>
            </form>
            </div>
    </div>

@endsection
