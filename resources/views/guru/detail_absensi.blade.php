@extends('main_guru')

@section('content')
    <!-- content -->
    <div class="absolute text-bg-blue-dark left-72 w-3/4 py-5 px-16 pb-20">

        <!-- head -->
        <div class="flex mt-32 mb-20 mx-auto">

            <!-- left side -->
            <div
                class="shadow-box font-[Montserrat] w-1/2  p-8 rounded-lg border-solid border-[0.1px] border-opacity-5 border-[#81B7E980]">
                <div>
                    <h1 class="text-xl font-bold">Absensi</h1>
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
                            <p class="font-medium font-[Montserrat]">Pulang</p>
                            <int>{{ \Carbon\Carbon::createFromFormat('G:i:s', $data_jadwals->selesai)->format('g:i A') }}</int>
                        </div>
                    </div>
                    <button onclick="location.href = '/absen_siswa/{{ $tanggals }}/{{ $kelas }}/{{ $mapels }}/cam_masuk'" class="py-1.5 px-3.5 bg-bg-blue-dark rounded-md text-white">Masuk</button>
                    <button onclick="location.href = '/absen_siswa/{{ $tanggals }}/{{ $kelas }}/{{ $mapels }}/cam_pulang'" class="py-1 px-3 border-bg-blue-dark border-solid border-2 box-border rounded-md">Pulang</button>
                    <p class="mt-4">Mohon ubah sesi sesuai pada waktunya.</p>
                </div>
            </div>

            <!-- right side -->
            <div class="w-1/2 ml-3" id="box_absen_keterangan">

                {{-- box_absen --}}

            </div>
        </div>

        <!-- tag -->
        <div class="flex my-5 justify-between">
            <h1 class="text-2xl mt-2 font-bold text-blue-normal-19 font-[Montserrat]">Daftar Absensi | {{ $data_kelas->first()->kelas }}
            </h1>
            <button class="px-4 py-3 bg-bg-blue-dark rounded-xl text-white font-bold">Kirim Ke Telegram</button>
        </div>
        <!-- main -->
        <div
            class="shadow-box p-8 mx-auto rounded-2xl border-solid border-[0.1px] border-opacity-5 border-[#81B7E980]">

            <!-- table -->
            <div class="h-[50vh] w-full overflow-auto" id="table_absen">

              <!-- table_absen -->
                
            </div>
            <!-- control manual -->
            <div class="border-blue border-solid border-t-2 flex justify-between text-sm">
                <!-- leftbar -->
                <div class="font-[Montserrat] w-1/3 min-w-[268px] mt-10 mx-5">
                    <h1 class="font-semibold text-blue-normal-19 text-base">Set Centang</h1>
                    <p class="text-dark-data my-4">Atur keterangan Centang</p>




                    <!-- radio -->
                    <div class="flex ml-5">
                        <div class="mr-3">
                            <div class="flex content-center">
                                <input class="mr-2 option-input radio" 
                                value ="Alpha" type="radio" name="ket" id="a">
                                <label for="a" class="label-radio">Alpha</label>
                            </div>
                            <div class="flex content-center">
                                <input class="mr-2 option-input radio" type="radio" value="Hadir" name="ket" id="h">
                                <label for="h" class="label-radio">Hadir</label>
                            </div>
                        </div>
                        <div class="mr-3">
                            <div class="flex content-center">
                                <input class="mr-2 option-input radio" type="radio" value="Terlambat" name="ket" id="t">
                                <label for="t"  class="label-radio">terlambat</label>
                            </div>
                            <div class="flex content-center">
                                <input class="mr-2 option-input radio" type="radio" value="Sakit" name="ket" id="s">
                                <label for="s" class="label-radio">sakit</label>
                            </div>
                        </div>
                        <input class="mr-2 option-input radio" type="radio" value="Izin" name="ket" id="i">
                        <label for="i" class="label-radio">Izin</label>
                    </div>




                    <!-- confirm -->
                    <p class="py-4">Pastikan untuk tidak salah pilih!</p>
                    <button class="bg-bg-blue-dark px-4 py-2 rounded-xl text-white font-bold" onclick="save()">Simpan
                        Perubahan</button>
                </div>
                <!-- rightbar -->
                <div class="w-[33%] max-w-[300px] m-x-5 mt-14">
                    <div class="flex justify-between">
                        <button
                            class="px-4 py-1 border-2 border-solid border-blue-normal-19 text-blue-dark-10 rounded-lg font-bold" id="btn_tutup_absen" onclick="tutup_absen()">Tutup
                            Absen</button>
                        <button class="bg-bg-blue-dark px-4 py-2 rounded-lg text-white font-bold" onclick="pulang()" id="pulangkan">Pulangkan</button>
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

    <script>
        $(document).ready(function() {
            box_absen_ket()
            table_absen()
        })

        // menampilkan live status siswa
        function box_absen_ket() {
            $.get("/absen_siswa/{{ $tanggals }}/{{ $kelas }}/{{ $mapels }}/box_ket", {}, function(data,
                status) {
                $("#box_absen_keterangan").html(data)
                console.log(data)
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