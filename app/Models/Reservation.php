<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['user', 'driver'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function unit(){
        return $this->belongsTo(Unit::class);
    }
    public function jenis_activity(){
        return $this->belongsTo(Jenis_Activity::class);
    }
    public function report(){
        return $this->belongsTo(Report::class);
    }
    public function driver(){
        return $this->belongsToMany(Driver::class, 'activities');
    }
    
}
