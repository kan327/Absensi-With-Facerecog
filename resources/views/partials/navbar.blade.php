<?php 
// session_start();
?>

<div class="px-16 py-4 shadow-nav flex justify-between w-full bg-white z-10 fixed top-0">
    <h1 class="text-xl font-bold text-blue-dark">
        StarBhak</h1>
    <div class="flex">
        <p class="py-1 mr-2 font-semibold">
            {{ $data_guru[0]->name }} |</p>
        <a href="/logout" class=" bg-blue-dark text-white px-2 py-1 rounded cursor-pointer">
            Log Out</a>
    </div>
</div>