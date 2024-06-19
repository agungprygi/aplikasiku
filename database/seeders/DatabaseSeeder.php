<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Driver;
use App\Models\jenis_activity;
use App\Models\Surat;
use App\Models\Unit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::create([
            'username' => 'INDRA GUNAWAN',
            'email' => 'i_gunawan@bi.go.id',
            'password' => Hash::make('12102'),
        ]);
        User::create([
            'username' => 'HASTUTI FIHIM',
            'email' => 'hastuti_f@bi.go.id',
            'password' => Hash::make('12347'),
        ]);
        User::create([
            'username' => 'TATA YONI PERMANA',
            'email' => 'tata_yp@bi.go.id',
            'password' => Hash::make('13068'),
        ]);
        User::create([
            'username' => 'SULAIMAN SANDIAH',
            'email' => 'sulaiman_s@bi.go.id',
            'password' => Hash::make('13093'),
        ]);
        User::create([
            'username' => 'JUSRI YUSUF',
            'email' => 'jusri_y@bi.go.id',
            'password' => Hash::make('13322'),
        ]);
        User::create([
            'username' => 'IDRUS ALBAAR',
            'email' => 'idrus_a@bi.go.id',
            'password' => Hash::make('13375'),
        ]);
        User::create([
            'username' => 'RUSLI IBRAHIM',
            'email' => 'rusli_i@bi.go.id',
            'password' => Hash::make('13376'),
        ]);
        User::create([
            'username' => 'AFENDI ROLOBESSY',
            'email' => 'afendi_r@bi.go.id',
            'password' => Hash::make('13390'),
        ]);
        User::create([
            'username' => 'ARIYUDHI ASTRODJOJO',
            'email' => 'ariyudhi_a@bi.go.id',
            'password' => Hash::make('13391'),
        ]);
        User::create([
            'username' => 'DWI PUTRA INDRAWAN',
            'email' => 'dwiputra_i@bi.go.id',
            'password' => Hash::make('13403'),
        ]);
        User::create([
            'username' => 'RIDHO AKBAR ISMAYA',
            'email' => 'ridho_ai@bi.go.id',
            'password' => Hash::make('15089'),
        ]);
        User::create([
            'username' => 'FAUJIA TILAAR',
            'email' => 'faujia_t@bi.go.id',
            'password' => Hash::make('15229'),
        ]);
        User::create([
            'username' => 'MURNIWATTY',
            'email' => 'murniwaty@bi.go.id',
            'password' => Hash::make('15318'),
        ]);
        User::create([
            'username' => 'NURSIDA ARIF',
            'email' => 'nursida_a@bi.go.id',
            'password' => Hash::make('15339'),
        ]);
        User::create([
            'username' => 'ERLANGGA FEBRIANNO',
            'email' => 'erlangga_f@bi.go.id',
            'password' => Hash::make('15586'),
        ]);
        User::create([
            'username' => 'PRIHATMOKO BAGUS PRASETYO',
            'email' => 'prihatmoko_bp@bi.go.id',
            'password' => Hash::make('15761'),
        ]);
        User::create([
            'username' => 'VARRIS LA ADE',
            'email' => 'varris_la@bi.go.id',
            'password' => Hash::make('15777'),
        ]);
        User::create([
            'username' => 'ARDIANSYAH EDDI PUTRA',
            'email' => 'ardiansyah_ep@bi.go.id',
            'password' => Hash::make('15965'),
        ]);
        User::create([
            'username' => 'AGIL BIN SYEH ABUBAKAR',
            'email' => 'agil_bsa@bi.go.id',
            'password' => Hash::make('16167'),
        ]);
        User::create([
            'username' => 'CHUBAID HAKIM',
            'email' => 'chubaid_h@bi.go.id',
            'password' => Hash::make('16186'),
        ]);
        User::create([
            'username' => 'HASYRUL USMAN BACHDAR',
            'email' => 'hasyrul_ub@bi.go.id',
            'password' => Hash::make('16341'),
        ]);
        User::create([
            'username' => 'MUHAMMAD RIZAL',
            'email' => 'mrizal@bi.go.id',
            'password' => Hash::make('16390'),
        ]);
        User::create([
            'username' => 'PANGERAN AMAL ZAINUDDIN',
            'email' => 'pangeran_az@bi.go.id',
            'password' => Hash::make('16404'),
        ]);
        User::create([
            'username' => 'WATON RUHIYAT',
            'email' => 'waton_r@bi.go.id',
            'password' => Hash::make('16455'),
        ]);
        User::create([
            'username' => 'SOTARO ANTONIUS ZEBUA',
            'email' => 'sotaro_az@bi.go.id',
            'password' => Hash::make('16626'),
        ]);
        User::create([
            'username' => 'JAN STENLY NENDISSA',
            'email' => 'jan_stenly@bi.go.id',
            'password' => Hash::make('17211'),
        ]);
        User::create([
            'username' => 'JOKO PRASETIO',
            'email' => 'joko_p@bi.go.id',
            'password' => Hash::make('17216'),
        ]);
        User::create([
            'username' => 'PARAMITHA DAHLAN',
            'email' => 'paramitha_d@bi.go.id',
            'password' => Hash::make('17282'),
        ]);
        User::create([
            'username' => 'SITI KAMILIA ALBAAR',
            'email' => 'siti_ka@bi.go.id',
            'password' => Hash::make('17332'),
        ]);
        User::create([
            'username' => 'MAHARTIKA FATDANA NASUTION',
            'email' => 'mahartika_fatdana@bi.go.id',
            'password' => Hash::make('17377'),
        ]);
        User::create([
            'username' => 'MUHAMMAD RAFLI TAHISA',
            'email' => 'muhammad_rafli@bi.go.id',
            'password' => Hash::make('17514'),
        ]);
        User::create([
            'username' => 'FAUZI RACHMAN WIJAYA',
            'email' => 'fauzi_rachman@bi.go.id',
            'password' => Hash::make('18161'),
        ]);
        User::create([
            'username' => 'LAKSONO KURNIADI',
            'email' => 'laksono_kurniadi@bi.go.id',
            'password' => Hash::make('18185'),
        ]);
        User::create([
            'username' => 'MADE LANANG RAY WIDYATMIKA',
            'email' => 'made_lanang@bi.go.id',
            'password' => Hash::make('18190'),
        ]);
        User::create([
            'username' => 'PRIMA PUTRA PAMUNGKAS',
            'email' => 'prima_putra@bi.go.id',
            'password' => Hash::make('18212'),
        ]);
        User::create([
            'username' => 'RASYID RAMADHAN SAMSURI',
            'email' => 'rasyid_ramadhan@bi.go.id',
            'password' => Hash::make('18222'),
        ]);
        User::create([
            'username' => 'MUHAMMAD MALIK IBRAHIM',
            'email' => 'muhammad_malik@bi.go.id',
            'password' => Hash::make('18374'),
        ]);
        User::create([
            'username' => 'Munawir',
            'email' => 'admin@gmail.com',
            'usertype' => 'admin',
            'password' => Hash::make('12345'),
        ]);


        jenis_activity::create([
            "jenis_kegiatan" => "Didalam Kota"
        ]);
        jenis_activity::create([
            "jenis_kegiatan" => "Diluar Kota"
        ]);


        Unit::create([
            "jenis" => "Toyota Hilux Double Cabin"
        ]);
        Unit::create([
            "jenis" => "Toyota Hilux"
        ]);
        Unit::create([
            "jenis" => "Toyota Fortuner"
        ]);
        Unit::create([
            "jenis" => "Toyota Vios"
        ]);
        Unit::create([
            "jenis" => "Toyota Camry"
        ]);
        Unit::create([
            "jenis" => "Toyota Innova"
        ]);
        Unit::create([
            "jenis" => "Daihatsu Pajero"
        ]);
        Unit::create([
            "jenis" => "Remise Kaskel"
        ]);
        Unit::create([
            "jenis" => "Remise"
        ]);
        Unit::create([
            "jenis" => "X-trail"
        ]);
        Unit::create([
            "jenis" => "Kaskel"
        ]);


        Driver::create([
            "nama" => "Irwan Senen",
            "alamat" => "Jatinangor",
            "telepon" => "085156061466",
            "status" => "tersedia"
        ]);
        Driver::create([
            "nama" => "Ikbal Taher",
            "alamat" => "Tanah raja",
            "telepon" => "085156061466",
            "status" => "tersedia"
        ]);
        Driver::create([
            "nama" => "M Gilang Maulana Putra",
            "alamat" => "Kayu Merah",
            "telepon" => "085156061466",
            "status" => "tersedia"
        ]);
        Driver::create([
            "nama" => "Faisal Hamzah",
            "alamat" => "Koloncucu",
            "telepon" => "085156061466",
            "status" => "tersedia"
        ]);
        Driver::create([
            "nama" => "Fadly Azis",
            "alamat" => "Maliaron",
            "telepon" => "085156061466",
            "status" => "tersedia"
        ]);
        Driver::create([
            "nama" => "Muhammad Marson",
            "alamat" => "Kolo",
            "telepon" => "085156061466",
            "status" => "tersedia"
        ]);
    }
}
