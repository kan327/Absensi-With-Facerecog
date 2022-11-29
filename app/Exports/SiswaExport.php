<?php

namespace App\Exports;

use App\Models\AbsenSiswa;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;

class SiswaExport implements FromQuery, WithMapping
{   
    use Exportable;
    protected $id_absen;
    protected $data_absen;

    public function __construct($id_absen_siswa){
        $this->id_absen = $id_absen_siswa;
    }

    public function map($absen_siswa): array
    {
        return [
            $absen_siswa->siswa->nama_siswa,
            $absen_siswa->kelas->kelas,
            $absen_siswa->tanggal,
            $absen_siswa->masuk,
            $absen_siswa->pulang,
            $absen_siswa->keterangan,
        ];
    }

    public function query()
    {
        return AbsenSiswa::whereIn('id', $this->id_absen);
    }
}
