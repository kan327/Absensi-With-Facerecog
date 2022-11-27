<?php

namespace App\Exports;

use App\Models\AbsenSiswa;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class SiswaExport implements FromCollection
{

    protected $id_guru;
    protected $tanggal;
    protected $id_kelas;
    protected $id_mapel;

    public function __construct($id_guru, $tanggal, $id_kelas, $id_mapel){
        $this->id_guru = $id_guru; 
        $this->tanggal = $tanggal; 
        $this->id_kelas = $id_kelas; 
        $this->id_mapel = $id_mapel;
        
        $absen_siswa = AbsenSiswa::with(['kelas', 'siswa', 'user'])->where("user_id",$this->id_guru)->where("tanggal", $this->tanggal)->where("kelas_id", $this->id_kelas)->get();

        foreach($absen_siswa as $absen){
            dump($absen->user->name);
            dump($absen->siswa->nama_siswa);
            dump($absen->kelas->kelas);
        };

        dd($absen_siswa[0]->siswa->nama_siswa);
        // return dd($absen_siswa);
    }
    

    public function collection()
    {

        return AbsenSiswa::all();
    }
}
