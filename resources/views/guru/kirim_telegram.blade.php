{{-- @extends('guru.no_sidebar') --}}
@extends('main_guru')

@section('content')
<div class="w-full h-screen flex justify-center items-center mt-0">
    <div class="absolute sm:pl-10 vp-860:pr-20 vp-860:pl-10 pr-2 pl-2 sm:pr-10 vp-860:w-4/5 w-[100vw] //lgs:bg-black //bg-transparent mx-auto">
    <!-- card -->
    <div
        class="shadow-box mt-32 mx-auto border-solid h-fit xl:p-10 p-5 bg-white border-[1px] border-black border-opacity-40 rounded-xl">

        <!-- felx -->
        <div class="flex lg:flex-row flex-col-reverse">
            <!-- kanan -->
            <div class="lg:w-1/2 h-full xl:p-10 sm:p-5">

                <!-- inputan -->
                <form action="/absen_siswa/{{ $tanggals }}/{{ $id_kelas }}/{{ $id_mapels }}/kirim_telegram" method="POST">
                    @csrf                   
                    <div class="flex justify-between">
                        <div class="border-[2px] border-[#2C3E50] sm:min-w-[165px] pl-3 lgs:w-1/2 w-full flex rounded-md overflow-hidden">
                            <label
                                class="border-r-[2px] w-[30px] border-[#2C3E50] pr-1 font-[quicksands] font-bold text-lg"
                                for="x">ID</label>
                            <input readonly value="@foreach($data_kelas as $kelas) {{ $kelas->chat_id }} @endforeach" id="x" name="chat_id" placeholder="Chat ID Grup Telegram"
                                class="w-full  pl-1 outline-none font-bold font-[quicksands]" type="text">
                        </div>
                        <div>
                            <input id="x" readonly value="@foreach($data_kelas as $kelas) {{ $kelas->kelas }} @endforeach"
                            class="ml-2 rounded-md border-[2px] text-center border-[#2C3E50] w-[60%] min-w-[99px] py-1 outline-none font-bold font-[quicksands]"
                            type="text" name="kelas">
                        </div>
                    </div>
                    <label for="y" class="font-[quicksands] text-lg md:text-xl font-medium">Pesan :</label> <br>
                    <textarea cols="37.9%" rows="9%" name="message" class="p-1 border-[2px] rounded-md border-[#2C3E50] w-full" id="y">
Detail Absensi 

Tanggal : {{ Carbon\Carbon::parse($tanggals)->translatedFormat('d F Y') }}
Guru : {{ auth()->user()->name }}
Mata Pelajaran : {{ $data_jadwal->first()->mapel->pelajaran }}
Kelas : {{ $data_jadwal->first()->kelas->kelas }}
Hadir : {{ count($hadir) }} Murid
Tidak Hadir : {{ count($tidak_hadir) }} Murid

@if (count($data_absen) > 0)
@foreach ($data_absen as $absen_siswa)
{{ $loop->iteration }}. {{ $absen_siswa->siswa->nama_siswa }} - {{ $absen_siswa->keterangan }}  
@endforeach @else - @endif</textarea>

                    <div class="mt-3 font-[quicksands] font-medium w-[100%]">
                        Mohon periksa kembali data yang ingin dikirimkan ! Jika ada keterangan yang salah anda bisa
                        kembali ke tampilan Absensi.
                    </div>

                    <!-- button -->
                    <div class="w-full mt-3 flex justify-between lgs:flex-row  flex-col gap-1">
                        <a href= "/absen_siswa/{{ $tanggals }}/{{ $id_kelas }}/{{ $id_mapels }}"
                            class="font-[quicksands] font-semibold text-[#2C3E50] border-[1px] hover:bg-bg-blue-dark hover:text-white border-[#2C3E50] rounded px-[10px] py-1 text-center">Batal
                            Kirim</a>
                        <button
                            class="font-[quicksands] font-semibold text-[#2C3E50] hover:bg-bg-blue-dark hover:text-white border-[1px] border-[#2C3E50] rounded px-[10px] py-1">Kirim
                            Sekarang!</button>
                    </div>
                </form>


            </div>

            <!-- kiri -->
            <div class="lg:w-[50%] h-full">

                <!-- judul -->
                <div class="flex lg:justify-end w-full">
                    <h1 class="font-[montserrat] font-bold text-xl sm:text-2xl md:text-3xl lg:text-4xl">Kirim Pesanmu!</h1>
                </div>

                <div class="flex lg:justify-end w-full">
                    <!-- line -->
                    <div class="lg:w-4/5 w-full h-[2px] bg-[#2C3E50]"></div>
                </div>




                <!-- sub judul -->
                <div class="flex lg:justify-end w-full">
                    <p class="font-[quicksands] lg:text-end font-medium">Pesan yang anda kirim akan menuju telegram <br>
                        berdasarkan ID chat</p>
                </div>
                <div class="lg:ml-32  mt-[15%] lgs:ml-52 -ml-0 hidden lg:block">
                    <img class="min-w-[155px]" src="{{ asset('assets/img/Vector (1).png') }}" alt="">
                </div>
            </div>
        </div>

        <!-- footer -->
        <footer class="flex text-lg md:text-xl font-[quicksands] font-bold items-center w-full h-[8%]">

            <div class="md:w-1/3 w-1/4 h-[2px] bg-black"></div>

            <div class="flex justify-center md:w-1/3 w-1/2">
                <p>Attendance</p>
            </div>

            <div class="float-left md:w-1/3 w-1/4 h-[2px] bg-black"></div>

        </footer>
    </div>
</div>


</div>
@endsection