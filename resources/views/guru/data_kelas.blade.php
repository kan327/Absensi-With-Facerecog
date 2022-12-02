<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Kelas | Starbhak Absensi</title>
        <link rel="stylesheet" href="{{ asset('assets/CSS/output.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/CSS/suport.css') }}">
        {{-- alert --}}
        <script src="{{ asset('assets/JS/cstkei.alert.js') }}"></script>
        {{-- tailwind --}}
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <!-- font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Quicksand:wght@600;700&display=swap" rel="stylesheet">
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

<body class="text-bg-blue-dark">
    <!-- navbar top -->
    @include('partials.navbar')

    <!-- Sidebar left -->
    @include('partials.sidebar')

    <!-- content -->
    <div class="absolute left-72 w-3/4">
        <!-- card -->
        <div
            class="shadow-box mt-32 p-8 w-full mx-auto rounded-2xl border-solid border-[0.1px] border-opacity-5 border-black">
            <h2 class="font-[Montserrat] font-semibold text-lg mb-4">Data Kelas</h2>
            <!-- scrolling -->
            <div class="w-full grid grid-cols-3 2xl:grid-cols-4 gap-2">

                @foreach ($kelas_gurus as $kelas_guru)
                    <div class="flex bg-bg-blue-dark p-5 text-white rounded-xl items-center w-full justify-between ">
                        <div class="">
                            <h1>{{ count(App\Models\Siswa::where("kelas_id", $kelas_guru->kelas->id)->get()) }} Siswa</h1>
                            <h1>{{ $kelas_guru->kelas->kelas }}</h1>
                        </div>
                        <button class="border-[1px] border-bg hover:bg-white hover:text-bg-blue-dark border-solid px-2 rounded-md" onclick="location.href='/data_kelas/{{ $kelas_guru->kelas->id }}'">Detail</button>
                    </div>
                @endforeach

            </div>
        </div>   

        @if (Session::has("success"))
            <script>
                keiAlert("{{ Session::get('success') }}", "done", "bg-blue")
            </script>
        @endif

        @if (Session::has("wrong"))
            <script>
                keiAlert("{{ Session::get('wrong') }}", "close", "bg-red-600")
            </script>
        @endif
</body>
</html>