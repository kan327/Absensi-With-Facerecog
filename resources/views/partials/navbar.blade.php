{{-- navbar --}}

<div class="px-16 py-4 shadow-nav flex justify-between w-full bg-white z-10 fixed top-0">
    <h1 class="text-xl font-bold text-blue-dark-10 ">
        StarBhak</h1>
    <div class="flex">
        <p class="py-1 mr-2 font-semibold">
            {{ auth()->guard('user')->user()->username }} |</p>
        <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="bg-blue-600 text-white px-2 py-1 rounded ">
                Log Out</button>
        </form>
    </div>
</div>