<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/img/title_logo.png') }}">
    <title>Dokumentasi | Starbhak Absensi</title>
    <!-- style css -->
    <link rel="stylesheet" href="{{ asset('assets/CSS/output.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/suport.css') }}">
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Quicksand:wght@600;700&display=swap"
        rel="stylesheet">
    <!-- config -->
    @vite('resources/css/app.css')

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
    @include('partials.navbar_admin')
    <div class="w-3/4 mx-auto mt-32">
        <h1 class="text-3xl font-bold w-fit font-[Montserrat] mx-auto">Dokumentasi<div class="bg-bg-blue-dark w-3/4 h-1 rounded mx-auto"></div></h1>
        <!-- nav -->
        <div class="border-solid border-b-2 border-bg-blue-dark mt-5 p-5">
            <div class="grid grid-cols-3 xl:gap-10 xl:w-2/5 md:text-base w-full text-sm md:gap-14 md:w-[50%] gap-5 mx-auto items-center font-medium">
                <div class="cursor-pointer bg-bg-blue-dark text-white rounded text-center font-semibold menu activeMenu"><p class="p-1" onclick="navigate('admin', this)">Admin</p></div>
                <div class="cursor-pointer text-center menu" ><p class="p-1" onclick="navigate('pinoBot', this)">Pino Bot</p></div>
                <div class="cursor-pointer text-center menu" ><p class="p-1" onclick="navigate('aboutUs', this)">About Us</p></div>
            </div>
        </div>
        <div class="p-10 pt-5">

            <!-- admin -->
            <div id="admin" style="display: block; opacity: 1;" class="activeMenuInfo">
                <div class="mt-5">
                    <h1 class="font-[Montserrat] text-xl"># Admin</h1>
                    <p>Admin dapat melakukan banyak hal, mengedit dan menghapus data siswa, menambahkan mata pelajaran baru, menambah grup telegram, menambahkan kelas, dan admin dapat mengubah, menghapus, atau menambahkan data guru.</p>
                </div>
                <div class="mt-5">
                    <h1 class="font-[Montserrat] text-xl"># Menambahkan Kelas Baru</h1>
                    <p>Admin dapat menambahkan data kelas baru melalui halaman <span class="px-2 py-1 mx-1.5 bg-[#ECECEC] rounded">Telegram Bot</span> dengam menekan tombol <span class="border-b-[1.5px] border-solid border-bg-blue-dark text-dark-data"><a href="#" target="_blank"><i>Add Group</i></a></span></p>
                </div>
                <div class="mt-5">
                    <h1 class="font-[Montserrat] text-xl"># Menambahkan Murid Baru</h1>
                    <p>Setelah kelas baru terbuat, maka kelas akan tampil pada halaman  <span class="px-2 py-1 mx-1.5 bg-[#ECECEC] rounded">Daftar Kelas</span>, pada halaman ini anda dapat menambahkan, mengedit, dan menghapus data murid dari kelas yang dipilih</p>
                </div>
            </div>
            <!-- pinobot -->
            <div id="pinoBot" style="display: none; opacity: 0;" class="off">
                <div class="mt-5">
                    <h1 class="font-[Montserrat] text-xl"># Pino Bot</h1>
                    <p>Pino Bot adalah bot telegram yang sudah terintegrasi dengan sistem database yang dapat membantu kegiatan layanan informasi pendidikan SMK Taruna Bhakti</p>
                </div>
                <div class="mt-5">
                    <h1 class="font-[Montserrat] text-xl"># Kegunaan Pino Bot</h1>
                    <ul>
                        <li>Mengambil laporan absensi murid</li>
                        <li>Mengupdate status kehadiran siswa</li>
                        <li>DLL</li>
                    </ul>
                </div>
                <div class="mt-5">
                    <h1 class="font-[Montserrat] text-xl"># Admin Bot</h1>
                    <p>Admin Bot adalah bot telegram yang menjadi administrator dan mengolah data admin dari Pino Bot yang akan membantu kegiatan layanan informasi pendidikan SMK Taruna Bhakti</p>
                </div>
            </div>

            <!--- About Us --->
            <div id="aboutUs" style="display: none; opacity: 0;" class="off">
                <div class="mt-5">
                    <h1 class="font-[Montserrat] text-xl"># Pino Bot</h1>
                    <p>Pino Bot adalah bot telegram yang sudah terintegrasi dengan sistem database yang dapat membantu kegiatan layanan informasi pendidikan SMK Taruna Bhakti</p>
                </div>
                <div class="mt-5">
                    <h1 class="font-[Montserrat] text-xl"># Kegunaan Pino Bot</h1>
                    <ul>
                        <li>Mengambil laporan absensi murid</li>
                        <li>Mengupdate status kehadiran siswa</li>
                        <li>DLL</li>
                    </ul>
                </div>
                <div class="mt-5">
                    <h1 class="font-[Montserrat] text-xl"># Admin Bot</h1>
                    <p>Admin Bot adalah bot telegram yang menjadi administrator dan mengolah data admin dari Pino Bot yang akan membantu kegiatan layanan informasi pendidikan SMK Taruna Bhakti</p>
                </div>
            </div>


        </div>
    </div>
    <script>
        function navigate(type, __self){
            document.getElementsByClassName('activeMenuInfo')[0].style.display = 'none'
            document.getElementsByClassName('activeMenuInfo')[0].classList.remove('activeMenuInfo')
            document.getElementById(type).classList.add('activeMenuInfo')
            document.getElementById(type).style.display = 'block'
            document.getElementById(type).style.opacity = 1
            
            if(document.getElementById(type).classList.contains('off')) document.getElementById(type).classList.remove('off')

            document.getElementsByClassName('activeMenu')[0].classList.remove("bg-bg-blue-dark")
            document.getElementsByClassName('activeMenu')[0].classList.remove("text-white")
            document.getElementsByClassName('activeMenu')[0].classList.remove("rounded")
            document.getElementsByClassName('activeMenu')[0].classList.remove("activeMenu")
            __self.classList.add("bg-bg-blue-dark")
            __self.classList.add("text-white")
            __self.classList.add("rounded")
            __self.classList.add("activeMenu")
            
        }
    </script>
</body>

</html>