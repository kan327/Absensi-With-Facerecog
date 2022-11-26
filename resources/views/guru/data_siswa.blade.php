<!DOCTYPE html>
<html lang="en">
<!-- done figma -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/CSS/output.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/suport.css') }}">
    {{-- tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Quicksand:wght@600;700&display=swap"
        rel="stylesheet">
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
                        'un-x-tet': '#939393',
                        'un-tet': '#8C8C8C',
                    },
                    boxShadow: {
                        nav: '2px 2px 50px 1px rgba(179, 185, 191, 0.1);',
                        side: ' 0px 5px 10px rgba(0, 0, 0, 0.05);',
                    }
                },
            }
        }
    </script>
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
    <div class="absolute left-72 w-3/4 pb-20">
        <!-- card 1 -->
        @foreach ($data_kelas as $kelas)
        <div
            class="shadow-box mt-32 p-8 w-5/6 mx-auto rounded-2xl border-solid border-[0.1px] border-opacity-5 border-black"> 

            <div>
                <div class="w-fit float-left">
                    <h1 class="text-[#3F80FF] font-bold font-[Montserrat] text-2xl">Daftar Siswa | {{ $kelas }}</h1>
                    <p>Lihat dan Periksa kembali murid anda</p>
                </div>
                <a href='/data_siswa/tambah_murid' class="px-4 py-2 float-right bg-blue-normal-19 rounded-xl text-white font-bold">+Tambahkan Murid</a>
            </div>
            <div class="mt-20 h-[50vh] w-full overflow-auto">
                <table class="text-black w-full" cellpadding="2">
                    <thead class="text-[#8C8C8C] font-extrabold bg-white top-0 sticky z-10">
                        <tr class="text-sm text-un-tet">
                            <th class="p-3">No</th>
                            <th class="p-3">Nama</th>
                            <th class="p-3">Gender</th>
                            <th class="p-3">Kelas</th>
                        </tr>
                    </thead>
  
                        @foreach ($data_siswas as $data_siswa)
                            {{-- @foreach ($data_siswa as $siswa) --}}
                                <tbody class="text-center text-base font-bold text-n-tet-x cursor-pointer select-none">
                                    <tr class="hover:bg-[#E8F4FF] rounded-full in-hover-to">
                                        <td class="p-3" style="border-top-left-radius: 12px; border-bottom-left-radius: 12px;">{{ $no_siswa++ }}</td>
                                        <td class="p-3">{{ $data_siswa[0]->nama_siswa }}</td>
                                        <td class="p-3">{{ $data_siswa[0]->jenis_kelamin }}</td>
                                        <td class="p-3" style="border-top-right-radius: 12px; border-bottom-right-radius: 12px;">{{ $siswa->kelas->kelas }}</td>
                                    </tr>
                                </tbody>
                            {{-- @endforeach --}}
                        @endforeach
                    
                </table>
            </div>
            
        </div>
        @endforeach
        <!-- card 2 -->
    </div>
</body>

</html>


<!-- npx tailwindcss -i ./src/input.css -o ./public/assets/css/output.css --watch -->
