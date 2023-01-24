@extends('main_guru')

@section('content')
<div class="absolute vp-860:left-72 sm:pl-10 vp-860:pr-20 vp-860:pl-10 pr-2 pl-2 sm:pr-10 vp-860:w-3/4 w-[100vw] //lgs:bg-black //bg-transparent mx-auto max-w-7xl">
    
    <!-- profile -->
    <div>
        <h1 class="font-[montserrat] md:text-left text-center text-bg-blue-dark md:text-3xl text-2xl font-bold mt-32">
            Profile
        </h1>
        <!-- input pertama -->
        <div class="mx-auto md:mx-0 grid sm:grid-cols-2 gap-5 gap-y-5 w-4/5 my-5">
            <!-- one -->
            <div class="items-start flex">
                <div class="max-w-[210px] w-fit mx-auto sm:mx-0">
                    <label class="font-[montserrat] text-md md:text-lg lg:text-xl font-semibold">
                        Your NIP
                    </label>

                    <!-- input -->
                    <input type="text" readonly value="{{ $data_guru->nip }}"
                        class="w-2/3 min-w-[210px]  pl-3 h-[40px] rounded-lg border-2 border-solid border-[#A0A0A0]">

                </div>
            </div>
            <!-- two -->
            <div class="place-items-end flex">
                <div class="max-w-[210px] w-fit mx-auto sm:mx-0">
                    <label class="font-[montserrat] text-md md:text-lg lg:text-xl font-semibold">
                        Fullname
                    </label>

                    <!-- input -->
                    <input type="text" readonly value="{{ $data_guru->name }}"
                        class="w-2/3 min-w-[210px] pl-3 h-[40px] rounded-lg border-2 border-solid border-[#A0A0A0]">

                </div>
            </div>
            <!-- 3 -->
            <div class="items-start flex">
                <div class="max-w-[210px] w-fit mx-auto sm:mx-0">
                    <label class="font-[montserrat] text-md md:text-lg lg:text-xl font-semibold">
                        Email
                    </label>

                    <!-- input -->
                    <input readonly type="text" value="{{ $data_guru->email }}"
                        class="w-2/3 min-w-[210px] pl-3 h-[40px] rounded-lg border-2 border-solid border-[#A0A0A0]">
                </div>
            </div>
            <!-- four -->
            <div class="place-items-end flex">
                <div class="max-w-[210px] w-fit mx-auto sm:mx-0">
                    <label class="font-[montserrat] text-md md:text-lg lg:text-xl font-semibold">
                        No.Telp
                    </label>

                    <!-- input -->
                    <input type="text" readonly value="{{ $data_guru->no_hp }}"
                        class="w-2/3 min-w-[210px] pl-3 h-[40px] rounded-lg border-2 border-solid border-[#A0A0A0]">

                </div>
            </div>
        </div>
    </div>
    <!-- Choose your class -->
    <form action="/profile" method="post">
        @csrf
        <div>
            <h1 class="my-5 mt-10 font-[montserrat] md:text-left text-center text-bg-blue-dark text-lg sm:text-xl md:text-2xl font-bold ">
                Choose your class
            </h1>
            <!-- bagian bawah -->
            <div class="flex w-full sm:flex-row flex-col lg:gap-0 gap-10 justify-between max-w-[720px]">
                <!-- kiri bawah -->
                    <div class="h-full w-fit mx-auto sm:mx-0 md:text-left text-center">
                        <!-- judul input -->
                        <label class="font-[montserrat] text-md md:text-lg lg:text-xl font-semibold">
                            Class
                        </label>
                        <!-- checkbox -->
                            <div class="grid grid-cols-2 gap-3 ">
                            @foreach ($data_kelas as $kelas)
                                <li>
                                    <input type="checkbox" value="{{ $kelas->id }}" @foreach($kelas_gurus as $kelas_guru) @if($kelas_guru->kelas->id == $kelas->id) {{ "checked disabled" }} @endif @endforeach id="checkbox{{ $no_kelas }}" name="kelas[]">
                                    <label class="w-[120px] overflow-auto text-center" for="checkbox{{ $no_kelas++ }}">{{ $kelas->kelas }}</label>
                                </li>
                            @endforeach
                            </div>
                    </div>
                    <!-- kanan bawah -->
                    <div class="h-full w-fit mx-auto sm:mx-0 md:text-left text-center">
                        <!-- judul input -->
                        <label class="font-[montserrat] text-md md:text-lg lg:text-xl font-semibold">
                            Subject
                        </label>
                        <!-- checkbox -->
                        <div class="grid grid-cols-2 gap-3 ">
                            @foreach ($data_mapels as $mapel)
                            <li>
                                <input type="checkbox" @foreach($mapel_gurus as $mapel_guru) @if($mapel_guru->mapel->id == $mapel->id) {{ "checked disabled" }} @endif @endforeach id="mapel{{ $no_mapel }}" name="mapel[]" value="{{ $mapel->id }}">
                                <label class="w-[120px] overflow-auto text-center" for="mapel{{ $no_mapel++ }}">{{ $mapel->pelajaran }}</label>
                            </li>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- button -->
            <div class="w-full max-w-[720px] mb-10 flex justify-end">
                <a id="reset" onclick="location.href='/profile/hapus/{{ auth()->user()->id }}/reset_profile'" class="px-2 cursor-pointer p-1 mr-5 border-bg-blue-dark border-solid border-2 rounded-md font-bold hover:scale-105 hover:bg-bg-blue-dark hover:text-white">Reset</a>
                <button type="submit" id="simpan" class="px-3 py-1 hover:scale-105 hover:bg-bg-blue-dark hover:text-white  border-bg-blue-dark border-solid border-2 rounded-md font-bold">Simpan</button>
            </div>
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