<!-- box 1 -->
<div class="w-[31%] pl-4 pt-4 pb-4 bg-blue rounded-xl text-white relative">
    <div class="flex justify-between ">
        <p>01</p><span class="material-symbols-outlined pr-4">more_vert</span>
    </div>
    <div class="mt-3 ml-5 w-fit">
        <h1 class="w-fit font-medium font-[Montserrat] select-none">Total Kelas</h1>
        <int class="w-fit font-bold text-2xl">{{ count($kelas) }}</int>
    </div>
    <img class="absolute bottom-0 right-0 max-w-[35%] -mr-1 " src="{{ asset('assets/img/yellow-blue.png') }}" alt="">
</div>
<!-- box 2 -->
<div class="w-[31%] pl-4 pt-4 pb-4 bg-blue rounded-xl text-white relative">
    <div class="flex justify-between ">
        <p>02</p><span class="material-symbols-outlined pr-4">more_vert</span>
    </div>
    <div class="mt-3 ml-5 w-fit">
        <h1 class="w-fit font-medium font-[Montserrat]">Total Guru</h1>
        <int class="w-fit font-bold text-2xl">{{ count($gurus) }}</int>
    </div>
    <img class="absolute bottom-0 right-0 max-w-[35%] -mr-1" src="{{ asset('assets/img/yellow-blue.png') }}" alt="">
</div>
<!-- box 3 -->
<div class="w-[31%] pl-4 pt-4 pb-4 bg-blue rounded-xl text-white relative">
    <div class="flex justify-between ">
        <p>03</p><span class="material-symbols-outlined pr-4">more_vert</span>
    </div>
    <div class="mt-3 ml-5 w-fit">
        <h1 class="w-fit font-medium font-[Montserrat]">Total Mapel</h1>
        <int class="w-fit font-bold text-2xl">{{ count($mapels) }}</int>
    </div>
    <img class="absolute bottom-0 right-0 max-w-[35%] -mr-1" src="{{ asset('assets/img/yellow-blue.png') }}" alt="">
</div>