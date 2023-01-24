@extends('main_guru')

@section('content')
    <!-- content -->
    <div class="absolute vp-860:left-72 sm:pl-10 vp-860:pr-20 vp-860:pl-10 pr-2 pl-2 sm:pr-10 vp-860:w-3/4 w-[100vw] //lgs:bg-black //bg-transparent mx-auto max-w-7xl">
        <!-- head -->
        <div class="relative w-[100%] rounded-md top-20 sm:p-5 p-3 bg-green-300">
            <h1 class="text-lg md:text-xl font-black font-[Montserrat]">Your message here</h1>
            <p>and here some warning or something else</p>
        </div>
        <div class="flex lg:flex-row flex-col mt-32 mb-20 mx-auto text-bg-blue-dark">
            <!-- left side -->
            <div
                class="shadow-box font-[Montserrat] lg:w-2/3 xl:w-1/2 w-full  sm:p-8 p-3 rounded-lg border-solid border-[0.1px] border-opacity-5 border-[#81B7E980]">
                <div>
                    <h1 class="text-lg md:text-xl font-bold">Absensi</h1>
                    <p>Kelola data absensi hari ini.</p>
                    <div class="flex mt-2 mb-8 border-bg-blue-dark border-solid border-t-2 justify-between">
                        <div>
                            <p class="font-medium font-[Montserrat]">Mulai Absen</p>
                            <int>{{ \Carbon\Carbon::createFromFormat('G:i:s', $data_jadwals->mulai)->format('g:i A') }}</int>
                        </div>
                        <div>
                            <p class="font-medium font-[Montserrat]">Batas Absen</p>
                            <int>{{ \Carbon\Carbon::createFromFormat('G:i:s', $data_jadwals->batas_hadir)->format('g:i A') }}</int>
                        </div>
                        <div>
                            <p class="font-medium font-[Montserrat]">Selesai Absen</p>
                            <int>{{ \Carbon\Carbon::createFromFormat('G:i:s', $data_jadwals->selesai)->format('g:i A') }}</int>
                        </div>
                    </div>
                    <button @if($data_jadwals->batas_hadir > $time_now) onclick="location.href = '/absen_siswa/{{ $tanggals }}/{{ $kelas }}/{{ $mapels }}/cam_masuk'"@else onclick="validate('Kamera Masuk Sudah Ditutup!')" @endif class="py-1.5 px-3.5 bg-bg-blue-dark rounded-md text-white" id="btn_masuk">Masuk</button>
                    <button onclick="location.href = '/absen_siswa/{{ $tanggals }}/{{ $kelas }}/{{ $mapels }}/cam_pulang'"
                        class="py-1 px-3 border-bg-blue-dark border-solid border-2 box-border rounded-md" id="btn_pulang">Pulang</button>
                    <p class="mt-4">Mohon ubah sesi sesuai pada waktunya.</p>
                </div>
            </div>
            <!-- right side -->
            <div class="xl:w-1/2 w-full lg:w-[44%] lg:ml-3 lg:gap-y-0 gap-y-10 lg:mt-0 mt-5" id="box_absen_keterangan">

            </div>
        </div>
        <!-- tag -->
        <div class="flex my-5 justify-between sm:flex-row flex-col">
            <h1 class="text-lg sm:text-xl md:text-2xl mt-2 font-bold text-blue-normal-19 font-[Montserrat]">Daftar Absensi | {{ $data_kelas->first()->kelas }}
            </h1>
            <button class="sm:px-4 sm:py-3 px-2 py-2 bg-bg-blue-dark rounded-xl text-white font-bold"  onclick="location.href = '/absen_siswa/{{ $tanggals }}/{{ $kelas }}/{{ $mapels }}/kirim_telegram'">Kirim Ke Telegram</button>
        </div>
        <!-- main -->
        <div
            class="shadow-box p-8 mx-auto rounded-2xl border-solid border-[0.1px] border-opacity-5 border-[#81B7E980]">
            <!-- table -->
            <div class="h-[50vh] w-full overflow-auto" id="table_absen">

            </div>
            <!-- control manual -->
            <div class="border-blue border-solid border-t-2 flex justify-between sm:flex-row flex-col sm:items-start items-center text-sm">
                <!-- leftbar -->
                <div class="font-[Montserrat] sm:w-1/3 w-full lg:min-w-[268px] min-w-[255px] mt-10 mx-5 sm:items-start items-center">
                    <h1 class="font-semibold text-blue-normal-19">Set Centang</h1>
                    <p class="text-dark-data my-4">Atur keterangan Centang</p>
                    <!-- radio -->
                    <div class="flex lg:ml-5">
                        <div class="mr-3">
                            <div class="flex content-center">
                                <input class="mr-2 option-input radio" value ="Alpha" type="radio" name="ket" id="a">
                                <label for="a" class="label-radio">Alpha</label>
                            </div>
                            <div class="flex content-center">
                                <input class="mr-2 option-input radio" value="Hadir" type="radio" name="ket" id="h">
                                <label for="h" class="label-radio">Hadir</label>
                            </div>
                        </div>
                        <div class="mr-3">
                            <div class="flex content-center">
                                <input class="mr-2 option-input radio" value="Terlambat" type="radio" name="ket" id="t">
                                <label for="t" class="label-radio">terlambat</label>
                            </div>
                            <div class="flex content-center">
                                <input class="mr-2 option-input radio" value="Sakit" type="radio" name="ket" id="s">
                                <label for="s" class="label-radio">sakit</label>
                            </div>
                        </div>
                        <input class="mr-2 option-input radio" value="Izin" type="radio" name="ket" id="i">
                        <label for="i" class="label-radio">Izin</label>
                    </div>
                    <!-- confirm -->
                    <p class="py-4">Pastikan untuk tidak salah pilih!</p>
                    <button class="bg-bg-blue-dark sm:px-4 sm:py-2 px-3 py-1.5 rounded-xl text-white font-bold" onclick="save()">Simpan
                        Perubahan</button>
                </div>
                <!-- rightbar -->
                <div class="sm:w-1/2 w-full sm:max-w-[300px] m-x-5 sm:mt-14 mt-2">
                    <div class="flex sm:justify-between sm:mb-0 mb-3">
                        <button
                            class="sm:px-4 px-2 py-0.5 sm:py-1 sm:mr-0 mr-2 border-2 border-solid border-blue-normal-19 text-blue-dark-10 rounded-lg font-bold" id="btn_tutup_absen" onclick="tutup_absen()">Tutup
                            Absen</button>
                        <button class="bg-bg-blue-dark px-2 py-1 sm:px-4 sm:py-2 rounded-lg text-white font-bold" onclick="pulang()" id="pulangkan">Pulangkan</button>
                    </div>
                    <li class="text-dark-data text-sm my-1">*Tutup absen akan membuat seluruh siswa yang belum
                        memiliki keterangan sebagai belum hadir</li>
                    <li class="text-dark-data text-sm">*Pulangkan adalah tombol untuk memulangkan siswa yang di
                        pilih. </li>
                </div>
            </div>
        </div>
    </div>

    
    <!-- <script>
        function selectRow(any, me) {
            if (me.checked) {
                document.getElementById(any).classList.add("active")
            } else {
                document.getElementById(any).classList.remove("active")
            }
        }
    </script> -->

    <script src="{{ asset('assets/JS/guru.js') }}"></script>

    <script>
        var batas_hadir = {{ Js::from($data_jadwals->batas_hadir) }}
        var time_now = {{ Js::from($time_now) }}       
        
        var tutup = setInterval(() => {

            if(batas_hadir <= time_now){
                tutup_absen()
                clearInterval(tutup)
            }
        }, 100);

        $(document).ready(function() {
            box_absen_ket()
            table_absen()
        })

        // disabled camera
        var btn_masuk = document.getElementById("btn_masuk")
        var btn_pulang = document.getElementById("btn_pulang")
            
 
        // menampilkan live status siswa
        function box_absen_ket() {
            $.get("/absen_siswa/{{ $tanggals }}/{{ $kelas }}/{{ $mapels }}/box_ket", {}, function(data,
                status) {
                $("#box_absen_keterangan").html(data)
            })
        }

        // menampilkan live table
        function table_absen() {
            $.get("/absen_siswa/{{ $tanggals }}/{{ $kelas }}/{{ $mapels }}/table_absen", {}, function(
                data, status) {
                $("#table_absen").html(data)
            })
        }

        function centang(any) {
            if (any.checked) {
                var checkbox = document.getElementsByName('checkbox')
                for (r = 0; r < checkbox.length; r++) {
                    checkbox[r].setAttribute('checked', true)
                }
            } else {
                var checkbox = document.getElementsByName('checkbox')
                for (i = 0; i < checkbox.length; i++) {
                    checkbox[i].removeAttribute('checked')
                }
            }
        }
          
    </script>
@endsection