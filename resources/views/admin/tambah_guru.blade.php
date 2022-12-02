<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tambah Guru | Starbhak Absensi</title>
      
    {{-- tailwind --}}

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- style css -->

    <link rel="stylesheet" href="{{ asset('assets/CSS/output.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/suport.css') }}">
    
    <!-- config -->
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
    <!-- font material ++ -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,500;1,500&display=swap"
        rel="stylesheet">
</head>

<body class="text-bg-blue-dark overflow-y-auto m-5 mt-6">
    {{-- navbar --}}
    @include('partials.navbar_admin')

    <!-- content -->
    <div class="w-[100vw]">
         <!-- card -->
        <div style="border: 1px solid rgba(0, 0, 0, 0.1);
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" id="card" 
        class="w-[60%] h-fit rounded-xl shadow-card my-[4%] p-10 mx-auto bg-white">
            <!-- judul -->
            <div class="flex items-center w-full h-[8%]">
                <h1 class="border-b-[2px] border-[#393939]  font-[montserrat] text-2xl text-[#2C3E50] font-bold">
                    Tambah Akun Guru
                </h1>
            </div>

            <!-- subjudul -->
            <div class="flex mt-2 items-center w-full">
                <h1 class="capitalize font-[quicksands] text-base text-gray-500 font-medium">
                    Akun yang di tambahkan bisa langsung digunakan oleh guru tersebut.
                </h1>
            </div>

             <!-- inputan -->
            <form class="mt-2 w-full h-1/2" action="/admin/tambah_guru" method="POST">
                @csrf
                <!-- sub judul 1 -->
                <h2 class=" items-end text-xl text-[#2C3E50] font-[montserrat] font-semibold mb-2">
                    Data guru
                </h2>

                <!-- input data guru -->
                <div class="flex">

                    <!-- inputan kiri -->
                    <div class="w-1/2 h-fit mr-5">
                        <p class="text-[#2C3E50] font-[quicksands] text-lg font-semibold">
                            Nama Guru
                        </p>
                        <input name="name" placeholder="Nama Guru" type="text" class="font-bold pl-3 outline-none w-full h-8 rounded-md border-solid border-[1px] border-[#2C3E50]" value="{{ old('name') }}"><br>
                        @error('name')
                            <small class="text-red-500 font-bold">{{ $message }}</small>
                        @enderror

                        <p class=" text-[#2C3E50] font-[quicksands] mt-1 text-lg font-semibold">
                            Email Guru
                        </p>
                        <input name="email" placeholder="Email Guru" type="email" class="font-bold pl-3 outline-none w-full h-8 rounded-md border-solid border-[1px] border-[#2C3E50]" value="{{ old('email') }}"><br>
                        @error('email')
                            <small class="text-red-500 font-bold">{{ $message }}</small>
                        @enderror
                    </div>


                    <!-- inputan kanan -->
                    <div class="w-1/2 h-fit">
                        <p class="text-[#2C3E50] font-[quicksands] text-lg font-semibold">
                            NIP
                        </p>
                        <input name="nip" type="number" placeholder="NIP Guru" class="font-bold pl-3 outline-none w-full h-8 rounded-md border-solid border-[1px] border-[#2C3E50]" value="{{ old('nip') }}">
                        <br>
                        @error('nip')
                            <small class="text-red-500 font-bold">{{ $message }}</small>
                        @enderror

                        <p class=" text-[#2C3E50] mt-1 font-[quicksands] text-lg font-semibold">
                            No Telepon
                        </p>
                        <input name="no_hp" placeholder="No Telepon Guru" type="number" class="font-bold pl-3 outline-none w-full h-8 rounded-md border-solid border-[1px] border-[#2C3E50]" value="{{ old('no_hp') }}"><br>
                        @error('no_hp')
                            <small class="text-red-500 font-bold">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- sub judul 2 -->
                <h2 class="mt-3 items-end text-xl text-[#2C3E50] font-[montserrat] font-semibold mb-2">
                    Akun guru
                </h2>

                <!-- input akun guru -->
                <div class="flex">

                    <!-- inputan kiri -->
                    <div class="w-1/2 h-fit mr-5">
                        <p class="text-[#2C3E50] font-[quicksands] text-lg font-semibold">
                            Username
                        </p>
                        <input name="username" placeholder="Username Guru" type="text" class="font-bold pl-3 outline-none w-full h-8 rounded-md border-solid border-[1px] border-[#2C3E50]"value="{{ old('username') }}"><br>
                        @error('username')
                            <small class="text-red-500 font-bold">{{ $message }}</small>
                        @enderror
                    </div>


                    <!-- inputan kanan -->
                    <div class="w-1/2 h-fit">
                        <p class="text-[#2C3E50] font-[quicksands] text-lg font-semibold">
                            Password
                        </p>
                        <input name="password" type="password" placeholder="Password Guru" class="font-bold pl-3 outline-none w-full h-8 rounded-md border-solid border-[1px] border-[#2C3E50]"><br>
                        @error('password')
                            <small class="text-red-500 font-bold">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    </div>
                    
                    <!-- button -->
                    <div class="w-full mt-5 h-[5vh]">
                        <a href="{{ url("/admin") }}"
                            class="font-[quicksands] font-semibold text-[#2C3E50] mr-2 border-[2px] border-[#2C3E50] rounded p-1 px-2">Kembali
                            </a>

                        <button type="submit"
                            class="font-[quicksands] font-semibold bg-[#2C3E50] text-white border-[2px] border-[#2C3E50] rounded w-[12%] h-full">Buat
                            </button>
                    </div>

                    
                </form>

            

</body>

</html>


<!-- npx tailwindcss -i ./src/input.css -o ./public/assets/css/output.css --watch -->