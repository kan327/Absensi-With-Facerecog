<?php

namespace App\Exports;

use App\Models\Siswa;
use App\Models\AbsenSiswa;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AbsenExport implements FromCollection, ShouldAutoSize, WithStyles
{
    protected $year;
    protected $monthNumber;
    protected $mapel;
    protected $kelas;

    public function __construct($year, $monthNumber, $mapel, $kelas)
    {
        $this->year = $year;
        $this->monthNumber = $monthNumber;
        $this->mapel = $mapel;
        $this->kelas = $kelas;
    }

    public function collection()
    {
        $absen_siswa = AbsenSiswa::with("siswa")->whereMonth('tanggal', $this->monthNumber)->whereYear('tanggal', $this->year )->where("kelas_id", $this->kelas)->get();


        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $this->monthNumber, $this->year);

            $dataArray = [];
            for ($day = 1; $day <= $daysInMonth; $day++) {

                $absen_siswa_day = AbsenSiswa::whereMonth('tanggal', $this->monthNumber)->whereYear('tanggal', $this->year )->where("kelas_id", $this->kelas)->whereDay("tanggal", $day)->get();

                $dataArray[] = [
                    "day" => $day,
                    "siswas" => []
                ];

                foreach($absen_siswa_day as $absen){
                    $dataArray[$day - 1]['siswas'][] = [
                        "nama" => $absen->siswa->nama_siswa,
                        "kehadiran" => $absen->keterangan_absensi
                    ];
                }

            }

        // dd($dataArray);

        $names = [];
        foreach ($absen_siswa as $i => $absen) {
            $names[] = $absen_siswa[$i]->siswa->nama_siswa; // Replace with your list of names
        }

        $tableData = new Collection();

        // Create the header row
        $headerRow = ['No', 'Nama Lengkap'];
        foreach ($dataArray as $i => $value) {
            $headerRow[] = $value['day'];
        }
        $tableData->push($headerRow);

// Populate the table with data
$rowNumber = 1;
foreach ($names as $name) {
    $rowData = [$rowNumber, $name];
    foreach ($dataArray as $day) {
        $cellValue = '';
        
        // Get the student's ID
        $student = Siswa::where('nama_siswa', $name)->first();
        $studentId = $student ? $student->id : null;
        // dd($studentId);

        // Check if the student was absent
        $absentRecord = $absen_siswa
            ->where('id_siswa', $studentId) // Assuming the field is id_siswa
            ->filter(function ($record) use ($day) {
                return $record->tanggal->day === $day && $record->keterangan === 'Belum Hadir';
            })
            ->first();

        if ($absentRecord) {
            $cellValue = '.';
        }

        $rowData[] = $cellValue;
    }
    $tableData->push($rowData);
    $rowNumber++;
}

return $tableData;
    }

    public function headings(): array
    {
        $monthName = date('F', mktime(0, 0, 0, $this->monthNumber, 1));
        return [
            ['Absence Report for ' . $monthName . ' ' . $this->year],
            [], // Empty row for spacing
            ['No', 'Name', ...$this->getDaysArray()],
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $lastColumn = $sheet->getHighestColumn();
        $lastRow = $sheet->getHighestRow();

        // Add border to all cells
        $sheet->getStyle('A1:' . $lastColumn . $lastRow)
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        // Add border to header cells
        $sheet->getStyle('A1:' . $lastColumn . '1')
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_MEDIUM);

        // Apply alignment and padding to header cells
        $sheet->getStyle('A1:' . $lastColumn . '1')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);
        $headerFont = $sheet->getStyle('A1:' . $lastColumn . '1')->getFont();
        $headerFont->setBold(true);
        $sheet->getStyle('A1:' . $lastColumn . '1')
            ->getAlignment()
            ->setWrapText(true);

        // Add additional styles as needed

        return [
            // Return any additional styles here
        ];
    }
}
