{{-- navbar --}}

<nav class="w-[100%] flex flex-col md:flex-row top-0 bg-white md:items-center justify-between font-black pb-3 border-bg-blue-dark border-solid border-b-2">
    <div class="flex">
        <i onclick="openfc('child', 'flex')" class="md:hidden block cursor-pointer"><span class="material-symbols-outlined -mb-3 mr-2">menu</span></i>
        <p><span id="hello"></span>, {{ auth()->guard("admin")->user()->username }}</p>
    </div>
    <div class="child hidden md:items-center flex-col md:flex-row my-2 md:my-0 md:flex">
        <a href="/admin">
            <div class="px-3 py-1 {{ ($title == 'dashboard_admin') ? ' text-white bg-bg-blue-dark border-dark-data border-solid border-b-2 rounded-md mt-2 md:mt-0' : 'mt-2 md:mt-0' }}">
                Attendance
            </div>
        </a>
        <a href="/admin/pino_bot">
            <div class="md:mx-5 px-3 py-1 {{ ($title == 'pino_bot') ? ' text-white bg-bg-blue-dark border-dark-data border-solid border-b-2 rounded-md mt-2 md:mt-0' : 'mt-2 md:mt-0' }}">
                Telegram Bot
            </div>
        </a>
        <a href="/admin/data_kelas">
            <div class=" px-3 py-1 {{ ($title == 'data_kelas_admin') ? ' text-white bg-bg-blue-dark border-dark-data border-solid border-b-2 rounded-md mt-2 md:mt-0' : 'mt-2 md:mt-0' }}">
                Daftar Kelas
            </div>
        </a>
    </div>
    <form action="/logout" class="font-semibold" method="POST">
        @csrf
        <button type="submit" class="child justify-center hidden md:block sm:px-3 sm:py-1 px-1 py-0.5 text-white bg-bg-blue-dark rounded-md items-center">
            <i class="md:hidden block"><span class="material-symbols-outlined text-base">logout</span></i>
            Log Out
        </button>
    </form>
</nav>

<script>
    var hello = document.getElementById("hello"); 

    let date = new Date()

    var date_now = date.getHours()
        
    if(date_now >= 00 && date_now < 10){
        hello.textContent = "Selamat Pagi";
    }else if(date_now >= 10 && date_now <= 15){
        hello.textContent += "Selamat Siang";
    }else if(date_now >= 15 && date_now <= 18){
        hello.textContent = "Selamat Sore";
    }else{
        hello.textContent = "Selamat Malam";
    }
</script>