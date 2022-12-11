<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Table Excel Kehadiran Murid</title>
    </head>

<body>

    <div style="margin: 8px auto ;">
        <h2 style="font-weight: bold; font-size: 10px; ">Data Absensi {{ Carbon\Carbon::parse($tanggal)->translatedFormat("d F Y") }}</h2>
        <h2 style="font-weight: bold; font-size: 10px;">Kelas {{ $kelas->kelas }}</h2>
        <h2 style="font-weight: bold; font-size: 10px;">Mata Pelajaran {{ $mapel->pelajaran }}</h2>
    </div>
    <table cellpadding = "1" style="margin: 8px auto;">
        <!-- header table -->
        <thead>
            <tr>
                <th align="center"  style="font-weight: bold; font-size: 13px; color: white; background-color: #2C3E50; border:1px solid black ;">No</th>
                <th align="center" style="width: 200px; font-weight: bold; font-size: 13px; color: white; background-color: #2C3E50;border:1px solid black ;"><b>Nama</b></th>
                <th align="center"  style="width: 200px; font-weight: bold; font-size: 13px; color: white; background-color: #2C3E50;border:1px solid black ;"><b>Masuk</b></th>
                <th align="center"  style="width: 200px; font-weight: bold; font-size: 13px; color: white; background-color: #2C3E50;border:1px solid black ;"><b>Pulang</b></th>
                <th align="center"  style="width: 200px; font-weight: bold; font-size: 13px; color: white; background-color: #2C3E50;border:1px solid black ;"><b>Keterangan</b></th>
            </tr>
        </thead>
        <!-- body -->
        <tbody>
    
            @foreach ($data_absens as $data_absen)
                <tr>
    
                    <td style = "border:1px solid black ;" align="center">{{ $no++ }}.</td>
                    <td style = "border:1px solid black ;" align="center" >{{ $data_absen->siswa->nama_siswa }}</td>
                    <td style = "border:1px solid black ;" align="center" >{{ $data_absen->masuk }}</td>
                    <td style = "border:1px solid black ;" align="center" >{{ $data_absen->pulang }}</td>
                    <td style = "border:1px solid black ;" align="center" >{{ $data_absen->keterangan }}-{{ $data_absen->keterangan_absensi }}</td>

                </tr>
            @endforeach
    
        </tbody>
    </table>
</body>

</html>
