<?php

use App\Models\Activity;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('tgl_pengajuan');
            $table->string('tgl_kegiatanAwal');
            $table->string('tgl_kegiatanAkhir');
            $table->string('asal');
            $table->string('nama_pegawai1');
            $table->string('nama_pegawai2');
            $table->string('jabatan1');
            $table->string('jabatan2');
            $table->string('pangkat1');
            $table->string('pangkat2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
