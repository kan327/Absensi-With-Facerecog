<?php

namespace App\Exports;

use App\Models\AbsenSiswa;
use App\Models\kelas;
use App\Models\mapel;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithMapping;

class SiswaExport implements FromView
{   
    // use Exportable;
    // protected $id_absen;
    // protected $data_absen;

    // public function __construct($id_absen_siswa){
    //     $this->id_absen = $id_absen_siswa;
    // }

    // public function map($absen_siswa): array
    // {
    //     return [
    //         $absen_siswa->siswa->nama_siswa,
    //         $absen_siswa->kelas->kelas,
    //         $absen_siswa->tanggal,
    //         $absen_siswa->masuk,
    //         $absen_siswa->pulang,
    //         $absen_siswa->keterangan,
    //     ];
    // }

    // public function query()
    // {
    //     return AbsenSiswa::whereIn('id', $this->id_absen);
    // }

    use Exportable;

    protected $data_absensi;
    protected $data_kelas;
    protected $data_mapel;
    protected $tanggal;

    public function __construct($id_absen, $tanggal, $kelas, $mapel)
    {
        $absen = AbsenSiswa::whereIn("id", $id_absen)->where("tanggal", $tanggal)->where("kelas_id", $kelas)->get();
        $data_kelas = kelas::with(['siswas'])->find($kelas);
        $data_mapel = mapel::find($mapel);

        $this->data_absensi = $absen;
        $this->data_kelas = $data_kelas;
        $this->data_mapel = $data_mapel;
        $this->tanggal = $tanggal;
        // dd(Carbon\Carbon::parse($tanggal)->translatedFormat("d F Y"));
    }

    public function view(): View
    {
        return view("guru.excels.table_excel",[
            "kelas"=>$this->data_kelas,
            "tanggal" => $this->tanggal,
            "mapel"=>$this->data_mapel,
            'data_absens'=>$this->data_absensi,
            "no"=>1,
        ]);
    }
}
