<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cam Session | Starbhak Absensi</title>
</head>

<body>
        <!-- style css -->
        <link rel="stylesheet" href="{{ asset('assets/CSS/output.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/CSS/suport.css') }}">
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- config -->
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            'blue-dark': '#1061FF',
                            'blue-table': '#002C9D',
                            'blue': '#349DFD',
                            'tet': '#001458',
                            'unselect': '#BAC5E7',
                            'tet-x': '#5A5A5A',
                            'stroke': '#81B7E9',
                        },
                        boxShadow: {
                            nav: '2px 2px 50px 1px rgba(179, 185, 191, 0.1);',
                            side: ' 0px 5px 10px rgba(0, 0, 0, 0.05);',
                        }
                    },
                }
            }
        </script>
        <!-- font material ++ -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"/> <link rel="preconnect" href="https://fonts.googleapis.com"> <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,500;1,500&display=swap"rel="stylesheet">
    </head>
    
    <body class="text-tet">
        <!-- navbar top -->
        <div class="px-16 py-4 shadow-nav flex justify-between w-full bg-white z-10 fixed top-0">
            <h1 class="text-xl font-bold text-blue-dark">
                StarBhak</h1>
            <div class="flex">
                <p class="py-1 mr-2 font-semibold">
                    {{ auth()->guard("user")->user()->username }} |</p>
                <button onclick="keiAlert('test')" class="bg-blue-dark text-white px-2 py-1 rounded ">
                    Log Out</button>
            </div>
        </div>
    
        <!-- Sidebar left -->
        <div class="px-14 py-20 shadow-side w-fit h-[100vh] top-16 fixed">
            <a href="/">
                <div class="text-unselect"><span class="material-symbols-outlined -mb-3 mr-5">home</span>
                    Dashboard
                </div>
            </a>
            <a href="/absensi">
                <div class="font-semibold mt-10"><span class="material-symbols-outlined -mb-3 mr-5">library_books</span>
                    Absen
                </div>
            </a>
            <a href="/data_siswa">
                <div class="mt-10 text-unselect"><span class="material-symbols-outlined -mb-3 mr-5">assignment_ind</span>
                    Data Siswa
                </div>
            </a>
            <div class="mt-10 text-unselect"><span class="material-symbols-outlined -mb-3 mr-5">sms_failed</span>
                Laporan
            </div>
        </div>
        <!-- content -->
        <div class="absolute left-72 w-3/4 py-5 px-16">
            <h1 class="text-3xl text-blue font-bold mt-32 font-[Montserrat]">Absen Masuk</h1>
            <div class="col-md-8 " style="margin-top: 10%;">
                <img src="{{ url('absensi/siswa_masuk/cam_masuk') }}" width="100%" class="img-thumbnail">
            </div>
            <div>
                <p>total absen hari ini</p>
                <h1 id="countabsen">0</h1>
            </div>
            <a href="{{ redirect('/absensi/siswa_masuk/XI%20PPLG%201/PBO') }}">
                <button class="bg-blue text-white py-2 px-4 mt-1 rounded-xl w-fit mx-auto font-semibold">Akhiri Absen</button>
            </a>
        </div>
    <!-- custom alert -->
    <script src="{{ asset('assets/JS/cstkei.alert.js') }}"></script>
</body>
</html>