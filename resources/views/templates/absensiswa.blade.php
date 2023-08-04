<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Absen | Starbhak Absensi</title>
    <!-- style css -->
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('assets/CSS/suport.css') }}">

    {{-- <script src="{{ url_for('static', filename='js/jquery.min.js') }}"></script> --}}
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
<body class="text-tet" onload="initClock()">

        <!-- navbar top -->
        <div class="px-16 py-4 shadow-nav flex justify-between w-full bg-white z-10 fixed top-0">
            <h1 class="text-xl font-bold text-blue-dark">
                StarBhak</h1>
            <div class="flex">
                <p class="py-1 mr-2 font-semibold">
                    User |</p>
                <button onclick="keiAlert('test')" class="bg-blue-dark text-white px-2 py-1 rounded ">
                    Log Out</button>
            </div>
        </div>
    
        <!-- Sidebar left -->
        <div class="px-14 py-20 shadow-side w-fit h-[100vh] top-16 fixed">
            <a href="/">
                <div class="text-unselect">
                    {{-- <span class="material-symbols-outlined -mb-3 mr-5">home</span> --}}
                    <i class="text-lg fa-regular fa-user -mb-3 mr-5 p-2 rounded-md hover:text-white hover:bg-bg-blue-dark"></i>
                    Dashboard
                </div>
            </a>
            <a href="/absensi">
                <div class="font-semibold mt-10">
                    <i class="text-lg fa-regular fa-file -mb-3 mr-5 p-2 rounded-md hover:text-white hover:bg-bg-blue-dark"></i>
                    {{-- <span class="material-symbols-outlined -mb-3 mr-5">library_books</span> --}}
                    Absen
                </div>
            </a>
            <a href="/datasiswa">
                <div class="mt-10 text-unselect">
                    <i class="text-lg fa-regular fa-folder -mb-3 mr-5 p-2 rounded-md hover:text-white hover:bg-bg-blue-dark"></i>
                    {{-- <span class="material-symbols-outlined -mb-3 mr-5">assignment_ind</span> --}}
                    Data Siswa
                </div>
            </a>
            <div class="mt-10 text-unselect">
                <i class="text-lg fa-regular fa-address-card -mb-3 mr-5 p-2 rounded-md hover:text-white hover:bg-bg-blue-dark"></i>
                {{-- <span class="material-symbols-outlined -mb-3 mr-5">sms_failed</span> --}}
                Laporan
            </div>
        </div>
        <!-- content -->
        <div class="absolute left-72 w-3/4 py-5 px-16">
            <h1 class="text-3xl text-blue font-bold mt-32 font-[Montserrat]">Face Recognition</h1>
            <div class="w-fit ml-5 mt-10">
                <a href="/absensi/{{ $mapels }}/{{ $kelas }}/cam_masuk">
                    <div class="w-fit font-extrabold inline-block border-stroke px-3 py-0.5 rounded-tr-none ml-0 border-2 rounded-t-md border-solid bg-blue text-white">
                        <p>Masuk</p>
                    </div>
                </a>
                <a href="/absensi/{{ $mapels }}/{{ $kelas }}/pulang">
                    <div class="w-fit inline-block font-extrabold float-right border-stroke rounded-tl-none px-3 py-0.5 mr-0 border-2 rounded-t-md border-solid">
                        <p>Pulang</p>
                    </div>
                </a>
            </div>

            <div class="w-full border-stroke p-5 px-7 border-2 rounded-md border-solid flex justify-between relative">
                <div class="w-fit flex">
                    <img src="img/Checklist_Flatline 2.png" class="rounded-lg w-[25%]" alt="Your cam here:3">
                    <div class="mt-[5%]">
                        <h1 class="text-3xl text-blue font-bold font-[Montserrat]">Face Recognition</h1>
                        <p>Silahkan Absen Wajah anda</p>
                    </div>
                </div>
                <!-- side -->
                <div class="w-2/5">
                    <div class="items-center flex flex-col mt-[9%]">
                        <h1 class="text-blue text-3xl font-extrabold" id="jam">
                            <span id="hour">00</span>:
                            <span id="minutes">00</span>:
                            <span id="seconds">00</span>
                        </h1>
                        <p class="text-xs" id="tgl">
                            <span id="dayname">Day</span>,
                            <span id="daynum">00</span>
                            <span id="month">Month</span>
                            <span id="year">Year</span>
                        </p>
                        <a href="/absen_siswa/{{ $mapels }}/{{ $kelas }}/cam_masuk">
                            <button class="bg-blue text-white py-2 px-4 mt-1 rounded-xl w-fit mx-auto font-semibold">Pindai Wajah</button>
                        </a>
                    </div>
                </div>
                <!-- -- -->

            </div>
            <div class="flex justify-between my-10">
                <h1 class="text-3xl text-blue font-bold font-[Montserrat]">Absen XI PPLG 1</h1>
                <div class="-mt-5">
                    <button class="bg-blue text-white py-2 px-4 rounded-xl mt-5 w-fit mx-auto font-semibold">Kirim Ke Telegram!</button>
                    <button class="bg-blue text-white py-2 px-4 rounded-xl mt-5 w-fit mx-auto font-semibold">Ekspor Ke Exel</button>
                </div>
            </div>
            <div class="h-96 overflow-auto mt-8">
                <table class="w-full font-[Montserrat] pb-12">
                    <thead class="text-blue-table bg-white font-extrabold text-xl shadow-stable top-0 sticky z-10">
                        <tr class="">
                            <th class="p-3">NO</th>
                            <th class="p-3">NAMA</th>
                            <th class="p-3">KELAS</th>
                            <th class="p-3">NISN</th>
                            <th class="p-3">MASUK</th>
                        </tr>
                    </thead>
                    <tbody id="totalabsen">
                        <!--  -->
                    </tbody>
                </table>
        </div>
    <!-- custom alert -->
    <script src="assets/JS/cstkei.alert.js"></script>
    <!-- python select method -->
    <script type="text/javascript">
        $(document).ready(function () {
            let lastcnt = 0;
            let cnt;
            chkNewScan();

            function chkNewScan() {
                countTodayScan();
                setTimeout(chkNewScan, 1000);
            }

            function countTodayScan() {
                $.ajax({
                    url: '/countTodayScan',
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        cnt = data.rowcount;
                        if (cnt > lastcnt) {
                            reloadTable();
                        }
                        lastcnt = cnt;
                        console.log('hello')
                    },
                    error: function (result) {
                        console.log('no result!')
                    }
                })
            }

            function reloadTable() {
                $.ajax({
                    url: '/loadData',
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        var tr = $("#totalabsen");
                        tr.empty();
                        $.each(response, function (index, item) {
                            inc = 1
                            if (item.length > 0) {
                                for (let i = 0; i < item.length; i++) {
                                    tr.append('<tr class="text-center border-tet-x border-t-0 border-l-0 border-r-0 border-[1px] border-solid hover:font-bold cursor-pointer p-3">' +
                                        '<td class="p-3">' + inc + '</td>' +
                                        '<td class="p-3">' + item[i][2] + '</td>' +
                                        '<td class="p-3">' + item[i][3] + '</td>' +
                                        '<td class="p-3">' + item[i][4] + '</td>' +
                                        '<td class="p-3">' + item[i][5] + '</td>' +                                    
                                    '</tr>');
                                    inc++
                                }
                            }
                        });
                    },
                    error: function (result) {
                        console.log('no result!')
                    }
                });
            }
        });
    </script>
    <script type="text/javascript">
        function updateClock() {
            var now = new Date();
            var dname = now.getDay(),
                mo = now.getMonth(),
                dnum = now.getDate(),
                yr = now.getFullYear(),
                hou = now.getHours(),
                min = now.getMinutes(),
                sec = now.getSeconds();
        
                if(hou == 0) {
                    hou = 24;
                }
                if(hou > 24) {
                    hou = hou - 24;
                }
                
                Number.prototype.pad = function(digits) {
                    for(var n = this.toString(); n.length < digits; n = 0 + n);
                    return n;
                }
                
                var months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
                var week = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"];
                var ids = ["dayname", "month", "daynum", "year", "hour", "minutes", "seconds"];
                var values = [week[dname], months[mo], dnum.pad(2), yr.pad(2), hou.pad(2), min.pad(2), sec.pad(2)];
                for(var i = 0; i < ids.length; i++)
                document.getElementById(ids[i]).firstChild.nodeValue = values[i];
        }
        
        function initClock() {
            updateClock();
            window.setInterval("updateClock()", 1);
        }
    </script> 
</body>

</html>
