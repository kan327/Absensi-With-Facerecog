@extends('main_admin')

@section('content')
<div class="w-full h-screen flex justify-center items-center mt-0">
    <!-- card -->
    <div
        class="shadow-box mx-auto border-solid border-[0.1px] border-opacity-5 border-black h-fit md:p-10 p-5 md:w-3/4 bg-white rounded-xl">
        <!-- flex -->
        <div class="flex md:flex-row flex-col-reverse">
            <!-- kanan -->
            <div class="md:w-1/2 h-full md:p-10 md:mt-0 mt-5">
                <!-- inputan -->
                <form action="/admin/grup_kelas/{{ $data_kelas->id }}" method="post">
                    @csrf
                    <div class="border-[2px] border-[#2C3E50] rounded pl-3 lgs:w-4/5 w-full  flex">
                        <label
                            class="border-r-[2px] w-[30px] border-[#2C3E50] pr-1 font-[quicksands] font-bold text-lg"
                            for="x">ID</label>
                        <input id="x" name="chat_id" value="{{ $data_kelas->chat_id }}" placeholder="Chat ID Grup Telegram"
                            class="w-full  pl-1 outline-none font-medium font-[quicksands]" type="number">
                    </div>
                    @error('chat_id')
                        <small class="text-red-600 font-bold">{{ $message }}</small>
                    @enderror
                    
                    <div class="mt-5">
                        <label class="text-lg md:text-xl" for="">Group</label> <br>
                        <input type="text" value="{{ $data_kelas->nama_grup }}" name="nama_grup" placeholder="Masukan Nama Grup"
                            class="p-1 font-[quicksands] font-medium lgs:w-4/5 w-full h-[30%] rounded mt-2 border-[2px] border-[#2C3E50]">
                        <br>
                    @error('nama_grup')
                        <small class="text-red-600 font-bold">{{ $message }}</small>
                    @enderror
                    </div>

                    <label class="text-lg md:text-xl" for="">Kelas</label> <br>
                    <input type="text" name="kelas" value="{{ $data_kelas->kelas }}" placeholder="Masukan Kelas"
                        class="p-1 font-[quicksands] font-medium lgs:w-4/5 w-full h-[30%] rounded mt-2 border-[2px] border-[#2C3E50]">
                        @error('kelas')
                            <small class="text-red-600 font-bold">{{ $message }}</small>
                        @enderror

                    <label class="text-lg md:text-xl" for="">Walikelas</label> <br>
                    <input type="text" name="nama_walas" value="{{ $data_kelas->nama_walas }}" placeholder="Masukan Nama Wali Kelas"
                        class="p-1 font-[quicksands] font-medium lgs:w-4/5 w-full h-[30%] rounded mt-2 border-[2px] border-[#2C3E50]"><br>
                        @error('nama_walas')
                            <small class="text-red-600 font-bold">{{ $message }}</small>
                        @enderror

                    <!-- button -->
                    <div class="w-full flex my-5 h-[5vh]">
                        <a href="/admin/pino_bot"
                            class="px-[20px] py-1 font-[quicksands] font-semibold text-[#2C3E50] border-[2px] border-[#2C3E50] rounded mr-5 h-full">Batal</a>
                        <button type="submit"
                            class="font-[quicksands] font-semibold bg-[#2C3E50] text-white border-[2px] border-[#2C3E50] rounded w-[100px] h-full">Ubah
                        </button>
                    </div>
                </form>
            </div>

            <!-- kiri -->
            <div class="md:w-1/2  h-full">

                <!-- judul -->
                <div class="flex md:justify-end w-[full]">
                    <h1 class="font-[montserrat] font-bold text-xl sm:text-2xl md:text-3xl lg:text-4xl">Edit Kelas Baru</h1>
                </div>

                <div class="flex md:justify-end w-[full]">
                    <!-- line -->
                    <div class="w-4/5 h-[2px] bg-[#2C3E50]"></div>
                </div>

                <!-- sub judul -->
                <div class="flex md:justify-end w-full">
                    <p class="font-[quicksands] md:text-end font-medium">Group telegram akan digunakan guru untuk
                        mengirimkan laporan absen.</p>
                </div>
                <div class="lg:ml-52 ml-32 mt-[15%] hidden md:block">
                    <img class="min-w-[155px]" src="https://starabsen.onesolver.net/assets/img/Vector (1).png" alt="">
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
@endsection