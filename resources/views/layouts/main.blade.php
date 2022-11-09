<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"/> <link rel="preconnect" href="https://fonts.googleapis.com"> <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,500;1,500&display=swap"rel="stylesheet">
    <title>@if($title === "dashboard") Dashboard @endif @if($title === "absensi") Absensi @endif</title>
</head>
<body class="text-tet">

    {{-- navbar --}}
    <div class="px-16 py-4 shadow-nav flex justify-between w-full bg-white z-10 fixed top-0">
        <h1 class="text-xl font-bold text-blue-dark">
            StarBhak</h1>
        <div class="flex">
            <p class="py-1 mr-2 font-semibold">
                {{ auth()->guard("user")->user()->username }} |</p>
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded cursor-pointer">
                    Log Out</button>
            </form>
        </div>
    </div>

    {{-- sidebar --}}
    <div class="px-14 py-20 shadow-side w-fit h-[100vh] top-16 fixed">
        <a href="/">
        <div class="{{ ($title === "dashboard") ? 'font-semibold': 'text-unselect' }}"><span class="material-symbols-outlined -mb-3 mr-5">home</span>
            Dashboard
        </div></a>
        <a href="/absensi/">
        <div class="{{ ($title === "absensi") ? 'mt-10 font-semibold' : 'mt-10 text-unselect'}}"><span class="material-symbols-outlined -mb-3 mr-5">library_books</span>
            Absen
        </div></a>
        <a href="/siswa">
            <div class="{{ ($title === "data_siswa") ? 'mt-10 font-semibold' : 'mt-10 text-unselect' }}"><span class="material-symbols-outlined -mb-3 mr-5">assignment_ind</span>
                Data Siswa
            </div>
        </a>
        <div class="{{ ($title === "laporan") ? 'mt-10 font-semibold' : 'mt-10 text-unselect' }}"><span class="material-symbols-outlined -mb-3 mr-5">sms_failed</span>
            Laporan
        </div>
    </div>

    @if ($title === "dashboard")
        @include('guru.guruDashboard')
    @endif

    @if ($title === "absensi")
        @include('guru.absensi')
    @endif

    <!-- custom alert -->
    <script src="{{ asset('assets/JS/cstkei.alert.js') }}"></script>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Alert --}}
    {{-- @if ($status === "success")
        <script>keiAlert('Anda Berhasil Login')</script>
    @endif --}}

</body>
</html>