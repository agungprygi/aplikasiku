<?php
use Carbon\Carbon;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
        {{-- style CSS --}}
        <link rel="stylesheet" href="/style/style.css">

        {{-- Bootstrap link --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    
        {{-- Bootstrap Icon --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>{{ $title }}</title>
</head>
<body>
    <div class="form-group">
        <img src="img/logoldp.png" style="width: 200px" alt="Logo LDP">
        <p class="text-center" style="font-size: 14px"><u><strong>LEMBAR DISPOSISI PEJABAT</strong></u></p>
        <table class="border col-12" style="border: 1px solid; margin-bottom:30px">
            <tr>
                <td scope="col" class="col-lg-4 p-2">Perihal :</td>
                <td scope="col" class="col-lg-4 p-2">Tanggal :</td>
            </tr>
            <tr>
                <td scope="col" class="col-lg-4 p-2"><strong>Permohonan Penggunaan Kendaraan Dinas</strong></td>
                <td scope="col" class="col-lg-4 p-2"><strong>
                    {{ $tanggal }}</strong></td>
            </tr>
        </table>
        <p>Kepada   : Kepala Unit Manajemen Intern</p>
        <p>Dari     : {{ $asal }}</p>
        <p style="text-align: justify; text-indent: 0.5in;">Dalam rangka pelaksanaan kegiatan {{ $asal }} pada tanggal {{ \Carbon\Carbon::parse($tgl_kegiatanAwal)->format('d') }} s/d {{ \Carbon\Carbon::parse($tgl_kegiatanAkhir)->translatedFormat('d F Y') }}. Dengan ini kami mohon bantuan Saudara agar dapat menugaskan driver beserta unit kendaraan dengan rincian sebagai berikut.</p>
        <table class="border col-12">
            <thead class="border text-center grid gap-4" style="border: 1px solid; background-color:rgb(189, 189, 189)">
                <tr>
                    <th scope="col" style="width: 105px"><small>Tanggal Penugasan</small></th>
                    <th scope="col" style="width: 100px"><small>Pukul</small></th>
                    <th scope="col" style="width: 100px"><small>Jumlah Kebutuhan Driver</small></th>
                    <th scope="col" style="width: 90px"><small>Jenis Unit</small></th>
                    <th scope="col" style="width: 120px"><small>Kegiatan</small></th>
                    <th scope="col" style="width: 160px"><small>Keterangan</small></th>
                </tr>
            </thead>
            <tbody class="border text-center grid gap-4" style="border: 1px solid">
                @foreach ($report->unique('reservation_id') as $item)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($item->activity->reservation->tgl_mulai)->format('d') }}/{{ \Carbon\Carbon::parse($item->activity->reservation->tgl_akhir)->translatedFormat('d F Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->activity->reservation->waktu)->format('h:i A') }}</td>
                    <td>{{ $item->activity->reservation->jumlah_driver }}</td>
                    <td>{{ $item->activity->reservation->unit->jenis }}</td>
                    <td>{{ $item->activity->reservation->kegiatan }}</td>
                    <td>{{ $item->activity->reservation->keterangan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <p style="margin-top: 20px; margin-bottom:50px; text-align: justify; text-indent: 0.5in;">
            Demikian kami sampaikan, atas bantuan dan kerjasama Saudara kami ucapkan terima kasih.
        </p>
        <table>
                <tr>
                    <td scope="col" class="text-center" style="width: 300px;">Menyetujui</td>
                </tr>
                <tr>
                    <td scope="col" class="text-center"  style="width: 300px; text-center">{{ $jabatan1 }}</td>
                    <td scope="col" class="text-center"  style="width: 500px">{{ $jabatan2 }},</td>
                </tr>
                <tr>
                    <td scope="col" class="text-center"  style="height: 100px"></td>
                    <td scope="col" class="text-center"  style="height: 100px"></td>
                </tr>
                <tr>
                    <td scope="col" class="text-center"  style="width: 300px"><u>{{ $nama_pegawai1 }}</u></td>
                    <td scope="col" class="text-center"  style="width: 500px"><u>{{ $nama_pegawai2 }}</u></td>
                </tr>
                <tr>
                    <td scope="col" class="text-center"  style="width: 300px">{{ $pangkat1 }}</td>
                    <td scope="col" class="text-center"  style="width: 500px">{{ $pangkat2 }}</td>
                </tr>
        </table>
    </div>
</body>
</html>