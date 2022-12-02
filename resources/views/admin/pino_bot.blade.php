<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PinoBot | Starbhak Absensi</title>
    {{-- tailwind --}}

    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- custom alert -->
    <script src="{{ asset('assets/JS/cstkei.alert.js') }}"></script>

    {{-- jquery --}}
    <script src="{{ asset('assets/JS/jquery.js') }}"></script>

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

<body class="text-bg-blue-dark h-[100vh] overflow-y-auto  m-5 mt-6">

    <!-- nav -->
    @include('partials.navbar_admin')

    <!-- head -->
    <header class="px-10 pt-5 pb-4 max-w-[85rem] mx-auto">
        <div class="flex justify-between mb-5">
            <!-- caed -->
            <div>
                <h1
                    class="text-2xl font-black before:absolute before:w-20 before:h-10 before:border-solid before:border-bg-blue-dark before:border-b-2">
                    Welcome To PinoBot!</h1>
            </div>
            <!-- search -->
            <div>
                <form action="">
                    <input type="text" id="search" class="px-7 py-1 border-bg-blue-dark border-solid border-2 rounded-md font-bold" placeholder="Search name, class">
                </form>
            </div>
        </div>
        <div class="flex justify-between">

            {{-- sub navbar --}}
            @include('partials.sub_navbar_admin')

            <div>
                <button onclick="location.href = '/admin/grup_kelas'" class="hover:scale-110 hover:bg-bg-blue-dark hover:text-white border-2 border-solid border-bg-blue-dark rounded-md py-0.5 px-3">+ Add Group</button>
            </div>
        </div>
    </header>
    <div class="grid grid-cols-4 gap-4 shadow-box p-5 border-bg-blue-dark border-solid border-t-2 max-w-[85rem] mx-auto" id="data_grup_kelas">
        <!-- box 1 -->

        <!-- foreach -->

        <!-- endforeach -->
        
        </div>
    </div>

    @if (Session::has("success"))
        <script>keiAlert("{{ session()->get('success') }}", 'done', 'bg-[#22c55e]')</script>
    @endif

    <script>
        var search = document.getElementById("search")
        
        // memunculkan card jika search bar kosong
        $(document).ready(function(){
            live_search('')
        })

        // memunculkan card jika search bar di ketik
        search.addEventListener("keyup", function(){
            live_search(search.value)
        })


        function live_search(keyword = ''){
            
            $("#data_grup_kelas").html("<center><h2>Mohon Tunggu Sebentar...<h2><center>")
            $.ajax({
                type: "GET",
                url: "/admin/pino_bot/search",
                data: "search="+keyword,
                success: function (ress) {
                    $("#data_grup_kelas").html(ress)
                }
            })

        }
    </script>
</body>

</html>