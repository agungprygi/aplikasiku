<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportActivity extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function activity(){
        return $this->belongsTo(Activity::class);
    }
    public function report(){
        return $this->belongsTo(Report::class);
    }
}
