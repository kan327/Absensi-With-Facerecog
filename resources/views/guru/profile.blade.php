@extends('main_guru')

@section('content')
<div class="absolute left-72 w-3/4">

    <!-- profile -->
    <div class="w-full">
        <h1 class="font-[montserrat] text-bg-blue-dark text-3xl font-bold mt-32">
            Profile
        </h1>

        <!-- input pertama -->
        <div class="flex  w-4/5 ">
            <!-- one -->
            <div class="h-full pl-12 pt-5 w-1/2">
                <!-- judul input -->
                <label class="font-[montserrat] text-xl font-semibold">
                    Your NIP
                </label>

                <!-- sub judul input -->
                <p class="text-[#5A5A5A]">
                    NIP will be displayed on the dashboard
                </p>

                <!-- input -->
                <input type="text" readonly value="{{ $data_guru->nip }}"
                    class="w-2/3 pl-3 h-[40px] rounded-lg border-2 border-solid border-[#A0A0A0]">

                <br></br>

                <!-- judul input -->
                <label class="font-[montserrat] text-xl font-semibold">
                    Fullname
                </label>

                <!-- sub judul input -->
                <p class="text-[#5A5A5A]">
                    Your name will be displayed on the dashboard
                </p>

                <!-- input -->
                <input type="text" readonly value="{{ $data_guru->name }}"
                    class="w-2/3 pl-3 h-[40px] rounded-lg border-2 border-solid border-[#A0A0A0]">

            </div>


            <!-- two -->
            <div class="h-full pl-12 pt-5 w-1/2">
                <!-- judul input -->
                <label class="font-[montserrat] text-xl font-semibold">
                    Email
                </label>

                <!-- sub judul input -->
                <p class="text-[#5A5A5A]">
                    Your email will be displayed on the dashboard
                </p>

                <!-- input -->
                <input readonly value="{{ $data_guru->email }}"
                    class="w-2/3 pl-3 h-[40px] rounded-lg border-2 border-solid border-[#A0A0A0]">

                <br></br>

                <!-- judul input -->
                <label class="font-[montserrat] text-xl font-semibold">
                    No.Telp
                </label>

                <!-- sub judul input -->
                <p class="text-[#5A5A5A]">
                    Number phone will not displayed on the dashboard
                </p>

                <!-- input -->
                <input type="text" readonly value="{{ $data_guru->no_hp }}"
                    class="w-2/3 pl-3 h-[40px] rounded-lg border-2 border-solid border-[#A0A0A0]">

            </div>

        </div>



    </div>
    <!-- Choose your class -->
    <div class="w-full">
        <h1 class="pt-5 pl-5 font-[montserrat] text-bg-blue-dark text-2xl font-bold ">
            Choose your class

        </h1>
    </div>

    <!-- bagian bawah -->
    <div class="flex justify-evenly pl-12 pt-5 w-full h-[45%]">

        <!-- kiri bawah -->
        <div class="h-full  w-1/2 ">
            <!-- judul input -->
            <label class="font-[montserrat] text-xl font-semibold">
                Class
            </label>
            <!-- checkbox -->
            <form action="/profile" method="post">
                @csrf
                <div class="w-4/5 grid grid-cols-2  gap-3">
                @foreach ($data_kelas as $kelas)
                    <li>
                        <input type="checkbox" @foreach($kelas_gurus as $kelas_guru) @if($kelas_guru->kelas->id == $kelas->id) {{ "checked" }} @endif @endforeach id="checkbox{{ $no_kelas }}" name="kelas[]"
                            value="{{ $kelas->id }}">
                        <label for="checkbox{{ $no_kelas++ }}" class="w-full">{{ $kelas->kelas }}</label>
                    </li>
                @endforeach
                </div>
            <!-- </form> -->

        </div>

        <!-- kanan bawah -->
        <div class="h-full w-1/2">
            <!-- judul input -->
            <label class="font-[montserrat] text-xl font-semibold">
                Subject
            </label>
            <!-- checkbox -->
            <!-- <form action=""> -->
                <div class="w-4/5 grid grid-cols-2  gap-2">
                    @foreach ($data_mapels as $mapel)
                        <li>
                            <input type="checkbox" @foreach($mapel_gurus as $mapel_guru) @if($mapel_guru->mapel->id == $mapel->id) {{ "checked" }} @endif @endforeach id="mapel{{ $no_mapel }}" name="mapel[]" value="{{ $mapel->id }}">
                            <label for="mapel{{ $no_mapel++ }}" class="w-full">{{ $mapel->pelajaran }}</label>
                        </li>
                    @endforeach

                </div>
            




        </div>


    </div>

    <!-- button -->
    <div class="w-full grid place-center mt-10 mb-10">
        <button type="submit" id="simpan" class="px-[25vw] py-1 mx-auto hover:scale-105 hover:bg-bg-blue-dark hover:text-white  border-bg-blue-dark border-solid border-2 rounded-md font-bold">Simpan</button>
        <a id="reset" onclick="location.href='/profile/hapus/{{ auth()->user()->id }}/reset_profile'" class="px-[25vw] cursor-pointer py-[5.8px] mx-auto  border-bg-blue-dark border-solid border-2 rounded-md font-bold hover:scale-105 hover:bg-bg-blue-dark hover:text-white">Reset</a>
    </div>
   
   </form>

   
</div>

    <script>
        var btn_simpan = document.getElementById("simpan")
        var btn_reset = document.getElementById("reset")
        
        if( {{ count($mapel_gurus) }} > 0){
            btn_simpan.style.display = "none"
        }else{
            btn_reset.style.display = "none"
        }
    </script>
@endsection