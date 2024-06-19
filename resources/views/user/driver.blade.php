@extends('layouts/main')

@section('content')

<img src="/img/grafis.png" class="position-fixed" style="margin-top: 350px; margin-left: 1000px" alt="">
<ul class="mt-1 ms-3">
    <li>{{ $title }}</li>
</ul>
<div class="card text-bg-light shadow-lg">
    <div class="card-header">
        <div class="navbar">
            <h5 class="navbar-brand">Daftar Driver KPw BI Maluku Utara</h5>
        </div>
    </div>
    @foreach ($sopir as $aktifitas)
    <div class="card-body">
        <div class="card-profile d-flex flex-row">
            <div class="foto-driver me-4">
                <img src="#" alt="Foto Driver">
            </div>
            <div class="profile-driver">
                <table>
                    <tr>
                        <td class="baris">Nama Lengkap</td>
                        <td class="baris">:</td>
                        <td>{{ $aktifitas->nama }}</td>
                    </tr>
                    <tr>
                        <td class="baris">Alamat</td>
                        <td class="baris">:</td>
                        <td>{{ $aktifitas->alamat }}</td>
                    </tr>
                    <tr>
                        <td class="baris">Telepon</td>
                        <td class="baris">:</td>
                        <td>{{ $aktifitas->telepon }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection