{{-- navbar --}}

<nav class="flex justify-between font-black pb-1 border-bg-blue-dark border-solid border-b-2 items-center">
    <p><span id="hello"></span>, {{ auth()->guard("admin")->user()->username }}</p>
    <div class="flex items-center">
        <div class="{{ ($title == 'dashboard_admin') ? 'px-3 py-1 text-white bg-bg-blue-dark rounded-md' : '' }}">
            <a href="/admin">Attendance</a>
        </div>
        <div class="mx-5 {{ ($title == 'pino_bot') ? 'px-3 py-1 text-white bg-bg-blue-dark rounded-md' : '' }}">
            <a href="/admin/pino_bot">Telegram Bot</a>
        </div>
        <div class="{{ ($title == 'data_kelas_admin') ? 'px-3 py-1 text-white bg-bg-blue-dark rounded-md' : '' }}">
            <a href="/admin/data_kelas">Daftar Kelas</a>
        </div>
    </div>
    <form action="/logout" method="POST">
        @csrf
        <button type="submit" class="px-3 py-1 text-white bg-bg-blue-dark rounded-md">Log Out</button>
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