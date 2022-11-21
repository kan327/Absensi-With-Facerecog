<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Dashboard</title>
          
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
                            'blue-dark': '#1061FF',
                            'blue-table': '#002C9D',
                            'blue': '#349DFD',
                            'tet': '#001458',
                            'unselect': '#BAC5E7',
                            'tet-x': '#5A5A5A',
                            'stroke': '#81B7E9',
                            'blueside': '#93A2DA',
                        },
                        boxShadow: {
                            nav: '2px 2px 50px 1px rgba(179, 185, 191, 0.1);',
                            side: ' 0px 5px 10px rgba(0, 0, 0, 0.05);',
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
<body>
    {{-- navbar --}}
    @include('partials.navbar_admin')
    {{-- content --}}
    <div class="absolute flex justify-center h-[87%] items-center top-12 w-full">
    
        <!-- card -->
        <div class="flex h-[90%] w-[90%] bg-white">
    
            <!-- one -->
            <div class="flex justify-center items-center h-full w-2/5 ">
                <img src="{{ asset('assets/img/Group 291.png') }}" alt="">
            </div>
    
            <!-- two -->
            <div class="h-full pl-10 w-3/5">
                <!-- judul -->
                <h1
                    class="w-full flex justify-center h-[10%] items-end text-2xl text-[#1A91FF] font-[montserrat] font-semibold">
                    Tambah akun Guru
                </h1>
    
                <!-- sub judul 1 -->
                <h2 class="mt-5 items-end text-xl text-[#1A91FF] font-[montserrat] font-semibold">
                    Data guru
                </h2>
    
                {{-- form --}}
                <form action="/admin/tambah_guru" method="post">
                    @csrf
                    <!-- input data guru -->
                <div class="flex mt-5">
    
                    <!-- inputan kiri -->
                    <div class="w-1/2 h-fit">
                        <p class="text-[#1061FF] font-[quicksands] text-lg font-semibold">
                            Nama Guru
                        </p>
                        <input type="text" name="name" class="font-bold p-2 outline-none w-11/12 h-9 rounded-md border-solid border-[1px] border-[#1061FF]" value="{{ old('name') }}"><br>
                        @error('name')
                            <small class="text-red-500 font-bold">{{ $message }}</small>
                        @enderror
    
                        <p class="mt-6 text-[#1061FF] font-[quicksands] text-lg font-semibold">
                            Email Guru
                        </p>
                        <input type="email" name="email" class="font-bold p-2 outline-none w-11/12 h-9 rounded-md border-solid border-[1px] border-[#1061FF]"  value="{{ old('email') }}"><br>
                        @error('email')
                            <small class="text-red-500 font-bold">{{ $message }}</small>
                        @enderror
                    </div>
    
    
                    <!-- inputan kanan -->
                    <div class="w-1/2 h-fit">
                        <p class="text-[#1061FF] font-[quicksands] text-lg font-semibold">
                            NIP
                        </p>
                        <input type="number" name="nip" class="font-bold p-2 outline-none w-11/12 h-9 rounded-md border-solid border-[1px] border-[#1061FF]"  value="{{ old('nip') }}"><br>
                        @error('nip')
                            <small class="text-red-500 font-bold">{{ $message }}</small>
                        @enderror
    
                        <p class="mt-6 text-[#1061FF] font-[quicksands] text-lg font-semibold">
                            No Telepon
                        </p>
                        <input type="number" name="no_hp" class="font-bold p-2 outline-none w-11/12 h-9 rounded-md border-solid border-[1px] border-[#1061FF]"  value="{{ old('no_hp') }}"><br>
                        @error('no_hp')
                            <small class="text-red-500 font-bold">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
    
                <!-- sub judul 2 -->
                <h2 class="mt-5 items-end text-xl text-[#1A91FF] font-[montserrat] font-semibold">
                    Akun guru
                </h2>
    
                <!-- input akun guru -->
                <div class="mt-5 flex">
    
                    <!-- inputan kiri -->
                    <div class="w-1/2 h-fit">
                        <p class="text-[#1061FF] font-[quicksands] text-lg font-semibold">
                            Username
                        </p>
                        <input type="text" name="username" class="font-bold p-2 outline-none w-11/12 h-9 rounded-md border-solid border-[1px] border-[#1061FF]"  value="{{ old('username') }}"><br>
                        @error('username')
                            <small class="text-red-500 font-bold">{{ $message }}</small>
                        @enderror
                    </div>
    
    
                    <!-- inputan kanan -->
                    <div class="w-1/2 h-fit">
                        <p class="text-[#1061FF] font-[quicksands] text-lg font-semibold">
                            Password
                        </p>
                        <input type="password" name="password" class="font-bold p-2 outline-none w-11/12 h-9 rounded-md border-solid border-[1px] border-[#1061FF]"  value="{{ old('password') }}"><br>
                        @error('password')
                            <small class="text-red-500 font-bold">{{ $message }}</small>
                        @enderror
    
                    </div>
                </div>
                
                
                <!-- Button -->
                <div class="flex justify-between w-full mt-5 pr-7">
                    <a href="/admin" class="  hover:bg-red-500 text-lg text-white font-bold py-2 px-6 rounded-md bg-red-300  ">Kembali</a>
                    <button type="submit" class=" hover:bg-blue text-lg text-white font-bold py-2 px-6 rounded-md bg-[#5BB1FF] ">Create Account</button>
                </form>
            </div>
            </div>
        </div>
    </div>
</body>
</html>