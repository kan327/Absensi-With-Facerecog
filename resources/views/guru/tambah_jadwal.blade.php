<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
          
    {{-- tailwind --}}

    <script src="https://cdn.tailwindcss.com"></script>

    {{-- link css --}}
    <link rel="stylesheet" href="{{ asset('assets/CSS/output.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/suport.css') }}">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'blue-dark': '#1061FF',
                        'blue': '#349DFD',
                        'tet': '#001458',
                        'unselect': '#BAC5E7',
                        'stroke': '#81B7E9',
                    },
                    boxShadow: {
                        nav: '2px 2px 50px 1px rgba(179, 185, 191, 0.1);',
                        side: ' 0px 5px 10px rgba(0, 0, 0, 0.05);',
                        card: '-8px -8px 12px rgba(255, 255, 255, 0.25), 8px 8px 10px rgba(0, 0, 0, 0.25);'
                    }
                },
            }
        }
    </script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,500;1,500&display=swap"
        rel="stylesheet">
</head>

<body class="text-tet">
    <!-- navbar top -->
    @include('partials.navbar')

    <!-- Sidebar left -->
    @include('partials.sidebar')

    <!-- content -->
    <div class="absolute flex justify-center items-center bg-gray-100 top-16 left-60 h-[90%] w-[82%]">

        <!-- card -->
        <div id="card" class="w-2/3 h-4/5 rounded-xl shadow-card p-7 bg-white">

            <!-- judul -->
            <div class="flex items-center w-full h-[10%] border-b-[1px] border-b-black">
                <h1 class="capitalize font-[montserrat] text-xl text-blue-dark-10 font-bold">
                    tambah jadwal mata pelajaran
                </h1>
            </div>

            <!-- content card -->
            <div class=" w-full h-3/4 ">

                <!-- sub judul -->
                <div class="flex items-center pl-5  h-1/5 w-full">
                    <p class="capitalize font-[montserrat] text-[#001458]">Hai {{ auth()->guard("user")->user()->username }} ! , mau mengajar apa hari ini?</p>
                </div>

                <form action="/absensi/tambah_jadwal" method="POST">
                    @csrf
                    <!-- inputan 1 -->
                    <div class="pl-5 w-full h-2/5 ">
                        <div class="flex w-full">
                            <div class="w-1/2">
                                <label for="" class="font-semibold font-[montserrat] text-xl text-black" for="">Mata
                                    Pelajaran</label><br>
                                    <details class="custom-select rounded-lg mt-2" style="width: 80%;">
                                        <summary class="radios" style="padding: 10px 10px; text-align: left;  border: #999bba solid 2px;">
                                            
                                            @foreach ($data_gurus as $data_guru)
                                                @foreach ($data_guru->user_mapels as $mapel_guru)
                                                    <input type="radio" name="mapel" title="{{ $mapel_guru->pelajaran }}" id="{{ $mapel_guru->pelajaran }}" value="{{ $mapel_guru->id }}" checked>
                                                @endforeach
                                            @endforeach

                                        </summary>
                                        <ul class="list">

                                            @foreach ($data_gurus as $data_guru)
                                                @foreach ($data_guru->user_mapels as $mapel_guru)
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
                            <div class="w-1/2">
                                
                                <label class="font-semibold font-[montserrat] text-xl text-black" for="">Kelas</label><br>
                                <details class="custom-select rounded-lg mt-2" style="width: 80%;">
                                    <summary class="radios" style="padding: 10px 10px; text-align: left;  border: #999bba solid 2px;">

                                        @foreach($data_gurus as $data_guru)
                                            @foreach($data_guru->user_kelas as $kelas_guru)
                                                <input type="radio" name="kelas" value="{{ $kelas_guru->id }}" id="{{ $kelas_guru->kelas }}" title="{{ $kelas_guru->kelas }}" checked>
                                            @endforeach
                                        @endforeach
                                    </summary>
                                    <ul class="list">
                                        
                                        @foreach ($data_gurus as $data_guru)
                                            @foreach ($data_guru->user_kelas as $kelas_guru)
                                                
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
                    <div class="flex w-[93%] h-2/5 ">
                        <div class=" w-1/3">
                            <div class="flex justify-center w-full">
                            <p class="font-[montserrat] font-semibold text-lg ">Mulai Absen</p></div>
                            <div class="flex justify-center h-full w-full">
                                <input class="rounded-lg w-[80%] h-1/3 border-[1px] " required style="padding: 10px 10px; text-align: left;  border: #999bba solid 2px;" type="time" name="mulai" value="{{ old('mulai') }}" >
                            </div>
                            
                        </div>

                        <div class=" w-1/3">
                            <div class="flex justify-center w-full">
                            <p class="font-[montserrat] font-semibold text-lg ">Batas Hadir</p></div>
                            <div class="flex justify-center h-full w-full">
                            <input class="rounded-lg w-[80%] h-1/3" required style="padding: 10px 10px; text-align: left;  border: #999bba solid 2px;" type="time" name="batas_hadir" value="{{ old('batas_hadir') }}" ></div>
                        </div>

                        <div class=" w-1/3">
                            <div class="flex justify-center w-full">
                            <p class="font-[montserrat] font-semibold text-lg ">Selesai</p></div>
                            <div class="flex justify-center h-full w-full">
                                <input class="rounded-lg w-[80%] h-1/3" required style="padding: 10px 10px; text-align: left;  border: #999bba solid 2px;" type="time"  value="{{ old('selesai') }}"  name="selesai"></div>
                        </div>
                    </div>

                </div>
                <!-- button -->
                <div class="w-full h-[12%] flex justify-end border-t-black border-t-[1px] pt-3">
                    <button onclick="location.href= '/absensi'" class=" w-[20%] hover:scale-110 text-[#0d245a] font-bold rounded mr-5 ">Cancel</button>
                    <button type="submit" class=" w-[20%] hover:scale-110 text-white font-bold bg-[#002c9d] rounded ">Add</button>
                </div> 
                 
            </form>
        </div>


    </div>

    
</body>

</html>


{{-- <!-- npx tailwindcss -i ./src/input.css -o ./public/assets/css/output.css --watch --> --}}