<!DOCTYPE html>
<html lang="en">
<!-- wait for figma -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard | Admin</title>
      
    {{-- tailwind --}}

    <script src="https://cdn.tailwindcss.com"></script>
            
    <script src="{{ asset('assets/JS/jquery.js') }}"></script>

    <!-- style css -->

    <link rel="stylesheet" href="{{ asset('assets/CSS/output.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/suport.css') }}">
    <!-- config -->
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
    <!-- font material ++ -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,500;1,500&display=swap"
        rel="stylesheet">
</head>

<body class="text-bg-blue-dark h-[100vh] overflow-y-auto m-5 mt-6">
    <!-- nav -->
    @include('partials.navbar_admin')

    <!-- head -->
    <header class="flex justify-between px-10 py-5 max-w-[85rem] mx-auto">
        <div>
            <h1
                class="text-2xl font-black before:absolute before:w-20 before:h-10 before:border-solid before:border-bg-blue-dark before:border-b-2">
                Attendance STARBHAK</h1>
            <h2 class="mt-3">Membuat Absensi sekolah menjadi Sistematis dan Efisien</h2>
        </div>
        <div>
            <button
                class="hover:bg-bg-blue-dark hover:text-white px-7 py-1 mt-5 border-bg-blue-dark border-solid border-2 rounded-md font-bold">Dokumentasi</button>
        </div>
    </header>
    <!-- box -->
    <div class="grid grid-cols-4 gap-6 shadow-box p-5 rounded-t-none rounded border-bg-blue-dark border-solid border-t-2 max-w-[85rem] mx-auto" id="box">

    {{-- box --}}

    </div>
    <!-- layout Main -->
    <main class="mt-10 max-w-[85rem] mx-auto">
        <!-- container -->
        <div class="flex justify-between">
            <!-- table data guru -->
            <div class="shadow-box p-5 w-[66%] rounded-2xl border-solid border-[0.1px] border-opacity-5 border-black" id="akun_guru">
                <!-- top table -->
                <div class="flex items-center justify-between">

                    <div class="w-fit">
                        <h1 class="font-bold text-2xl font-[Montserrat]">Data Guru</h1>
                        <p>Kelola akun guru dengan menambah atau mengubah.</p>
                    </div>

                    <div class="flex">
                        {{-- search --}}
                        <form action="">
                            <input id="search_guru" type="text" class=" border-solid border-2 border-dark-data mr-1 mt-0.5 py-1 px-2 rounded-md"
                                placeholder="Cari nama guru">
                        </form>
                        <button
                            class=" px-4  w-[40%] py-1 float-right bg-bg-blue-dark rounded-md text-white font-bold" onclick="location.href = 'admin/guru'">+
                            Guru</button>
                    </div>
                </div>
                <!-- table -->
                <div class="mt-5 h-[50vh] w-full overflow-auto border-bg-blue-dark border-solid border-t-2" >
                    <table class="w-full " cellpadding="2">
                        <!-- header table -->
                        <thead class="font-extrabold bg-white top-0 sticky z-10">
                            <tr class="text-sm text-placeholder">
                                <th class="p-3">No</th>
                                <th class="p-3">Nama</th>
                                <th class="p-3">NIP</th>
                                <th class="p-3">Username</th>
                                <th class="p-3">Password</th>
                                <th class="p-3">Aksi</th>
                            </tr>
                        </thead>
                        <!-- body -->
                        <tbody class="text-center text-base font-bold cursor-pointer select-none" id="data_guru">
                            
                            {{-- table guru --}}

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- tabel data mapel -->
            <div class="w-[33%] shadow-box p-5 rounded-2xl border-solid border-[0.1px] border-opacity-5 border-black" id="data_mapel">
                <div>
                    <h1 class="font-bold text-2xl font-[Montserrat]">Mata Pelajaran</h1>
                    <p>Kelola mata pelajaran untuk guru.</p>
                </div>
                <div class="flex">
                    <form action="" class="mr-20">
                        <input type="text" id="pelajaran" class="border-solid border-2  border-dark-data mr-2 mt-0.5 py-1 px-2 rounded-md"
                            placeholder="Mapel baru">
                    </form>
                    <button
                        class=" w-[34%] px-4  py-2 float-right bg-bg-blue-dark rounded-md text-white font-bold" onclick="mapel_simpan()">+
                        Mapel</button>
                </div>
                <!-- table -->
                <div class="mt-5 h-[50vh] w-full overflow-auto border-bg-blue-dark border-solid border-t-2">
                    <table class="w-full " cellpadding="2">
                        <!-- header table -->
                        <thead class="font-extrabold bg-white top-0 sticky z-10">
                            <tr class="text-sm text-placeholder">
                                <th class="p-3">No</th>
                                <th class="p-3">Mapel</th>
                                <th class="p-3">Aksi</th>
                            </tr>
                        </thead>
                        <!-- body -->
                        <tbody class="text-center text-base font-bold cursor-pointer select-none" id="table_mapel">
                            {{-- table_mapel --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- tabel data murid -->
        <div class="shadow-box mt-5 p-5 w-[66%] rounded-2xl border-solid border-[0.1px] border-opacity-5 border-black">
            <!-- top table -->
            <div class="flex items-center justify-between">
                <div class="w-fit">
                    <h1 class="font-bold text-2xl font-[Montserrat]">Data Siswa</h1>
                    <p>Kelola data siswa.</p>
                </div>
                <div class="flex">
                    <form action="">
                        <input id="search_siswa" type="text" class="border-solid border-2 border-dark-data mr-1 mt-0.5 py-1 px-2 rounded-md"
                            placeholder="Cari nama siswa">
                    </form>
                    
                </div>
            </div>
            <!-- table -->
            <div class="mt-5 h-[50vh] w-full overflow-auto border-bg-blue-dark border-solid border-t-2">
                <table class="w-full " cellpadding="2">
                    <!-- header table -->
                    <thead class="font-extrabold bg-white top-0 sticky z-10">
                        <tr class="text-sm text-placeholder">
                            <th class="p-3">No</th>
                            <th class="p-3">Nama</th>
                            <th class="p-3">Tgl/Lahir</th>
                            <th class="p-3">Jenis Kelamin</th>
                            <th class="p-3">Kelas</th>
                            <th class="p-3">Aksi</th>
                        </tr>
                    </thead>
                    <!-- body -->
                    <tbody class="text-center text-base font-bold cursor-pointer select-none" id="data_siswa">
                        
                        {{-- table siswa --}}

                    </tbody>
                </table>
            </div>
        </div>
    </main>




    <!-- custom alert -->
    <script src="{{ asset('assets/JS/cstkei.alert.js') }}"></script>

        @if (Session::has("success"))
            <script>keiAlert("{{ session()->get('success') }}", 'done', 'bg-[#22c55e]')</script>
        @endif

    <script src="{{ asset('assets/JS/admin.js') }}"></script>



</body>

</html>