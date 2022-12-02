<!DOCTYPE html>
<html lang="en">
<!-- done figma -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kelas | Starbhak Absensi</title>
    <link rel="stylesheet" href="{{ asset('assets/CSS/output.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/suport.css') }}">
    <script src="{{ asset('assets/JS/cstkei.alert.js') }}"></script>
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
                            'bg-blue-dark': '#2C3E50',
                            'dark-data': '#393939',
                            'placeholder': '#A0A0A0',
                            'bg': '#FCFCFF',
                        },
                        boxShadow: {
                            nav: '2px 3px 3px 1px rgba(0, 0, 0, 0.1);',
                            side: ' 0px 5px 10px rgba(0, 0, 0, 0.05);',
                            stable: ' 0px 3px 4px rgba(0, 0, 0, 0.25);',
                            box: ' 0px 4px 4px rgba(0, 0, 0, 0.25)',
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

<body class="text-bg-blue-dark">
    <!-- navbar top -->
    @include('partials.navbar')

    <!-- Sidebar left -->
    @include('partials.sidebar')

    <!-- content -->
    <div class="absolute left-72 w-3/4 pb-20">
        <!-- card 1 -->
        <div
            class="shadow-box mt-32 p-8 w-5/6 mx-auto rounded-2xl border-solid border-[0.1px] border-opacity-5 border-black">

            <div>
                <div class="w-fit float-left">
                    <h1 class="text-bg-blue-dark font-bold font-[Montserrat] text-2xl">Daftar Siswa | {{ $data_kelas->kelas }}</h1>
                    <p>Lihat dan Periksa kembali murid anda</p>
                </div>
                <button onclick="location.href='/data_kelas/tambah_murid/{{ $data_kelas->id }}'" class="px-4 py-2 float-right bg-bg-blue-dark rounded-xl text-white font-bold">+ Tambahkan
                    Murid</button>
            </div>

            <!-- table -->
            <div class="mt-20 h-[50vh] w-full overflow-auto border-bg-blue-dark border-solid border-t-2">
                <table class="text-black w-full" cellpadding="2">
                    <thead class="text-[#8C8C8C] font-extrabold bg-white top-0 sticky z-10">
                        <tr class="text-sm text-un-tet">
                            <th class="p-3">No</th>
                            <th class="p-3">Nama</th>
                            <th class="p-3">Lahir</th>
                            <th class="p-3">Gender</th>
                            <th class="p-3">Kelas</th>
                        </tr>
                    </thead>
                    <tbody class="text-center text-base font-bold cursor-pointer select-none">

                        @foreach ($data_siswa as $siswa)
                            <tr class="hover:bg-[#F5F5F5] rounded-full in-hover-to">
                                <td class="p-3" style="border-top-left-radius: 12px; border-bottom-left-radius: 12px;">{{ $no++ }}
                                </td>
                                <td class="p-3">{{ $siswa->nama_siswa }}</td>
                                <td class="p-3">{{ $siswa->tgl_lahir }}</td>
                                <td class="p-3">{{ $siswa->jenis_kelamin }}</td>
                                <td class="p-3" style="border-top-right-radius: 12px; border-bottom-right-radius: 12px;">
                                    {{ $siswa->kelas->kelas }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>


<!-- npx tailwindcss -i ./src/input.css -o ./public/assets/css/output.css --watch -->