@extends('main_guru')

@section('content')
<div class="w-full h-screen flex justify-center items-center mt-0">
    <div
        class="lg:w-[60%] sm:w-11/12 absolute sm:pl-10 vp-860:pr-20 vp-860:pl-10 pr-2 pl-2 sm:pr-10 vp-860:w-3/4 w-[100vw] mx-auto">
        <!-- card -->
        <div
            class="shadow-box mt-0 mx-auto border-solid h-fit xl:p-10 p-5 bg-white border-[1px] border-black border-opacity-40 rounded-xl">

            <!-- card -->
            <form action="/absensi/tambah_jadwal" method="POST" id="card">

                <!-- judul -->
                <div class="flex items-center w-full border-b-[1px] border-b-black">
                    <h1 class="capitalize font-[montserrat] text-xl text-bg-blue-dark font-bold">
                        Tambah jadwal mata pelajaran
                    </h1>
                </div>
                <!-- content card -->
                <div class=" w-full h-3/4">
                    <!-- sub judul -->
                    <div class="flex items-center pl-5  h-1/5 w-full mb-5">
                        <p class="capitalize font-[montserrat] text-[#001458]">Hai {{ auth()->user()->username }} ! , mau mengajar apa
                            hari
                            ini?</p>
                    </div>

                    <!-- inputan 1 -->
                    <div class="px-5 w-full h-2/5 mb-5">
                        @csrf
                        <div class="flex justify-between w-full sm:flex-row flex-col">
                            <div class="sm:w-[45%]">
                                <label class="font-semibold font-[montserrat] text-xl text-black" for="">Mata
                                    Pelajaran</label><br>
                                <details class="custom-select rounded-lg mt-2 w-full">
                                    <summary class="radios border-bg-blue-dark border-solid border-2 text-left p-2">

                                    @foreach ($data_gurus as $data_guru)
                                        @foreach ($data_guru->guru_mapel as $mapel_guru)
                                            <input type="radio" name="mapel" title="{{ $mapel_guru->pelajaran }}" id="{{ $mapel_guru->pelajaran }}" value="{{ $mapel_guru->id }}" checked>
                                        @endforeach
                                    @endforeach

                                    </summary>
                                    <ul class="list">

                                    @foreach ($data_gurus as $data_guru)
                                        @foreach ($data_guru->guru_mapel as $mapel_guru)
                                            <li>
                                                <label for="{{  $mapel_guru->pelajaran }}">
                                                    {{  $mapel_guru->pelajaran }}
                                                    <span></span>
                                                </label>
                                            </li>
                                        @endforeach
                                    @endforeach

                                    </ul>
                                </details>
                            </div>
                            <div class="sm:w-[45%]">
                                <label class="font-semibold font-[montserrat] text-xl text-black"
                                    for="">Kelas</label><br>
                                <details class="custom-select rounded-lg mt-2 w-full">
                                    <summary class="radios border-bg-blue-dark border-solid border-2 text-left p-2">

                                    @foreach($data_gurus as $data_guru)
                                        @foreach($data_guru->guru_kelas as $kelas_guru)
                                            <input type="radio" name="kelas" value="{{ $kelas_guru->id }}" id="{{ $kelas_guru->kelas }}" title="{{ $kelas_guru->kelas }}" checked>
                                        @endforeach
                                    @endforeach

                                    </summary>
                                    <ul class="list">
                                    @foreach ($data_gurus as $data_guru)
                                        @foreach ($data_guru->guru_kelas as $kelas_guru)
                                            
                                        <li>
                                            <label for="{{ $kelas_guru->kelas }}">
                                                {{ $kelas_guru->kelas }}
                                                <span></span>
                                            </label>
                                        </li>
                                        @endforeach
                                    @endforeach
                                    </ul>
                                </details>
                            </div>
                        </div>
                    </div>

                    <!-- inputan 2 -->
                    <div class="sm:px-5 flex justify-between w-[93%] mx-auto mb-5 sm:flex-row flex-col">
                        <div class="sm:min-w-[155px]">
                            <div class="flex sm:justify-center">
                                <p class="font-[montserrat] font-semibold text-lg ">Mulai Absen</p>
                            </div>
                            <div class="flex sm:w-full">
                                <input class="rounded-lg w-full xl:px-10 px-5 py-1 border-bg-blue-dark border-[2px] border-solid"
                                    type="time" name="mulai" value="{{ old('mulai') }}" required>
                            </div>
                        </div>

                        <div class="sm:min-w-[155px]">
                            <div class="flex sm:justify-center">
                                <p class="font-[montserrat] font-semibold text-lg ">Batas Hadir</p>
                            </div>
                            <div class="flex sm:w-full">
                                <input class="rounded-lg w-full xl:px-10 px-5 py-1 border-bg-blue-dark border-[2px] border-solid"
                                    type="time" name="batas_hadir" value="{{ old('batas_hadir') }}" required>
                            </div>
                        </div>

                        <div class="sm:min-w-[155px]">
                            <div class="flex sm:justify-center ">
                                <p class="font-[montserrat] font-semibold text-lg ">Selesai</p>
                            </div>
                            <div class="flex sm:w-full">
                                <input class="rounded-lg w-full xl:px-10 px-5 py-1 border-bg-blue-dark border-[2px] border-solid"
                                    type="time" value="{{ old('selesai') }}" name="selesai" required>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- button -->
                <div class="w-full h-[12%] flex justify-end pt-3">
                    <a href="/absensi"
                        class=" hover:border-[2px] border-[2px] px-5 py-[3px] border-[#2C3E50] hover:scale-110 text-[#2C3E50] font-bold rounded mr-7 hover:bg-bg-blue-dark hover:text-white">Batal</a>
                    <button type="submit"
                        class="w-[100px] hover:scale-110 text-white font-bold bg-[#2C3E50] rounded ">+
                        Buat</button>
                </div>

            </form>


        </div>
    </div>
</div>
@endsection