<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    public function surat(){
        return $this-> belongsTo(Surat::class);
    }
    public function reservation(){
        return $this-> belongsToMany(Reservation::class, 'report_activities');
    }
    public function activity(){
        return $this-> belongsToMany(Activity::class);
    }
    public function reportActivities(){
        return $this->hasMany(ReportActivity::class);
    }
}
