<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Driver;
use App\Models\Report;
use App\Models\Activity;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\ReportActivity;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $lastReportId = Report::orderBy('id', 'desc')->first()->id;
        $report = ReportActivity::where('report_id', $lastReportId)->get();
        $bulan = date('m');
        $tahun = date('Y');
        return view('dashboard', [
            "title" => "Dashboard",
            "activities" => Activity::with('driver', 'reservation')->get(),
            "drivers" => Driver::all(),
            "reservations" => Reservation::all(),
            "bulan" => $bulan,
            "tahun" => $tahun,
            'reports' => $report,
        ]);
    }

    public function chart(Request $request)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));

        if ($request->has('action')) {
            if ($request->input('action') == 'mundur') {
                $tanggal = Carbon::createFromDate($tahun, $bulan, 1)->subMonth();
                $bulan = $tanggal->month;
                $tahun = $tanggal->year;
            } elseif ($request->input('action') == 'maju') {
                $tanggal = Carbon::createFromDate($tahun, $bulan, 1)->addMonth();
                $bulan = $tanggal->month;
                $tahun = $tanggal->year;
            }
        }

        $nama_bulan = Carbon::createFromDate($tahun, $bulan, 1)->translatedFormat('F');
        $jumlah_hari = Carbon::createFromDate($tahun, $bulan, 1)->daysInMonth;

        $activities = Activity::with('driver', 'reservation')
            ->whereHas('reservation', function ($query) use ($bulan, $tahun) {
                $query->where(function ($query) use ($bulan, $tahun) {
                    $query->whereMonth('tgl_mulai', $bulan)
                        ->whereYear('tgl_mulai', $tahun);
                })->orWhere(function ($query) use ($bulan, $tahun) {
                    $query->whereMonth('tgl_akhir', $bulan)
                        ->whereYear('tgl_akhir', $tahun);
                });
            })
            ->get();

        $title = 'Dashboard';

        return view('dashboard', compact('activities', 'title', 'nama_bulan', 'jumlah_hari', 'bulan', 'tahun'));
    }

}