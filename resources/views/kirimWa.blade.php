<?php
$error_messages = [];
foreach ($reports as $report) {
    $curl = curl_init();
    $tanggal_mulai = $report->activity->reservation->tgl_mulai;
    $tanggal_akhir = $report->activity->reservation->tgl_akhir;
    $lokasi = $report->activity->reservation->lokasi;
    $pic = $report->activity->reservation->pegawai;
    $target = $report->activity->driver->telepon;

    $message = sprintf(
        "Selamat pagi, Pak.\n\n" .
        "Berikut adalah penjadwalan kegiatan yang akan dilaksanakan:\n" .
        "- Tanggal: %s s/d %s\n" .
        "- Lokasi: %s\n" .
        "- PIC: %s\n\n" .
        "Info lebih lanjut dapat dilihat pada link website berikut:\n" .
        "https://example.com",
        $tanggal_mulai,
        $tanggal_akhir,
        $lokasi,
        $pic
    );

    $postData = [
        'countryCode' => '62',
        'message' => $message,
        'target' => $target,
    ];

    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://api.fonnte.com/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => http_build_query($postData),
        CURLOPT_HTTPHEADER => [
            'Authorization: EUvLDbdb8HBB5eb4nYMi',
            'Content-Type: application/x-www-form-urlencoded'
        ],
    ]);

    $response = curl_exec($curl);
    $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if ($http_code != 200) {
        $error_messages[] = "Failed to send message to $target. HTTP code: $http_code. Response: $response";
    }

    curl_close($curl);
}

if (!empty($error_messages)) {
    $error_message = 'There was an error sending messages: ' . implode(', ', $error_messages);
    header('Location: ' . $_SERVER['HTTP_REFERER'] . '?error=' . urlencode($error_message));
    exit;
}

$success_message = 'Messages have been sent successfully.';
header('Location: ' . route('kirim') . '?success=' . urlencode($success_message));
exit;