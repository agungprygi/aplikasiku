<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Unit;
use App\Models\Driver;
use App\Models\Report;
use App\Models\Activity;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Jenis_Activity;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->check() && auth()->user()->isAdmin()) {
            return view('admin.reservasi.jadwal', [
                'title' => 'Jadwal Admin',
                'reservations' => Reservation::all(),
                'activities' => Activity::latest()->filter(request(['search']))->paginate(8),
                'units' => Unit::all(),
            ]);
        }
    
        return view('user.reservasi.jadwal', [
            'title' => 'Jadwal User',
            'reservations' => Reservation::all(),
            'activities' => Activity::latest()->filter(request(['search']))->paginate(8),
            'units' => Unit::all(),
        ]);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countAvailableDrivers = Driver::where('status', 'tersedia')->get()->count();
        $defaultDriverId = $countAvailableDrivers > 0 ? null : 0;

        if (auth()->check() && auth()->user()->isAdmin()){
            return view('admin.reservasi.createreservasi', [
                'title' => 'Reservasi',
                'reservation' => Reservation::all(),
                'countAvailableDrivers' => $countAvailableDrivers,
                'defaultDriverId' => $defaultDriverId,
                'units' => Unit::all(),
                'kegiatan' => Jenis_Activity::all(),
            ]);
        }
        return view('user.reservasi.createreservasi', [
            'title' => 'Reservasi',
            'reservation' => Reservation::all(),
            'countAvailableDrivers' => $countAvailableDrivers,
            'defaultDriverId' => $defaultDriverId,
            'units' => Unit::all(),
            'kegiatan' => Jenis_Activity::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pegawai' => 'required|max:255',
            'telepon' => 'required|max:12',
            'kegiatan' => 'required',
            'lokasi' => 'required',
            'tgl_mulai' => 'required',
            'tgl_akhir' => 'required',
            'waktu' => 'required',
            'jumlah_driver' => 'required',
            'unit_id' => 'required',
            'keterangan' => 'required',
            'jenis_activity_id' => 'required',
        ]);
    
        $validatedData['user_id'] = auth()->user()->id;
    
        // Ambil driver yang tersedia sesuai dengan jumlah yang dipilih oleh pengguna
        $availableDrivers = Driver::where('status', 'tersedia')
            ->orderBy('id', 'asc')
            ->take($request->input('jumlah_driver'))
            ->get();
    
        // Pastikan ada driver yang tersedia sebelum menyimpan reservasi
        if ($availableDrivers->isNotEmpty()) {
            // Buat reservasi
            $reservation = Reservation::create($validatedData);
    
            // Simpan data kegiatan untuk setiap driver yang tersedia
            foreach ($availableDrivers as $driver) {
                // Simpan data kegiatan
                $kegiatanData = array_merge($validatedData, ['driver_id' => $driver->id, 'reservation_id' => $reservation->id]);
                Activity::create($kegiatanData);
    
                // Update status driver menjadi "tidak tersedia"
                $driver->status = 'tidak tersedia';
                $driver->save();
            }
    
            if (auth()->check() && auth()->user()->isAdmin()) {
                return redirect('/admin/reservasi/show')->with('success', 'Reservasi telah berhasil dibuat');
            }
    
            return redirect('/user/reservasi/show')->with('success', 'Reservasi telah berhasil dibuat');
        }
    
        return back()->with('error', 'No available drivers found.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $userId = Auth::id();
        
        $reservations = Reservation::where('user_id', $userId)->get();
        $activities = Activity::whereIn('reservation_id', $reservations->pluck('id'))->filter(request(['search']))->paginate(8);
        
        if (auth()->check() && auth()->user()->isAdmin()){
            return view('admin.reservasi.cekreservasi', [
                'title' => 'Cek Reservasi',
                'reservations' => $reservations,
                'activities' => $activities,
                'units' => Unit::all(),
                
            ]);
        }
        return view('user.reservasi.cekreservasi', [
            'title' => 'Cek Reservasi',
            'reservations' => $reservations,
            'activities' => $activities,
            'units' => Unit::all()
        ]);
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $reservation = Activity::find($id);
        
        if (auth()->check() && auth()->user()->isAdmin()){return view('admin.reservasi.editreservasi',[
                'title' => 'Cek Reservasi',
                'reservation' => $reservation,
                'activities' => Activity::all(),
                'units' => Unit::all(),
                'kegiatan' => Jenis_Activity::all(),
                'drivers' => Driver::all(),
            ]);
        }

        return view('user.reservasi.editreservasi',[
            'title' => 'Cek Reservasi',
            'reservation' => $reservation,
            'activities' => Activity::all(),
            'units' => Unit::all()
        ]);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $reservation = activity::find($id);
    
        // Validasi data yang diterima dari permintaan
        $validatedData = $request->validate([
            'pegawai' => 'required|max:255',
            'telepon' => 'required|max:12',
            'kegiatan' => 'required',
            'lokasi' => 'required',
            'tgl_mulai' => 'required',
            'tgl_akhir' => 'required',
            'waktu' => 'required',
            'unit_id' => 'required',
            'keterangan' => 'required',
            'jenis_activity_id' => 'required',
            'driver_id' => 'required'
        ]);
    
        // Update data reservasi
        Reservation::where('id', $reservation->reservation_id)->update([
            'pegawai' => $validatedData['pegawai'],
            'telepon' => $validatedData['telepon'],
            'kegiatan' => $validatedData['kegiatan'],
            'lokasi' => $validatedData['lokasi'],
            'tgl_mulai' => $validatedData['tgl_mulai'],
            'tgl_akhir' => $validatedData['tgl_akhir'],
            'waktu' => $validatedData['waktu'],
            'unit_id' => $validatedData['unit_id'],
            'keterangan' => $validatedData['keterangan'],
            'jenis_activity_id' => $validatedData['jenis_activity_id'],
        ]);
    
        // Update driver_id in activities table
        Activity::where('id', $reservation->id)->update(['driver_id' => $validatedData['driver_id']]);
    
        // Redirect based on user role
        if (auth()->check() && auth()->user()->isAdmin()){
            return redirect()->route('reservasi.index')->with('success', 'Reservation Telah berhasil di update');
        }
    
        return redirect()->route('reservasi.index')->with('success', 'Reservation Telah berhasil di update');
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    // Temukan aktivitas berdasarkan ID
    $activity = Activity::find($id);
    
    // Pastikan aktivitas ditemukan
    if (!$activity) {
        return redirect()->route('reservasi.index')->with('error', 'Activity not found.');
    }
    
    // Temukan reservasi terkait berdasarkan reservation_id dari aktivitas yang ditemukan
    $reservation = Reservation::find($activity->reservation_id);
    
    // Pastikan reservasi ditemukan
    if (!$reservation) {
        return redirect()->route('reservasi.index')->with('error', 'Reservation not found.');
    }
    
    // Temukan semua aktivitas yang terkait dengan reservasi ini
    $activities = Activity::where('reservation_id', $reservation->id)->get();
    
    // Temukan semua driver yang terlibat dalam aktivitas tersebut
    $selectedDrivers = Driver::whereIn('id', $activities->pluck('driver_id'))->where('status', 'tidak tersedia')->get();
    
    // Hapus semua aktivitas terkait
    foreach ($activities as $activity) {
        $activity->delete();
    }
    
    // Hapus reservasi
    $reservation->delete();
    
    // Perbarui status pengemudi menjadi 'tersedia'
    foreach ($selectedDrivers as $driver) {
        $driver->status = 'tersedia';
        $driver->save();
    }
    
    // Redirect dengan pesan sukses
    return redirect()->route('reservasi.index')->with('success', 'Reservasi telah berhasil dihapus');
}

    

    
}
