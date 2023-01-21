@extends('main_admin')

@section('content')
<!-- head -->
<header class="md:px-10 pt-5 pb-4 max-w-[85rem] mx-auto">
    <div class="flex md:justify-between mb-5 md:flex-row flex-col">
        <div>
            <h1
                class="text-2xl font-black before:absolute before:w-20 before:h-10 before:border-solid before:border-bg-blue-dark before:border-b-2">
                Welcome To PinoBot!</h1>
        </div>
        <div>
            <form action="">
                <div class="relative w-full">
                    <i class="hidden sm:block"><span class="z-40 cursor-pointer material-symbols-outlined absolute top-2 left-2 text-placeholder">search</span></i>
                    <i class="sm:hidden"><span class="z-40 cursor-pointer material-symbols-outlined absolute top-2 left-2 text-placeholder">search</span></i>
                    <input type="text" id="search" placeholder="cari nama, kelas" class=" w-[100%] indent-10 placeholder:text-placeholder border-solid border-2 border-dark-data mr-1 mt-0.5 p-1 rounded-md" name="">
                </div>
            </form>
        </div>
    </div>
    <div class="flex justify-between w-full lg:items-center lg:flex-row flex-col">
        {{-- sub navbar --}}
        @include('partials.sub_navbar_admin')

            <div>
                <button onclick="location.href = '/admin/grup_kelas'" class="hover:scale-110 hover:bg-bg-blue-dark hover:text-white w-[100%] sm:mt-0 border-2 border-solid border-bg-blue-dark rounded-md py-0.5 px-3">+ Add Group</button>
            </div>
        </div>
    </div>
</header>
<div id="data_grup_kelas" style="box-sizing: content-box !important;"
        class="grid xl:grid-cols-4 md:grid-cols-2 lg:grid-cols-3 gap-3 shadow-box p-1 md:p-5 border-bg-blue-dark border-solid border-t-2 max-w-[85rem] max-h-[100vh] mx-auto overflow-auto scroll-m-0">
    
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