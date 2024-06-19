<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Unit;
use App\Models\Jenis_activity;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Unit::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Jenis_Activity::class)->constrained()->cascadeOnDelete();
            $table->string('pegawai');
            $table->string('telepon',12);
            $table->string('kegiatan');
            $table->string('lokasi');
            $table->date('tgl_mulai');
            $table->date('tgl_akhir');
            $table->time('waktu', 0);
            $table->string('jumlah_driver');
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
