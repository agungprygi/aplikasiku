@extends('layouts.main')
@section('content')
@php
    use Carbon\Carbon;
    $nama_bulan = Carbon::createFromDate($tahun, $bulan, 1)->translatedFormat('F');
    $jumlah_hari = Carbon::createFromDate($tahun, $bulan, 1)->daysInMonth;
@endphp


<ul class="mt-1 ms-3">
    <li>{{ $title }}</li>
</ul>
<div class="card text-bg-light shadow-lg">
    <h5 class="card-header">Driver Chart</h5>
    <div class="card-body">
        @if (session()->has('success'))
        <div class="alert alert-success col-lg-12" role="alert">
            {{ session('success') }}
        </div>
        @endif
        <div class="d-flex flex-row gap-2 justify-content-center">
            <form method="GET" action="{{ route('driver.chart') }}">
                <input type="hidden" name="bulan" value="{{ $bulan }}">
                <input type="hidden" name="tahun" value="{{ $tahun }}">
                <button type="submit" name="action" value="mundur" style="background-color: white; border: none">
                    <img src="/img/kiri.png" alt="">
                </button>
            </form>
            <h5 class="card-title text-center">{{ $nama_bulan }} {{ $tahun }}</h5>
            <form method="GET" action="{{ route('driver.chart') }}">
                <input type="hidden" name="bulan" value="{{ $bulan }}">
                <input type="hidden" name="tahun" value="{{ $tahun }}">
                <button type="submit" name="action" value="maju" style="background-color: white; border: none">
                    <img src="/img/kanan.png" alt="">
                </button>
            </form>
        </div>

        <div>
            <table>
                <tr class="border">
                    <td>Nama</td>
                    @for ($tanggal = 1; $tanggal <= $jumlah_hari; $tanggal++)
                        <td class='border' style='width:31px; text-align: center'>{{ $tanggal }}</td>
                    @endfor
                </tr>

                @foreach ([1 => 'Irwan', 2 => 'Ikbal', 3 => 'Gilang', 4 => 'Faisal', 5 => 'Fadly', 6 => 'Marson'] as $driver_id => $driver_name)
                <tr>
                    <td class="border">{{ $driver_name }}</td>
                    @for ($i = 1; $i <= $jumlah_hari; $i++)
                        @php
                            $tanggal_sekarang = Carbon::createFromDate($tahun, $bulan, $i);
                        @endphp
                        <td class="border">
                            @foreach ($activities as $assignment)
                                @if ($assignment->driver_id === $driver_id)
                                    @php
                                        $tanggal_awal = Carbon::parse($assignment->reservation->tgl_mulai);
                                        $tanggal_akhir = Carbon::parse($assignment->reservation->tgl_akhir);
                                        $mulai_garis = $tanggal_awal->month == $bulan && $tanggal_awal->year == $tahun ? $tanggal_awal->day : 1;
                                        $akhir_garis = $tanggal_akhir->month == $bulan && $tanggal_akhir->year == $tahun ? $tanggal_akhir->day : $jumlah_hari;
                                        if ($i >= $mulai_garis && $i <= $akhir_garis) {
                                            echo '<div class="line-pot"></div>';
                                        }
                                    @endphp
                                @endif
                            @endforeach
                        </td>
                    @endfor
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
