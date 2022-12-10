<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Table Excel Kehadiran Murid</title>
    </head>

<body>

    <table cellpadding = "1">
        <!-- header table -->
        <thead>
            <tr>
                <th align="center"  style="font-weight: bold; height:30px; font-size: 13px; color: white; background-color: #10793F; border:1px solid black ;">No</th>
                <th align="center" style="width: 200px; font-weight: bold; font-size: 13px; color: white; background-color: #10793F;border:1px solid black ;"><b>Nama</b></th>
                <th align="center"  style="width: 200px; font-weight: bold; font-size: 13px; color: white; background-color: #10793F;border:1px solid black ;"><b>Masuk</b></th>
                <th align="center"  style="width: 200px; font-weight: bold; font-size: 13px; color: white; background-color: #10793F;border:1px solid black ;"><b>Pulang</b></th>
                <th align="center"  style="width: 200px; font-weight: bold; font-size: 13px; color: white; background-color: #10793F;border:1px solid black ;"><b>Keterangan</b></th>
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
                    <td style = "border:1px solid black ;" align="center" >{{ $data_absen->keterangan }}</td>

                </tr>
            @endforeach
    
        </tbody>
    </table>
</body>

</html>
