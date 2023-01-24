<div class="md:px-16 px-2 py-4 shadow-nav flex justify-between w-full bg-white z-40 fixed top-0 ">
    <div class="flex items-center">
        @if(empty($sidebar))
        <i onclick="openfc()" class="vp-860:hidden block cursor-pointer -mb-1"><span class="material-symbols-outlined  mr-2">menu</span></i>
        @endif
        <h1 onclick="location.href='/'" class="font-semibold font-[Montserrat] bg-bg-blue-dark text-bg rounded-md px-2.5 mr-2 py-1">
            STARBHAK</h1>
    </div>
    <div class="flex">
        <p class="py-1 mr-2 font-semibold sm:block hidden">
            {{ auth()->user()->username }} |</p>
        <form action="/logout", method="post">
            @csrf
            <button type="submit" class="bg-bg-blue-dark text-white px-2 py-1 rounded-md ">
                Log Out</button>
        </form>
    </div>
</div>