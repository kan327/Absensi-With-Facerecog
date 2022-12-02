<div class="px-16 py-4 shadow-nav flex justify-between w-full bg-white z-40 fixed top-0">
    <div class="flex">
        <h1 class="text-base font-semibold font-[Montserrat] bg-bg-blue-dark text-bg rounded-md px-2.5 mr-2 py-1">
            STARBHAK</h1>
        <h1 class="text-xl font-semibold font-[Montserrat]">
            Attendance</h1>
    </div>
    <div class="flex">
        <p class="py-1 mr-2 font-semibold">
            {{ auth()->guard("user")->user()->username }} |</p>
        <form action="/logout", method="post">
            @csrf
            <button type="submit" class="bg-bg-blue-dark text-white px-2 py-1 rounded-md ">
                Log Out</button>
        </form>
    </div>
</div>