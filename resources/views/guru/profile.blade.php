<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Starbhak Absensi</title>

    {{-- tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- alert --}}
    <script src="{{ asset('assets/JS/cstkei.alert.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('assets/CSS/output.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/suport.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <style>
        li {
            list-style: none;
        }

        li label {

            display: inline-block;
            background-color: rgba(255, 255, 255, .9);
            color: #A0A0A0;
            border-radius: 8px;
            white-space: nowrap;
            margin: 3px 0px;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-tap-highlight-color: transparent;
            transition: all .2s;
        }

        li label {
            padding: 8px 12px;
            cursor: pointer;
        }

        li label::before {
            display: inline-block;
            font-style: normal;
            font-variant: normal;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            font-size: 12px;
            padding: 2px 6px 2px 2px;

            transition: transform .3s ease-in-out;
        }

        li input[type="checkbox"]:checked+label::before {
            content: "\f00c";
            transform: rotate(-360deg);
            transition: transform .3s ease-in-out;
        }

        li input[type="checkbox"]:checked+label {
            border: 2px solid #2C3E50;
            background-color: #ffffff;
            color: #2C3E50;
            transition: all .2s;
        }

        li input[type="checkbox"] {
            display: absolute;
        }

        li input[type="checkbox"] {
            position: absolute;
            opacity: 0;
        }
    </style>
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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,500;1,500&display=swap"
        rel="stylesheet">
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&family=Quicksand:wght@600&display=swap"
        rel="stylesheet">
    CSS rules to specify families
</head>

<body class="text-bg-blue-dark">
    <!-- navbar top -->
    @include('partials.navbar')
    
    <!-- Sidebar left -->
    @include('partials.sidebar')

    <!-- content -->

    <div class="absolute left-72 w-3/4">

        <!-- profile -->
        <div class="w-full">
            <h1 class="font-[montserrat] text-bg-blue-dark text-3xl font-bold mt-32">
                Profile
            </h1>

            <!-- input pertama -->
            <div class="flex  w-4/5 ">
                <!-- one -->
                <div class="h-full pl-12 pt-5 w-1/2">
                    <!-- judul input -->
                    <label class="font-[montserrat] text-xl font-semibold">
                        Your NIP
                    </label>

                    <!-- sub judul input -->
                    <p class="text-[#5A5A5A]">
                        NIP will be displayed on the dashboard
                    </p>

                    <!-- input -->
                    <input type="text" readonly value="{{ $data_guru->nip }}"
                        class="w-2/3 pl-3 h-[40px] rounded-lg border-2 border-solid border-[#A0A0A0]">

                    <br></br>

                    <!-- judul input -->
                    <label class="font-[montserrat] text-xl font-semibold">
                        Fullname
                    </label>

                    <!-- sub judul input -->
                    <p class="text-[#5A5A5A]">
                        Your name will be displayed on the dashboard
                    </p>

                    <!-- input -->
                    <input type="text" readonly value="{{ $data_guru->name }}"
                        class="w-2/3 pl-3 h-[40px] rounded-lg border-2 border-solid border-[#A0A0A0]">

                </div>


                <!-- two -->
                <div class="h-full pl-12 pt-5 w-1/2">
                    <!-- judul input -->
                    <label class="font-[montserrat] text-xl font-semibold">
                        Email
                    </label>

                    <!-- sub judul input -->
                    <p class="text-[#5A5A5A]">
                        Your email will be displayed on the dashboard
                    </p>

                    <!-- input -->
                    <input readonly value="{{ $data_guru->email }}"
                        class="w-2/3 pl-3 h-[40px] rounded-lg border-2 border-solid border-[#A0A0A0]">

                    <br></br>

                    <!-- judul input -->
                    <label class="font-[montserrat] text-xl font-semibold">
                        No.Telp
                    </label>

                    <!-- sub judul input -->
                    <p class="text-[#5A5A5A]">
                        Number phone will not displayed on the dashboard
                    </p>

                    <!-- input -->
                    <input type="text" readonly value="{{ $data_guru->no_hp }}"
                        class="w-2/3 pl-3 h-[40px] rounded-lg border-2 border-solid border-[#A0A0A0]">

                </div>

            </div>



        </div>
        <!-- Choose your class -->
        <div class="w-full">
            <h1 class="pt-5 pl-5 font-[montserrat] text-bg-blue-dark text-2xl font-bold ">
                Choose your class

            </h1>
        </div>

        <!-- bagian bawah -->
        <div class="flex pl-12 pt-5 w-full h-[45%]">

            <!-- kiri bawah -->
            <div class="h-full w-1/2 ">
                <!-- judul input -->
                <label class="font-[montserrat] text-xl font-semibold">
                    Class
                </label>
                <!-- checkbox -->
                <form action="/profile" method="post">
                    @csrf
                    <div class="w-4/5 grid grid-cols-2  gap-3">
                    @foreach ($data_kelas as $kelas)
                        <li>
                            <input type="checkbox" @foreach($kelas_gurus as $kelas_guru) @if($kelas_guru->kelas->id == $kelas->id) {{ "checked" }} @endif @endforeach id="checkbox{{ $no_kelas }}" name="kelas[]"
                                value="{{ $kelas->id }}">
                            <label for="checkbox{{ $no_kelas++ }}">{{ $kelas->kelas }}</label>
                        </li>
                    @endforeach
                    </div>
                <!-- </form> -->

            </div>

            <!-- kanan bawah -->
            <div class="h-full w-1/2">
                <!-- judul input -->
                <label class="font-[montserrat] text-xl font-semibold">
                    Subject
                </label>
                <!-- checkbox -->
                <!-- <form action=""> -->
                    <div class="w-4/5 grid grid-cols-2  gap-2">
                        @foreach ($data_mapels as $mapel)
                            <li>
                                <input type="checkbox" @foreach($mapel_gurus as $mapel_guru) @if($mapel_guru->mapel->id == $mapel->id) {{ "checked" }} @endif @endforeach id="mapel{{ $no_mapel }}" name="mapel[]" value="{{ $mapel->id }}">
                                <label for="mapel{{ $no_mapel++ }}">{{ $mapel->pelajaran }}</label>
                            </li>
                        @endforeach
                        <!-- button -->
                        <div class="flex justify-center items-center w-5 h-5">
    
                        </div>
    
                    </div>
                




            </div>


        </div>

        <!-- button -->
        <div class="w-full mb-10">
            <button type="submit" class="px-4 py-1 relative left-[35%] border-bg-blue-dark border-solid border-2 rounded-md font-bold">simpan</button>
        </div>
    </form>
    </div>
</body>

</html>


<!-- npx tailwindcss -i ./src/input.css -o ./public/assets/css/output.css --watch -->