<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Grup | Starbhak Absensi</title>

    <!-- style css -->
    <link rel="stylesheet" href="{{ asset('assets/CSS/output.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/suport.css') }}">
    {{-- tailwind --}}

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'bg-blue-dark': '#2C3E50',
                        'dark-data': '#393939',
                        'placeholder': '#A0A0A0',
                        'bg': '#FCFCFF',
                    },
                    boxShadow: {
                        nav: '2px 3px 3px 1px rgba(0, 0, 0, 0.1);',
                        side: ' 0px 5px 10px rgba(0, 0, 0, 0.05);',
                        stable: ' 0px 3px 4px rgba(0, 0, 0, 0.25);',
                        box: ' 0px 4px 4px rgba(0, 0, 0, 0.25)',
                    }
                },
            }
        }
    </script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&family=Quicksand:wght@400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body class="text-bg-blue-dark h-[100vh] overflow-y-auto  m-5 mt-6">
    <!-- navbar -->
    @include("partials.navbar_admin")
    
    <!-- container -->
    <div class="w-screen h-screen flex justify-center items-center">
        <!-- card -->
        <div style="box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.25);"
            class="h-fit p-10 w-3/4 bg-white border-[1px] border-black border-opacity-40 rounded-xl ">

            <!-- felx -->
            <div class="flex">
                <!-- kanan -->
                <div class="w-1/2 h-full p-10">

                    <!-- inputan -->
                    <form action="/admin/grup_kelas" method="post">
                        @csrf
                        <div class="border-[2px] border-[#2C3E50] rounded pl-3 w-fit">
                            <label
                                class="border-r-[2px] w-full border-[#2C3E50] pr-1 font-[quicksands] font-bold text-lg"
                                for="x">ID</label>
                            <input id="x" name="chat_id" value="{{ old('chat_id') }}" placeholder="Chat ID Grup Telegram" class="w-[20vw]  pl-1 outline-none font-medium font-[quicksands]" type="number">
                        </div>
                        @error('chat_id')
                            <small class="text-red-600 font-bold">{{ $message }}</small>
                        @enderror
                        
                        <div class="mt-5">
                        <label class="text-xl" for="">Group</label> <br>
                        <input type="text" value="{{ old('nama_grup') }}" name="nama_grup" placeholder="Masukan Nama Grup" class="p-1 font-[quicksands] font-medium w-4/5 h-[30%] rounded mt-2 border-[2px] border-[#2C3E50]"> <br>
                        @error('nama_grup')
                            <small class="text-red-600 font-bold">{{ $message }}</small>
                        @enderror
                    </div>

                        <label class="text-xl" for="">Kelas</label> <br>
                        <input type="text" name="kelas" value="{{ old('kelas') }}" placeholder="Masukan Kelas" class="p-1 font-[quicksands] font-medium w-4/5 h-[30%] rounded mt-2 border-[2px] border-[#2C3E50]"> <br>
                        @error('kelas')
                            <small class="text-red-600 font-bold">{{ $message }}</small>
                        @enderror
                        <br>
                        <label class="text-xl" for="">Walikelas</label> <br>
                        <input type="text" name="nama_walas" value="{{ old('nama_walas') }}" placeholder="Masukan Nama Wali Kelas" class="p-1 font-[quicksands] font-medium w-4/5 h-[30%] rounded mt-2 border-[2px] border-[#2C3E50]"><br>
                        @error('nama_walas')
                            <small class="text-red-600 font-bold">{{ $message }}</small>
                        @enderror
                        

                        <!-- button -->
                        <div class="w-full mt-[8%] h-[5vh]">
                            <a href="/admin/pino_bot"
                                class="px-[9%] py-1 font-[quicksands] font-semibold text-[#2C3E50] border-[2px] border-[#2C3E50] rounded w-[45%] mr-5 h-full">Batal</a>
                            <button type="submit"
                                class="font-[quicksands] font-semibold bg-[#2C3E50] text-white border-[2px] border-[#2C3E50] rounded w-[45%] h-full">Buat + </button>
                        </div>
                    </form>


                </div>

                <!-- kiri -->
                <div class="w-1/2  h-full">

                    <!-- judul -->
                    <div class="flex justify-end w-[full]">
                        <h1 class="font-[montserrat] font-bold text-4xl">Buat Kelas Baru</h1>
                    </div>

                    <div class="flex justify-end w-[full]">
                        <!-- line -->
                        <div class="w-4/5 h-[2px] bg-[#2C3E50]"></div>
                    </div>

                    <!-- sub judul -->
                    <div class="flex justify-end w-full">
                        <p class="font-[quicksands] text-end font-medium">Group telegram akan digunakan guru untuk mengirimkan laporan absen.</p>
                    </div>
                    <div class="ml-52 mt-[15%]">
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
</body>

</html>


<!-- npx tailwindcss -i ./src/input.css -o ./public/assets/css/output.css --watch -->