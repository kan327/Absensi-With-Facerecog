@extends('guru.no_sidebar')

@section('content')
<div class=" w-3/4 h-screen mx-auto mt-40 mb-5">
    <!-- card -->
    <div style="box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.25);"
        class="h-fit p-10 w-fit bg-white border-[1px] border-black border-opacity-40 rounded-xl ">

        <!-- felx -->
        <div class="flex">
            <!-- kanan -->
            <div class="w-1/2 h-full p-10">

                <!-- inputan -->
                <form action="/absen_siswa/{{ $tanggals }}/{{ $id_kelas }}/{{ $id_mapels }}/kirim_telegram" method="POST">
                    @csrf
                    <table>
                        <tr>
                            <td>
                                <div class="border-[2px] border-[#2C3E50] rounded-md pl-3 w-fit">
                                    <label
                                        class="border-r-[2px] w-full border-[#2C3E50] pr-1 font-[quicksands] font-bold text-lg"
                                        for="x">ID</label>
                                    <input readonly value="@foreach($data_kelas as $kelas) {{ $kelas->chat_id }} @endforeach" id="x" class="w-[10vw] text-center outline-none font-bold font-[quicksands]" type="text" name="chat_id">
                                </div>
                            </td>
                            <td>
                                <input id="x" readonly value="@foreach($data_kelas as $kelas) {{ $kelas->kelas }} @endforeach"
                                class="ml-2 rounded-md border-[2px] h-[5vh] text-center border-[#2C3E50] w-[10vw] outline-none font-bold font-[quicksands]"
                                type="text" name="kelas">
                            </td>
                        </tr>



                    </table>

            


                    <label for="y" class="font-[quicksands] text-xl font-medium">Pesan :</label> <br>
                    <textarea cols="37.9%" rows="9%" name="message" class="p-1 border-[2px] rounded-md border-[#2C3E50]" id="y">@foreach ($data_absen as $absen_siswa)
Detail Absensi 

Tanggal : {{ $tanggals }}
Guru : {{ $absen_siswa->guru->name }}
Mata Pelajaran : {{ $absen_siswa->mapel->pelajaran }}
Kelas : {{ $absen_siswa->kelas->kelas }}

{{ $loop->iteration }}. {{ $absen_siswa->siswa->nama_siswa }} - {{ $absen_siswa->keterangan }}

                    @endforeach</textarea>

                    <div class="mt-3 font-[quicksands] font-medium w-[110%]">
                        Mohon periksa kembali data yang ingin dikirimkan ! Jika ada keterangan yang salah anda bisa
                        kembali ke tampilan Absensi.
                    </div>

                    <!-- button -->
                    <div class="w-full mt-3 h-[5vh]">
                        <a href= "/absen_siswa/{{ $tanggals }}/{{ $id_kelas }}/{{ $id_mapels }}"
                            class="font-[quicksands] font-semibold text-[#2C3E50] mr-5 border-[1px] hover:bg-bg-blue-dark hover:text-white border-[#2C3E50] rounded px-[7%] py-[1%]">Batal
                            Kirim</a>
                        <button
                            class="font-[quicksands] font-semibold text-[#2C3E50] mr-5 hover:bg-bg-blue-dark hover:text-white border-[1px] border-[#2C3E50] rounded px-[7%] py-[1%]">Kirim
                            Sekarang!</button>
                    </div>
                </form>


            </div>

            <!-- kiri -->
            <div class="w-[50%]  h-full">

                <!-- judul -->
                <div class="flex justify-end w-full">
                    <h1 class="font-[montserrat] font-bold text-4xl">Kirim Pesanmu!</h1>
                </div>

                <div class="flex justify-end w-full">
                    <!-- line -->
                    <div class="w-4/5 h-[2px] bg-[#2C3E50]"></div>
                </div>




                <!-- sub judul -->
                <div class="flex justify-end w-full">
                    <p class="font-[quicksands] text-end font-medium">Pesan yang anda kirim akan menuju telegram <br>
                        berdasarkan ID chat</p>
                </div>
                <div class="ml-52 mt-10">
                    <img src="{{ asset('assets/img/Vector (1).png') }}" alt="">
                </div>
            </div>
        </div>

        <!-- footer -->
        <footer class="flex text-xl font-[quicksands] font-bold items-center w-full h-[8%]">

            <div class="w-1/3 h-[2px] bg-black"></div>

            <div class="flex justify-center w-1/3">
                <p>Attendance</p>
            </div>

            <div class="float-left w-1/3 h-[2px] bg-black"></div>

        </footer>
    </div>


</div>
@endsection