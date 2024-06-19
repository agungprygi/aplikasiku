<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Driver;
use App\Models\Activity;
use App\Models\Reservation;

use Illuminate\Http\Request;
use App\Models\DriverActivity;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DriverController extends Controller
{
    
public function index()
{
    $today = Carbon::today()->format('Y-m-d');

    // Mengambil semua aktivitas beserta reservasi dan driver terkait
    $activities = Activity::with('reservation', 'driver')->get();

    DB::transaction(function () use ($activities, $today) {
        foreach ($activities as $activity)
            {
                $reservation = $activity->reservation;
                $driver = $activity->driver;

                // Mengambil tanggal mulai dan tanggal akhir dari reservasi
                $startDate = Carbon::parse($reservation->tgl_mulai)->format('Y-m-d');
                $endDate = Carbon::parse($reservation->tgl_akhir)->format('Y-m-d');

                // Memeriksa apakah tanggal hari ini berada dalam rentang tanggal reservasi
                if ($today >= $startDate && $today <= $endDate) {
                    // Jika ya, ubah status driver menjadi "tidak tersedia"
                    $driver->status = 'tidak tersedia';
                } else {
                    // Jika tidak, biarkan status driver tetap "tersedia"
                    $driver->status = 'tersedia';
                }
                $driver->save();
        }
    });

    return view('admin.driver', [
        'title' => 'Driver',
        'coba' => Activity::with('reservation.driver')->get(),
        'sopir' => Driver::all(),
    ]);
}

    
    public function updateStatus(Request $request, $id)
    {
        $driver = Driver::find($id);
        if ($driver) {
            $driver->status = 'tersedia';
            $driver->save();
            return response()->json(['success' => true, 'message' => 'Status updated successfully']);
        }
        return response()->json(['success' => false, 'message' => 'Driver not found'], 404);
    }
    
}