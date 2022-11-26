<!DOCTYPE html>
<html lang="en">
<!-- done Figma -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- style css -->
    <link rel="stylesheet" href="{{ asset('assets/CSS/output.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/suport.css') }}">
    {{-- tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Quicksand:wght@600;700&display=swap" rel="stylesheet">
    <!-- config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'blue-dark-10': '#1061FF',
                        'blue-purple-3F': '#3F80FF',
                        'blue-normal-19': '#1991FF',
                        'blue-light-34': '#349DFD',
                        'tet': '#393939',
                        'un-tet': '#8C8C8C',
                        'un-x-tet': '#939393',
                    },
                    boxShadow: {
                        nav: '2px 2px 50px 1px rgba(179, 185, 191, 0.1);',
                        side: ' 0px 5px 10px rgba(0, 0, 0, 0.05);',
                        stable: ' 0px 3px 4px rgba(0, 0, 0, 0.25);',
                        box: ' 0px 4px 4px rgba(0, 0, 0, 0.25)',
                    }
                },
            }
        }
    </script>
    <!-- font material ++ -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,500;1,500&display=swap"
        rel="stylesheet">
</head>

<body class="text-tet">
    <!-- navbar top -->
    @include('partials.navbar')

    <!-- Sidebar left -->
    @include('partials.sidebar')

    <!-- content -->
    <div class="absolute left-72 w-3/4">
        <!-- card -->
        <div
            class="shadow-box mt-32 p-8 w-5/6 mx-auto rounded-2xl border-solid border-[0.1px] border-opacity-5 border-black">
            <!-- top table -->
            <div>
                <div class="w-fit float-left">
                    <h1 class="font-bold text-xl font-[Montserrat]">Kelola Jadwal</h1>
                    <p class="text-[#5B5A5A] font-[quicksand] font-semibold ">Kelola semua jadwal anda dan tambahkan jadwal.</p>
                </div>
                <button class="#1991FF px-4 font-[quicksand] py-2 float-right bg-[#1991FF] rounded-xl text-white font-bold" onclick="location.href='/absensi/tambah_jadwal'">+ Tambahkan Jadwal</button>
            </div>
            <!-- table -->
            <div class="mt-20 h-[50vh] w-full overflow-auto">
                <table class="w-full font-[quicksand]" cellpadding="2">
                    <!-- header table -->
                    <thead class="font-extrabold bg-white top-0 sticky z-10">
                        <tr class="text-sm text-un-tet">
                            <th class="p-3">No</th>
                            <th class="p-3">Tanggal</th>
                            <th class="p-3">Kelas</th>
                            <th class="p-3">Matapel</th>
                            <th class="p-3 text-blue-light-34">Mulai</th>
                            <th class="p-3">Selesai</th>
                            <th class="p-3">Aksi</th>
                        </tr>
                    </thead>
                    <!-- body -->
                    <tbody class="text-center text-base font-bold text-n-tet-x cursor-pointer select-none">
                        
                        @foreach ($jadwal_absens as $jadwal_absen)
                            <tr class="hover:bg-[#E8F4FF] hover:font-bold rounded-full in-hover-to">
                                <!-- please delete or reuse this onclick -->
                                <td class="p-3 font-semibold " style="border-top-left-radius: 12px; border-bottom-left-radius: 12px;">{{ $no_jadwal++ }}
                                </td>
                                <td onclick="location.href = '/absen_siswa/{{ $jadwal_absen->tanggal }}/{{ $jadwal_absen->kelas_id }}/{{ $jadwal_absen->mapel_id }}'" class="p-3 font-semibold">{{ \Carbon\Carbon::parse($jadwal_absen->tanggal)->format("d/m/Y") }}</td>
                                <td onclick="location.href = '/absen_siswa/{{ $jadwal_absen->tanggal }}/{{ $jadwal_absen->kelas_id }}/{{ $jadwal_absen->mapel_id }}'" class="p-3 font-semibold">{{ $jadwal_absen->kelas->kelas }}</td>
                                <td onclick="location.href = '/absen_siswa/{{ $jadwal_absen->tanggal }}/{{ $jadwal_absen->kelas_id }}/{{ $jadwal_absen->mapel_id }}'" class="p-3 font-semibold">{{ $jadwal_absen->mapel->pelajaran }}</td>
                                <td onclick="location.href = '/absen_siswa/{{ $jadwal_absen->tanggal }}/{{ $jadwal_absen->kelas_id }}/{{ $jadwal_absen->mapel_id }}'" class="p-3 font-semibold">{{ $jadwal_absen->mulai }}</td>
                                <td onclick="location.href = '/absen_siswa/{{ $jadwal_absen->tanggal }}/{{ $jadwal_absen->kelas_id }}/{{ $jadwal_absen->mapel_id }}'" class="p-3 font-semibold">{{ $jadwal_absen->selesai }}</td>
                                <td class="text-n-blue"
                                    style="border-top-right-radius: 12px; border-bottom-right-radius: 12px;">

                                    <span class="material-symbols-outlined">edit</span>
                                    <a href="absensi/hapus/{{ $jadwal_absen->id }}"><span class="material-symbols-outlined this-one">delete</span></a>
                                    <a href="/excel"><span class="material-symbols-outlined">file_download</span></a></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- custom alert -->
    <script src="{{ asset('assets/JS/cstkei.alert.js') }}"></script>

    @if (Session::has("success"))
        <script>keiAlert("{{ session()->get('success') }}", 'done', 'bg-[#22c55e]')</script>
    @endif
</body>

</html>

<!-- npx tailwindcss -i ./src/input.css -o ./public/assets/css/output.css --watch -->