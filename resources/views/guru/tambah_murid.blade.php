<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/CSS/output.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/suport.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>

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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;600&display=swap" rel="stylesheet">
</head>

<body class="text-tet">

    <!-- navbar top -->
    @include('partials.navbar')

    <!-- Sidebar left -->
    @include('partials.sidebar')


    <!-- content -->
    <div class="absolute flex justify-center items-center bg-gray-100 top-16 left-60 h-[90%] w-[82%]">

        <!-- card -->
       
        <div id="card" class="w-4/5 h-4/5 rounded-xl shadow-card pt-7 pl-10 bg-white">
            <!-- judul -->
            <div class="flex items-center w-full h-[8%]">
                <h1 class="font-[montserrat] text-2xl text-blue font-bold">
                    Data Siswa | XI PPLG 1
                </h1>
            </div>

            <!-- subjudul -->
            <div class="flex items-center w-full h-[5%]">
                <h1 class="capitalize font-[quicksand] text-base text-gray-500 font-semibold">
                    tambah data siswa
                </h1>
            </div>

            <!-- input -->
        <form action="/data_siswa/tambah_murid" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- <input type="hidden" value="{{ $nbr }}"> --}}
            <div class="flex w-full  h-[50%] ">
                <!-- kiri -->
                <div class="w-3/5 pl-32 pt-3 h-full ">
                    <label class="font-bold font-[montserrat] text-base text-black" for="name">
                        Fullname
                    </label><br>
                    <input id="name" placeholder="Name"
                        class="rounded pl-3 w-full h-[18%] border-[#9C9C9C] outline-none focus:border-[#6D6D6D] border-[1px]"
                        type="text" name="nama">

                    <br>
                    <br>

                    <div class="w-1/2">
                        <label class="font-semibold font-[montserrat] text-xl text-black" for="">Kelas</label><br>
                        <details class="custom-select rounded-lg mt-2" style="width: 80%;">
                            <summary class="radios" style="padding: 10px 10px; text-align: left;  border: #999bba solid 2px;">

                                @foreach ($kelas as $kels)
                                    <input type="radio" name="kelas" value="{{ $kels->id }}" id="{{ $kels->kelas }}" title="{{ $kels->kelas }}" checked>
                                @endforeach

                            </summary>
                            <ul class="list">
                                
                                @foreach ($kelas as $kels)
                                    <li>
                                        <label for="{{ $kels->kelas }}">
                                            {{ $kels->kelas }}
                                            <span></span>
                                        </label>
                                    </li>
                                @endforeach

                            </ul>
                        </details>
                    </div>
                </div>

                <!-- kanan -->
                <div class="w-1/2  pl-9 pt-3 h-full">
                    <label class="font-bold font-[montserrat] text-base text-black" for="">
                        Gender
                    </label><br>
                    <select class=" rounded w-1/2 h-[18%]  border-[1px] border-[#999bba] " name="jeniskelamin">
                        <option value="" disabled selected hidden>Pick Your Gender</option>
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    <br>
                    <br>

                    <label class="font-bold font-[montserrat] text-base text-black" for="">
                        Tanggal Lahir
                    </label><br>
                    <input
                        class="rounded w-1/2 h-[18%] border-[#9C9C9C] outline-none focus:border-[#6D6D6D] border-[1px]"
                        type="date" name="tgllahir">
                </div>

            </div>

            <!-- Button -->
            <div class="flex justify-center w-full">
                <button type="submit"
                    class="border-[1px] rounded w-[18%] h-3/4 hover:scale-110 font-[quicksand] font-medium text-lg border-black">
                    Selanjutnya
                </button>

            </div>

            <p class="font-[quicksand] w-full flex justify-center font-medium text-lg">
                Periksa kembali data dengan benar
            </p>


        </form>
        </div>
    </form>


    </div>
</body>

</html>


<!-- npx tailwindcss -i ./src/input.css -o ./public/assets/css/output.css --watch -->
