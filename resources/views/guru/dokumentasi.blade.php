<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        const runColorMode = (fn) => {
            if (!window.matchMedia) {
                return;
            }

            const query = window.matchMedia('(prefers-color-scheme: dark)');

            fn(query.matches);

            query.addEventListener('change', (event) => fn(event.matches));
        }

        runColorMode((isDarkMode) => {
            if (isDarkMode) {
                document.head.innerHTML = '<link rel="icon" href="{{ asset('assets/img/title_logo_light.png') }}">'
            } else {
                document.head.innerHTML = '<link rel="icon" href="{{ asset('assets/img/title_logo_dark.png') }}">'
            }
        })
    </script>
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
    <script src="https://cdn.tailwindcss.com"></script>
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

<body>
    @include('partials.navbar')
    <div class="sm:w-3/4 w-11/12 mx-auto mt-32">
        <h1 class="xl:text-3xl lg:text-2xl text-lg md:text-xl text-lg font-bold w-fit font-[Montserrat] mx-auto">Dokumentasi<div class="bg-bg-blue-dark w-3/4 h-1 rounded mx-auto"></div></h1>
        <!-- nav -->
        <div class="border-solid border-b-2 border-bg-blue-dark mt-5 sm:p-5">
            <div class="grid grid-cols-4 xl:gap-20 xl:w-2/3 md:text-base w-full text-sm md:gap-14 md:w-[65%] gap-5 mx-auto items-center font-medium">
                <div class="cursor-pointer bg-bg-blue-dark text-white rounded text-center font-semibold menu activeMenu"><p class="p-1" onclick="navigate('profil', this)">Profil</p></div>
                <div class="cursor-pointer text-center menu" ><p class="p-1" onclick="navigate('dashboard', this)">Dashboard</p></div>
                <div class="cursor-pointer text-center menu" ><p class="p-1" onclick="navigate('absensi', this)">Data Absen</p></div>
                <div class="cursor-pointer text-center menu" ><p class="p-1" onclick="navigate('dataKelas', this)">Data Kelas</p></div>
                <!--<div class="cursor-pointer text-center menu" ><p class="p-1" onclick="navigate('pinoBot', this)">Pino Bot</p></div>-->
            </div>
        </div>
        <div class="ms:p-10 p-1 pt-5">
            <!-- profil -->
            <div id="profil" style="opacity: 1;" class="activeMenuInfo">
                <div class="mt-5">
                    <h1 class="font-[Montserrat] text-lg md:text-xl"># Profil</h1>
                    <p>Di dalam halaman profil anda dapat mengatur kelas dan mata pelajaran sesuai dengan  kelas yang anda ajar </p>
                </div>
                <div class="mt-5">
                    <h1 class="font-[Montserrat] text-lg md:text-xl"># Profil Tetap</h1>
                    <p>Anda tidak dapat mengatur profil anda secara manual di halaman <span class="px-2 py-1 mx-1.5 bg-[#ECECEC] rounded">Profil</span>, Beberapa atribut tidak dapat diatur secara manual, hal ini dikarenakan untuk kepentingan sekuritas keamanan data. Anda tetap dapat mengubah seluruh profil anda dengan menghubungi admin secara langsung</p>
                </div>
                <div class="mt-5">
                    <h1 class="font-[Montserrat] text-lg md:text-xl"># Profil Yang Dapat Diedit</h1>
                    <p>Atribut yang dapat diubah di dalam halaman profil adalah mata pelajaran dan kelas, untuk mengubah profil yang sebelumnya sudah pernah diubah maka tekan tombol <span class="px-2 py-1 mx-1.5 bg-[#ECECEC] rounded">Reset</span>, mata pelajaran dan kelas anda akan di reset seperti semula dan dapat anda atur kembali sesuai dengan kebutuhan</p>
                </div>
            </div>
            <!-- dashboard -->
            <div id="dashboard" style="display: none; opacity: 0;" class="off">
                <div class="mt-5">
                    <h1 class="font-[Montserrat] text-lg md:text-xl"># Dashboard</h1>
                    <p>Dalam halaman <span class="px-2 py-1 mx-1.5 bg-[#ECECEC] rounded">Dashboard</span> terdapat fitur <i>quick preview</i>, Hal ini dapat memudahkan anda dalam melakukan navigasi ke halaman lainnya. Anda juga dapat melihat data absen yang paling terbaru  <a href="https://ibb.co/0m7xY2Y" target="_blank"><span class="border-b-[1.5px] border-solid border-bg-blue-dark text-dark-data"><i>(latest attendance)</i></span></p></a>
                </div>
            </div>
            <!-- absensi -->
            <div id="absensi" style="display: none; opacity: 0;" class="off">
                <div class="mt-5">
                    <h1 class="font-[Montserrat] text-lg md:text-xl"># Absensi</h1>
                    <p>Sebelum melakukan pengabsenan, anda dapat menentukan mata pelajaran dan kelas di halaman <span class="px-2 py-1 mx-1.5 bg-[#ECECEC] rounded">Tambahkan Jadwal</span> sesuai dengan kemauan anda, anda juga dapat menghapus jadwal apabila terjadi kesalahan dalam pemilihan mata pelajaran ataupun kelas. Anda tidak dapat membuat jadwal dengan kelas dan mata pelajaran yang sama lebih dari satu kali di hari yang sama</p>
                </div>
                <div class="mt-5">
                    <h1 class="font-[Montserrat] text-lg md:text-xl"># Export Data Ke Excel</h1>
                    <p>Di dalam halaman <span class="px-2 py-1 mx-1.5 bg-[#ECECEC] rounded">Absen</span>  terdapat ikon <span class="border-b-[1.5px] border-solid border-bg-blue-dark text-dark-data"><a href="https://ibb.co/VW1yZgS" target="_blank"><i>download</i></a></span> di setiap baris kelas, anda dapat mengeksport data absen ke bentuk excel. Eksport excel dapat dilakukan ketika sesi absen sudah berakhir</p>
                </div>
                <div class="mt-5">
                    <h1 class="font-[Montserrat] text-lg md:text-xl"># Hapus Jadwal Absen</h1>
                    <p>Anda dapat menghapus data absen apabila terjadi kesalahan dalam penginputan waktu atau permasalahan yang lainnya dengan menekan tombol <span class="border-b-[1.5px] border-solid border-bg-blue-dark text-dark-data"><a href="https://ibb.co/XZ2zN40" target="_blank">hapus</a></span></p>
                </div>
                <div class="mt-5">
                    <h1 class="font-[Montserrat] text-lg md:text-xl"># Absensi Otomatis Dengan Face Recognition</h1>
                    <p>Sistem absen otomatis starbhak attendance menerapkan sistem <span class="font-semibold">Face Recognition</span> atau pengenalan wajah, absen sudah berhasil dilakukan hanya dengan berdiri di depan kamera. Untuk memulai Face Recognition anda dapat mengakses halaman dengan tombol <span class="border-b-[1.5px] border-solid border-bg-blue-dark text-dark-data"><a href="https://ibb.co/QckJFQ8" target="_blank">berikut</a></span> di halaman<span class="px-2 py-1 mx-1.5 bg-[#ECECEC] rounded">Absensi</span> <i>Face drawing</i> dapat diakses ketika layar webcam sudah tampil, anda dapat mengklik layar untuk mengaktifkan Face Drawing, berikut ini adalah contoh <span class="border-b-[1.5px] border-solid border-bg-blue-dark text-dark-data"><a href="https://ibb.co/x6M7Gxm" target="_blank">halaman absen yang sudah aktif</a></span></p>
                </div>
                <div class="mt-5">
                    <h1 class="font-[Montserrat] text-lg md:text-xl"># Absensi Manual</h1>
                    <p>Selain absen otomatis menggunakan <i>Face Recognition</i>, anda juga dapat melakukan absensi dengan cara <span class="border-b-[1.5px] border-solid border-bg-blue-dark text-dark-data"><a href="https://ibb.co/9qjnYBs" target="_blank">Manual.</a></span> Hal ini memudahkan pengguna dalam menetapkan status dan keterangan siswa</p>
                </div>
                <div class="mt-5">
                    <h1 class="font-[Montserrat] text-lg md:text-xl"># Kirim Laporan Ke Telegram</h1>
                    <p>Pada halaman ini anda dapat mengirim laporan kehadiran ke telegram, anda harus melengkapi form di dalam halaman ini, anda dapat mengakses halaman ini dengan menekan tombol <span class="border-b-[1.5px] border-solid border-bg-blue-dark text-dark-data"><a href="https://ibb.co/jGTfHv0" target="_blank">Kirim Ke Telegram</a></span></p>
                    <br>
                </div>
            </div>
            <!-- data kelas -->
            <div id="dataKelas" style="display: none; opacity: 0;" class="off">
                <div class="mt-5">
                    <h1 class="font-[Montserrat] text-lg md:text-xl"># Data Kelas</h1>
                    <p>Di dalam halaman data kelas, anda dapat meninjau semua kelas yang anda pilih di halaman <span class="px-2 py-1 mx-1.5 bg-[#ECECEC] rounded">Profile</span>. Anda juga dapat melihat kelas secara lebih rinci dengan mengklik tombol <a href="https://ibb.co/nw4qXTH" target="_blank"><span class="border-b-[1.5px] border-solid border-bg-blue-dark text-dark-data">Detail</span></a></p>
                </div>
                <div class="mt-5">
                    <h1 class="font-[Montserrat] text-lg md:text-xl"># Detail Siswa</h1>
                    <p>Halaman ini berisi data murid berdasarkan kelas yang dimiliki murid masing-masing</p>
                </div>
                <div class="mt-5">
                    <h1 class="font-[Montserrat] text-lg md:text-xl"># Pendaftaran Data Siswa</h1>
                    <p>Guru tidak dapat mendaftarkan murid secara langsung, pendaftaran dan pengubahan data murid dapat dilakukan di halaman admin</p>
                </div>    
            </div>

            <!-- admin -->
            <div id="admin" style="display: none; opacity: 0;" class="off">
                <div class="mt-5">
                    <h1 class="font-[Montserrat] text-lg md:text-xl"># Admin</h1>
                    <p>Admin dapat melakukan banyak hal, mengedit dan menghapus data siswa, menambahkan mata pelajaran baru, menambah grup telegram, menambahkan kelas, dan admin dapat mengubah, menghapus, atau menambahkan data guru.</p>
                </div>
            </div>
            <!-- pinobot -->
            <div id="pinoBot" style="display: none; opacity: 0;" class="off">
                <div class="mt-5">
                    <h1 class="font-[Montserrat] text-lg md:text-xl"># Pino Bot</h1>
                    <p>Pino Bot adalah bot telegram yang sudah terintegrasi dengan sistem database yang dapat membantu kegiatan layanan informasi pendidikan SMK Taruna Bhakti</p>
                </div>
                <div class="mt-5">
                    <h1 class="font-[Montserrat] text-lg md:text-xl"># Kegunaan Pino Bot</h1>
                    <ul>
                        <li>Mengambil laporan absensi murid</li>
                        <li>Mengupdate status kehadiran siswa</li>
                        <li>DLL</li>
                    </ul>
                </div>
                <div class="mt-5">
                    <h1 class="font-[Montserrat] text-lg md:text-xl"># Admin Bot</h1>
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