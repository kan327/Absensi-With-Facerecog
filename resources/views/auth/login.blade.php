<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/img/title_logo.png') }}">
    <title>Login Guru | Starbhak Absensi</title>

    {{-- <link rel="stylesheet" href="{{ asset('assets/CSS/login.css') }}"> --}}

    {{-- tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- alert --}}
    <script src="{{ asset('assets/JS/noticme.min.js') }}"></script>
    
    <!-- roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&family=Poppins:wght@600&family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/CSS/suport.css') }}">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'bg-blue-dark': '#2C3E50',
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

<body style=" margin: 0; padding: 0; background-repeat: no-repeat; background-size: cover; overflow: hidden;">
    <img src="{{ asset('assets/img/Login 4-2.png') }}" class="absolute lg:-right-[30%] min-h-[720px] h-[120vh] -top-[10%] lg:w-[70%] lg:block hidden " alt="">
    
    <!-- Container -->
    <div class="flex justify-center w-screen h-screen relative">
        <!-- kiri -->
        <div class="w-2/3  h-full hidden lg:block">
            <!-- nav -->
            <nav class="w-full lg:flex items-center font-bold text-bg-blue-dark justify-evenly h-[8vh] sticky top-0 hidden">
                {{-- <!-- links -->
                <a class="hover:border-b-[3px] text-sm transition-all border-bg-blue-dark bor font-[montserrat]" class="" href="/dokumentasi">Dokumentasi</a>
                <a class="hover:border-b-[3px] text-sm transition-all border-bg-blue-dark font-[montserrat]" href="">Peraturan</a>
                <a class="hover:border-b-[3px] text-sm transition-all border-bg-blue-dark font-[montserrat]" href="">Contact</a> --}}
            </nav>
            <!-- mid text -->
            <div class="h-4/5 lg:flex items-center justify-center text-bg-blue-dark w-full m-0 md:mx-10 md:w-4/5">
                <h1 class="text-4xl">
                    <span class="font-[quicksand] font-medium">Selamat datang di</span> 
                    <span class="font-[montserrat] font-semibold">STARBHAK</span> <br>
                    <span class="font-[poppins] font-semibold">Attendance</span>
                </h1>

            </div>
        </div>
        <!-- kanan -->
        <div class="flex justify-center items-center md:w-1/2 w-[80%] h-screen">
            
            <!-- inputan -->
            <div class="lg:w-3/4 lg:bg-transparent lg:p-0 w-full bg-bg-blue-dark p-10 rounded-xl">

                <!-- judul -->
                    <div class="flex lg:justify-end">
                        <span class="text-white font-[quicksand] text-lg font-bold">Log in</span>
                    </div>

                    <div class="flex lg:justify-end">
                        <span class="text-white mt-3 font-[montserrat] text-2xl font-semibold" id="time"></span>
                    </div>

                    <div class="flex lg:justify-end">
                        <span class="text-white mt-2 font-[quicksand] text-sm font-normal">Silahkan Masukan akun yang sudah diberikan</span>
                    </div>
                    
                    <!-- input -->
                    <form action="/login" method="POST">
                        @csrf
                        <div class="h-fit flex lg:justify-end  w-full">
                            <input placeholder="Masukkan Email" name="email" class="border-b-[1px] placeholder:text-white placeholder:opacity-60 px-2 py-1 lg:w-2/3 w-full mt-5 text-white focus:outline-none bg-transparent" autocomplete="off" value="{{ old('email') }}" type="enail" >
                        </div>

                        <div class="h-fit flex lg:justify-end w-full">
                            <input placeholder="Masukkan Password" name="password" class="border-b-[1px] placeholder:text-white placeholder:opacity-60 px-2 py-1 lg:w-2/3 w-full my-5 text-white focus:outline-none bg-transparent" autocomplete="off" type="password">
                        </div>
    
                        <!-- button -->
                        <div class="w-full flex lg:justify-end items-center  h-1/4 ">
                            <button type="submit" class="font-[quicksand] text-white hover:text-bg-blue-dark lg:mx-0 mx-auto hover:bg-white rounded font-bold py-1 w-2/3 mt-5 border-[1px]">
                                Masuk
                            </button>
                        </div>
                        <div class="w-full flex lg:justify-end items-center mt-5 text-white">
                            <p>Lupa Password?  <span class="font-bold">Hubungi Admin</span></p>
                        </div>
                        @if (Session::has('success'))
                            <script>
                                Noticme.any({
                                    text: "{{ Session::get('success') }}",
                                    type: 'success',
                                    timer: 3000,
                                    button: true
                                })
                            </script>    
                        @endif
                            
                        @if (Session::has('wrong'))
                            <script>
                                Noticme.any({
                                    text: "Gagal !",
                                    message: "{{ Session::get('wrong') }}",
                                    type: 'danger',
                                    button: true
                                })
                            </script>  
                        @endif

                        @error('email')
                            <script>
                                Noticme.any({
                                    text: "Gagal !",
                                    message: "{{ $message }}",
                                    type: 'danger',
                                    button: true
                                })
                            </script> 
                        @enderror

                        @error('password')
                            <script>
                                Noticme.any({
                                    text: "Gagal !",
                                    message: "{{ $message }}",
                                    type: 'danger',
                                    button: true
                                })
                            </script> 
                        @enderror
                    </form>
                    </div>
            </div>

            </div>
        </div>
            
    </div>

    <script>
        let date = new Date()
        let time = document.getElementById("time")

        var date_now = date.getHours()
        
        if(date_now >= 00 && date_now < 10){
            time.textContent = "Selamat Pagi, Guru";
        }else if(date_now >= 10 && date_now <= 15){
            time.textContent += "Selamat Siang, Guru";
        }else if(date_now >= 15 && date_now <= 18){
            time.textContent = "Selamat Sore, Guru";
        }else{
            time.textContent = "Selamat Malam, Guru";
        }

    </script>

</body>

{{-- <!-- Tailwind -->
<script src="https://cdn.tailwindcss.com"></script> --}}
</html>