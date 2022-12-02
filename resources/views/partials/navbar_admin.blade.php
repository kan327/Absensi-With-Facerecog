{{-- navbar --}}

<nav class="flex justify-between font-black pb-1 border-bg-blue-dark border-solid border-b-2 items-center">
    <p>Good Morning, {{ auth()->guard("admin")->user()->username }}</p>
    <div class="flex items-center">
        <div class="mr-2 {{ ($title == 'pino_bot') ? 'px-3 py-1 text-white bg-bg-blue-dark rounded-md' : '' }}">
            <a href="/admin/pino_bot">Telegram Bot</a>
        </div>
        <div class="{{ ($title == 'dashboard_admin') ? 'px-3 py-1 text-white bg-bg-blue-dark rounded-md' : '' }}">
            <a href="/admin">Attendance</a>
        </div>
    </div>
    <form action="/logout" method="POST">
        @csrf
        <button type="submit" class="px-3 py-1 text-white bg-bg-blue-dark rounded-md">Log Out</button>
    </form>
</nav>