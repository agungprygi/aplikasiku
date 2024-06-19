<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Surat;
use App\Models\Report;
use App\Mail\helloMail;
use App\Models\Activity;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\ReportActivity;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;

class TemplateController extends Controller
{
    public function getReportActivityWithDrivers()
    {
        $results = DB::table('report_activities')
        ->join('activities', 'report_activities.activity_id', '=', 'activities.id')
        ->join('drivers', 'activities.driver_id', '=', 'drivers.id')
        ->select('report_activities.*', 'activities.reservation_id', 'drivers.nama as driver_nama', 'drivers.telepon as driver_telepon')
        ->get();

    return $results;
    }
    public function index()
    {
        $userId = Auth::id();
        $reservations = Reservation::where('user_id', $userId)->get();
        $activities = Activity::whereIn('reservation_id', $reservations->pluck('id'))->get();
        
        return view('edittemplate',[
            'title' => 'Template',
            'reservations' => $reservations,
            'activities' => $activities,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tgl_pengajuan' => 'required|date',
            'reservation_id.*' => 'required|exists:reservations,id', // Pastikan reservation_id ada di tabel reservations
            'tgl_kegiatanAwal' => 'required|date',
            'tgl_kegiatanAkhir' => 'required|date',
            'asal' => 'required|string|max:255',
            'nama_pegawai1' => 'required|string|max:255',
            'nama_pegawai2' => 'required|string|max:255',
            'jabatan1' => 'required|string|max:255',
            'jabatan2' => 'required|string|max:255',
            'pangkat1' => 'required|string|max:255',
            'pangkat2' => 'required|string|max:255',
        ]);

        // Buat entri baru di tabel reports
        $report = Report::create([
            'tgl_pengajuan' => $validated['tgl_pengajuan'],
            'tgl_kegiatanAwal' => $validated['tgl_kegiatanAwal'],
            'tgl_kegiatanAkhir' => $validated['tgl_kegiatanAkhir'],
            'asal' => $validated['asal'],
            'nama_pegawai1' => $validated['nama_pegawai1'],
            'nama_pegawai2' => $validated['nama_pegawai2'],
            'jabatan1' => $validated['jabatan1'],
            'jabatan2' => $validated['jabatan2'],
            'pangkat1' => $validated['pangkat1'],
            'pangkat2' => $validated['pangkat2'],
        ]);
        
        $reportId = $report->id;

        // Proses setiap reservation_id untuk mengambil activity_id terkait
        foreach ($validated['reservation_id'] as $reservationId) {
            // Ambil activity_id berdasarkan reservation_id dari tabel activities
            $activities = Activity::where('reservation_id', $reservationId)->get();
            
            // Simpan setiap activity_id yang ditemukan ke tabel report_activities
            foreach ($activities as $activity) {
                ReportActivity::create([
                    'report_id' => $reportId,
                    'activity_id' => $activity->id,
                    'reservation_id' => $reservationId,
                ]);
            }
        }

        return redirect()->route('pdfLdp', $reportId);
    }

    

    public function show($id, Report $report) {
        $report = Report::findOrFail($id);
        $reportActivities = ReportActivity::where('report_id', $report->id)->get();
        $formattedDate = Carbon::parse($report->tgl_pengajuan)->translatedFormat('d F Y');
        $tgl_kegiatanAwal = $report->tgl_kegiatanAwal;
        $tgl_kegiatanAkhir = $report->tgl_kegiatanAkhir;
        $asal = $report->asal;
        $pejabat1 = $report->nama_pegawai1;
        $pejabat2 = $report->nama_pegawai2;
        $jabatan1 = $report->jabatan1;
        $jabatan2 = $report->jabatan2;
        $pangkat1 = $report->pangkat1;
        $pangkat2 = $report->pangkat2;
    
        $data = [
            "title" => "Template LDP",
            "report" => $reportActivities,
            'tanggal' => $formattedDate,
            'reservation' => Activity::all(),
            'tgl_kegiatanAwal' => $tgl_kegiatanAwal,
            'tgl_kegiatanAkhir' => $tgl_kegiatanAkhir,
            'asal' => $asal,
            'nama_pegawai1' => $pejabat1,
            'nama_pegawai2' => $pejabat2,
            'jabatan1' => $jabatan1,
            'jabatan2' => $jabatan2,
            'pangkat1' => $pangkat1,
            'pangkat2' => $pangkat2,
        ];
         // Buat PDF dari view
        $pdf = Pdf::loadView('pdfLdp', $data);

        // Mengembalikan PDF untuk ditampilkan di browser
        return Response::make($pdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="LDP_' . time() . '.pdf"'
        ]);
    }
    
    public function upload(){
        $report = ReportActivity::latest();
        return view('uploadldp', [
            'title' => 'Upload',
            'activities' => Activity::where('id'),
            'report' => $report,
        ]);
    }
    
    public function kirim(Request $request)
    {
        ini_set('max_execution_time', 300);
        
        $validated = $request->validate([
            'pengirim' => 'required',
            'email_pengirim' => 'required|email',
            'dokumen' => 'required|file',
        ]);

        if ($request->hasFile('dokumen')) {
            $file = $request->file('dokumen');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('pdf'), $filename);
            $validated['dokumen'] = 'pdf/' . $filename;
        }

        $surats = Surat::create($validated);
        return redirect()->route('kirimemail', ['id' => $surats->id]);
    }
    
    public function email($id)
    {
        $surat = Surat::findOrFail($id);
        $toEmail = 'smartdevice0263@gmail.com';

        Mail::to($toEmail)->send(new helloMail($surat));

        return redirect()->route('kirimWa')->with('success', 'Email Telah berhasil terkirim dan driver telah dihubungi');
    }
    
}

