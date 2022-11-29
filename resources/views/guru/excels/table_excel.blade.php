<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Table Excel Kehadiran Murid</title>
    </head>

<body>

    <table>
        <!-- header table -->
        <thead >
            <tr >
                <th>No</th>
                <th>Nama</th>
                <th>Masuk</th>
                <th>Pulang</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <!-- body -->
        <tbody>
    
            @foreach ($data_absens as $data_absen)
                <tr>
    
                    <td >{{ $no++ }}</td>
    
                    <td >{{ $data_absen->siswa->nama_siswa }}</td>
                    <td >{{ $data_absen->masuk }}</td>
                    <td >{{ $data_absen->pulang }}</td>
                    <td >{{ $data_absen->keterangan }}</td>

                </tr>
            @endforeach
    
        </tbody>
    </table>
</body>

</html>
