<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function($query, $search) {
            $query->where('driver_id', 'like', '%' . $search . '%')
                ->orWhereHas('driver', function($query) use ($search) {
                    $query->where('nama', 'like', '%' . $search . '%');
                })
                ->orWhereHas('reservation', function($query) use ($search) {
                    $query->where('kegiatan', 'like', '%' . $search . '%')
                        ->orWhere('pegawai', 'like', '%' . $search . '%')
                        ->orWhere('lokasi', 'like', '%' . $search . '%')
                        ->orWhereHas('unit', function($query) use ($search) {
                            $query->where('jenis', 'like', '%' . $search . '%');
                        });
                });
        });
    }

    public function reservation(){
        return $this->belongsTo(Reservation::class);
    }
    public function report(){
        return $this->belongsToMany(Report::class, 'report_activities');
    }
    public function reportactivity(){
        return $this->hasMany(ReportActivity::class);
    }
    public function driver(){
        return $this->belongsTo(Driver::class);
    }
}
