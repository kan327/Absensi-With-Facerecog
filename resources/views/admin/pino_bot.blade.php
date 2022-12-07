@extends('main_admin')

@section('content')
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
@endsection