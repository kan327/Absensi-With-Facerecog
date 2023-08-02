<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Starbhak Absensi</title>
    <!-- style css -->
    <link rel="stylesheet" href="../static/assets/CSS/output.css">
    <link rel="stylesheet" href="../static/assets/CSS/suport.css">
    @vite('resources/css/app.css')

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
                User |</p>
            <button class="bg-blue-dark text-white px-2 py-1 rounded ">
                Log Out</button>
        </div>
    </div>

    <!-- Sidebar left -->
    <div class="px-14 py-20 shadow-side w-fit h-[100vh] top-16 fixed">
        <a href="/">
            <div class="font-semibold mt-10"><span class="material-symbols-outlined -mb-3 mr-5">home</span>
                Dashboard
            </div>
        </a>
        <a href="/absensiswa">
            <div class="mt-10 text-unselect"><span class="material-symbols-outlined -mb-3 mr-5">library_books</span>
                Absen
            </div>
        </a>
        <a href="/datasiswa">
            <div class="mt-10 text-unselect"><span class="material-symbols-outlined -mb-3 mr-5">assignment_ind</span>
                Data Siswa
            </div>
        </a>
        <div class="mt-10 text-unselect"><span class="material-symbols-outlined -mb-3 mr-5">sms_failed</span>
            Laporan
        </div>
    </div>

    <!-- content -->
    <div class="absolute left-72 w-3/4">
        <h1 class="text-3xl text-blue font-bold mt-32 font-[Montserrat]">Hai, Erraldo!</h1>
        <div class="mt-10 flex w-full justify-evenly">
            <!-- box 1 session -->
            <div
                class="border-stroke hover:bg-blue hover:text-white border-2 border-solid p-6 rounded-md w-[28%] flex justify-between">
                <div>
                    <h3 class="font-semibold text-sm">Sesi Aktif</h3>
                    <h2 class="text-xl font-extrabold">XI-PPLG 1</h2>
                </div>
                <int class="font-bold text-2xl mt-2">Masuk</int>
            </div>
            <!-- box 2 -->
            <div
                class="border-stroke hover:bg-blue hover:text-white border-2 border-solid p-6 rounded-md w-[28%] flex justify-between">
                <div>
                    <h3 class="font-semibold text-sm">Jadwal</h3>
                    <h2 class="text-xl font-extrabold">Mata Pelajaran</h2>
                </div>
                <int class="font-bold"><span class="material-symbols-outlined" style="font-size: 40px;">add_box</span>
                </int>
            </div>
            <!-- box 3 -->
            <div
                class="border-stroke hover:bg-blue hover:text-white border-2 border-solid p-6 rounded-md w-[28%] flex justify-between web-hover">
                <div>
                    <h3 class="font-semibold text-sm">Total</h3>
                    <h2 class="text-xl font-extrabold">Kelas Anda!</h2>
                </div>
                <int class="font-bold text-sm mt-2 h-10 w-[80px] overflow-y-auto overflow-x-hidden">
                    XI PPLG 1, <br> XI MM 2, <br> XI TEI 2, <br> XI TKJ 1, <br> XI BC 1</int>
            </div>
            <!-- -- -->
        </div>
        <!-- contains 2 big box -->
        <div class="mt-10 flex w-full justify-evenly">
            <!-- box 1 bio -->
            <div class="border-stroke border-2 border-solid p-6 rounded-md w-[44%]">
                <h1 class="text-xl font-extrabold">Data Diri</h1>
                <div class="flex w-full justify-between"> 
                    <table class="font-medium mt-5">
                        <tr>
                            <td>NIP </td>
                            <td> :</td>
                            <td class="break-words max-w-[150px]">08649234</td>
                        </tr>
                        <tr>
                            <td>Nama </td>
                            <td> :</td>
                            <td class="break-words max-w-[150px]">User</td>
                        </tr>
                        <tr>
                            <td>No. Telepon </td>
                            <td> :</td>
                            <td class="break-words max-w-[150px]">0812345678</td>
                        </tr>
                        <tr>
                            <td>Email </td>
                            <td> :</td>
                            <td class="break-words max-w-[150px]">alamat@gmail.com</td>
                        </tr>
                    </table>
                    <img src="../static/assets/img/image54.jpg" class="rounded-lg max-w-[25%]" alt="Your profile :3">
                </div>

            </div>
            <!-- box 2 -->
            <div class="border-stroke border-2 border-solid p-3 flex flex-col rounded-md w-[44%]">
                <h1 class="text-xl font-extrabold w-fit mx-auto">Absen Terbaru</h1>
                <div class="h-[165px] w-full overflow-y-auto overflow-x-hidden">
                    <!-- table -->
                    <table class="w-full ">
                        <thead class="table-fixed top-0 sticky z-10 bg-white">
                            <tr class="border-blue-dark border-t-0 border-l-0 border-r-0 border-[1px] border-solid">
                                <th>No</th>
                                <th>Name</th>
                                <th>Kelas</th>
                                <th>Masuk</th>
                                <th>pulang</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-tet-x text-tet-x border-t-0 border-l-0 border-r-0 border-[1px] border-solid hover:text-blue hover:border-blue cursor-pointer">
                                <th>1</th>
                                <th class="break-words max-w-[147px]">Jayeesh Patel</th>
                                <th>XI - PPLG 1</th>
                                <th>07.45</th>
                                <th>07.45</th>
                            </tr>
                            <tr class="border-tet-x text-tet-x border-t-0 border-l-0 border-r-0 border-[1px] border-solid hover:text-blue hover:border-blue cursor-pointer">
                                <th>2</th>
                                <th class="break-words max-w-[147px]">Arsrhi Sadhu</th>
                                <th>XI - PPLG 1</th>
                                <th>07.45</th>
                                <th>07.45</th>
                            </tr>
                            <tr class="border-tet-x text-tet-x border-t-0 border-l-0 border-r-0 border-[1px] border-solid hover:text-blue hover:border-blue cursor-pointer">
                                <th>3</th>
                                <th class="break-words max-w-[147px]">Manoj Sharma</th>
                                <th>XI - PPLG 1</th>
                                <th>07.45</th>
                                <th>07.45</th>
                            </tr>
                            <tr class="border-tet-x text-tet-x border-t-0 border-l-0 border-r-0 border-[1px] border-solid hover:text-blue hover:border-blue cursor-pointer">
                                <th>4</th>
                                <th class="break-words max-w-[147px]">Ali Sardha</th>
                                <th>XI - PPLG 1</th>
                                <th>07.45</th>
                                <th>07.45</th>
                            </tr>
                            <tr class="border-tet-x text-tet-x border-t-0 border-l-0 border-r-0 border-[1px] border-solid hover:text-blue hover:border-blue cursor-pointer">
                                <th>5</th>
                                <th class="break-words max-w-[147px]">Aneetha Karthee</th>
                                <th>XI - PPLG 1</th>
                                <th>07.45</th>
                                <th>07.45</th>
                            </tr>
                            <tr class="border-tet-x text-tet-x border-t-0 border-l-0 border-r-0 border-[1px] border-solid hover:text-blue hover:border-blue cursor-pointer">
                                <th>6</th>
                                <th class="break-words max-w-[147px]">Aditya Jhotha</th>
                                <th>XI - PPLG 1</th>
                                <th>07.45</th>
                                <th>07.45</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- -- -->
        </div>
    </div>
    </div>
    <!-- custom alert -->
    <script src="../static/assets/JS/cstkei.alert.js"></script>
</body>

</html>


<!-- npx tailwindcss -i ./src/input.css -o ./public/assets/css/output.css --watch -->