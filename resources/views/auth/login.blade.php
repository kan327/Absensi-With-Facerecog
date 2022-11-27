<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    {{-- <link rel="stylesheet" href="{{ asset('assets/CSS/login.css') }}"> --}}

    {{-- tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- alert --}}
    <script src="{{ asset('assets/JS/cstkei.alert.js') }}"></script>
    
    <!-- roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&family=Poppins:wght@600&family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
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
                    }
                },
            }
        }
    </script>
</head>

<body style="background-image: url('{{ asset('assets/img/Login 4-1.png') }}'); margin: 0; padding: 0; background-repeat: no-repeat; background-size: cover;">
    <!-- Container -->
    <div class="flex w-screen h-screen">
        <!-- kiri -->
        <div class="w-2/3  h-full ">
            <!-- nav -->
            <nav class="w-full flex items-center font-bold text-[#0E6EAB] justify-evenly h-[10%]">
                <!-- links -->
                <a class="hover:border-b-[3px] text-sm transition-all border-[#0E6EAB] bor font-[montserrat]" class="" href="">Dokumentasi</a>
                <a class="hover:border-b-[3px] text-sm transition-all border-[#0E6EAB] font-[montserrat]" href="">Peraturan</a>
                <a class="hover:border-b-[3px] text-sm transition-all border-[#0E6EAB] font-[montserrat]" href="">Contact</a>
            </nav>
            <!-- mid text -->
            <div class="h-2/3 flex items-center justify-center text-[#0968A8] w-full">
                <h1 class="text-4xl">
                    <span class="font-[quicksand] font-medium">Selamat datang di</span> 
                    <span class="font-[montserrat] font-semibold">STARBHAK</span> <br>
                    <span class="font-[poppins] font-semibold">Attendance</span>
                </h1>

            </div>
        </div>

        <!-- kanan -->
        <div class=" flex justify-center w-1/2 h-full ">
            
            <!-- inputan -->
            <div style="margin-top:25%;" class="w-3/4 h-3/4">

                <!-- judul -->
                    <div class="flex justify-end">
                        <span class="text-white font-[quicksand] text-lg font-bold">Log in</span>
                    </div>

                    <div class="flex justify-end">
                        <span class="text-white mt-3 font-[montserrat] text-2xl font-semibold">Selamat Pagi,Guru!</span>
                    </div>

                    <div class="flex justify-end">
                        <span class="text-white mt-2 font-[quicksand] text-sm font-normal">Silahkan Masukan akun yang sudah diberikan</span>
                    </div>
                    
                    <!-- input -->
                    <form action="/login" method="POST">
                        @csrf
                        <div class="h-fit flex justify-end w-full">
                            <input placeholder="Masukkan Email" name="email" class="border-b-[1px] placeholder:text-white px-2 py-1 w-2/3 mt-5 text-white focus:outline-none bg-transparent" autocomplete="off" type="enail" >
                        </div>

                        <div class="h-fit flex justify-end w-full">
                            <input placeholder="Masukkan Password" name="password" class="border-b-[1px] placeholder:text-white px-2 py-1 w-2/3 my-5 text-white focus:outline-none bg-transparent" autocomplete="off" type="password">
                        </div>
    
                        <!-- button -->
                        <div class="w-full flex justify-end items-center  h-1/4 ">
                            <button type="submit" class="font-[quicksand] text-white rounded font-bold py-1 w-2/3 mt-5 border-[1px]">
                                Masuk
                            </button>
                        </div>
                        @if (Session::has('success'))
                            <script>keiAlert("{{ Session::get('success') }}", 'done', 'bg-[#22c55e]')</script>
                            @endif
                            
                        @if (Session::has('wrong'))
                            <script>keiAlert("{{ Session::get('wrong') }}", 'close', 'bg-red-600')</script>
                        @endif

                        @error('email')
                            <script>keiAlert("{{ $message }}", 'close', 'bg-red-600')</script>
                        @enderror
                        @error('password')
                            <script>keiAlert("{{ $message }}", 'close', 'bg-red-600')</script>
                        @enderror
                    </form>
                    </div>
            </div>

            </div>
        </div>
            
    </div>
</body>

{{-- <!-- Tailwind -->
<script src="https://cdn.tailwindcss.com"></script> --}}
</html>