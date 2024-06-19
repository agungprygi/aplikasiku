@extends('layouts/main')

@section('content')
{{-- Tampilan utama --}}
    <img src="/img/grafis.png" class="position-fixed" style="margin-top: 350px; margin-left: 1000px" alt="">
    <ul class="mt-1 ms-3">
        <li>{{ $title }}</li>
    </ul>
    <div class="card text-bg-light shadow-lg">
        <div class="card-header">
            <div class="navbar">
            <h5 class="navbar-brand">Jadwal Driver</h5>
            <form class="d-flex" role="search" action="reservasi">
                <input class="form-control me-2" type="search" placeholder="Search..." name="search" value="{{ request('search') }}">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            </div>
        </div>
        @if($reservations->count())
            <div class="card-body">
                @if (session()->has('success'))
                    <div class="alert alert-success col-lg-12" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">Kegiatan</th>
                        <th scope="col">Lokasi</th>
                        <th scope="col">Driver</th>
                        <th scope="col">Jenis Unit</th>
                        <th scope="col">Waktu</th>
                        <th scope="col">Mulai</th>
                        <th scope="col">Akhir</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                    <tbody>
                        @foreach ($reservations as $reservation)
                            @foreach ($activities as $activity)
                                @foreach ($units as $unit)
                                @if ($activity->reservation_id == $reservation->id && $unit->id == $reservation->unit->id)
                                    <tr>
                                        <td>{{ $reservation->pegawai     }}</td>
                                        <td>{{ $reservation->kegiatan }}</td>
                                        <td>{{ $reservation->lokasi }}</td>
                                        <td>{{ $activity->driver->nama }}</td>
                                        <td>{{ $unit->jenis }}</td>
                                        <td>{{ \Carbon\Carbon::parse($reservation->waktu)->format('h:i A') }}</td>
                                        <td>{{ $reservation->tgl_mulai }}</td>
                                        <td>{{ $reservation->tgl_akhir }}</td>
                                        <td class="text-center">
                                            <a class="badge-bs-primary-bg-subtle border-0 me-1" href="{{ route('reservasi.edit', $activity->id) }}"><i class="bi bi-pencil-square"></i></a>
                                            <form action="{{ route('reservasi.destroy', $activity->reservation_id) }}" method="post" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="badge-bs-primary-bg-subtle border-0" onclick="return confirm('Aro You Sure?')"><i class="bi bi-trash-fill"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                                @endforeach
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
                <p class="text-center fs-6 mt-3">Tidak Ada Jadwal Ditemukan</p>
            @endif
            <div class="d-flex justify-content-end me-2">
                {{ $activities->links() }}
            </div>
    </div>
@endsection