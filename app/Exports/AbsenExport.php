<?php

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AbsenExport implements FromView
{
    protected $monthNumber;
    protected $year;

    public function __construct($year, $monthNumber)
    {
        $this->monthNumber = $monthNumber;
        $this->year = $year;
    }

    public function view(): View
    {
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $this->monthNumber, $this->year);

        $dataArray = [];
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $dataArray[] = $day;
        }

        $names = ['John', 'Jane', 'Alice', 'Bob']; // Replace with your list of names

        return view('guru.excels.absen', [
            'dataArray' => $dataArray,
            'names' => $names,
            'monthNumber' => $this->monthNumber,
            'year' => $this->year,
        ]);
    }
}

