<?php

namespace App\Exports;

use App\Models\User;
use App\Models\kelas;
use App\Models\AbsenExcel;
use App\Models\AbsenSiswa;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

class SiswaExport implements FromCollection
{

    use Exportable;
    
    protected $id_guru;
    protected $tanggal;
    protected $id_kelas;

    public function __construct($id_guru, $tanggal, $id_kelas){
        
        // guru
        $guru = User::all()->where("id", $id_guru);
        
        // kelas
        $kelas = kelas::all()->where("id", $id_kelas);
        
        $this->id_guru = $guru->first()->name;
        $this->tanggal = $tanggal;
        $this->id_kelas = $kelas->first()->kelas;

    }
    

    public function collection()
    {
        $absensi = AbsenExcel::all()->where('tanggal', $this->tanggal)->where("nama_guru", $this->id_guru)->where('nama_kelas', $this->id_kelas);

        return dd(AbsenExcel::all()->where('tanggal', $this->tanggal)->where("nama_guru", $this->id_guru)->where('nama_kelas', $this->id_kelas));
    }
}
