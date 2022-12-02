<!-- total -->
<div
class="relative shadow-box font-[Montserrat] w-full p-5 rounded-lg border-solid border-[0.1px] border-opacity-5 border-[#81B7E980]">
<div class="flex items-center justify-between">
    <div>
        <h1
            class="font-[Montserrat] before:w-1/2 before:h-6 before:border-solid before:border-bg-blue-dark before:border-b-2 before:block before:absolute">
            Murid</h1>
        <p>Total murid yang terdaftar.</p>
    </div>
    <int class="font-[Montserrat] text-3xl font-black">{{ count($data_siswas) }}</int>
</div>
</div>
<!-- hadir -->
<div
class="relative shadow-box font-[Montserrat] w-full my-3 p-5 rounded-lg border-solid border-[0.1px] border-opacity-5 border-[#81B7E980]">
<div class="flex items-center justify-between">
    <div>
        <h1
            class="font-[Montserrat] before:w-1/2 before:h-6 before:border-solid before:border-bg-blue-dark before:border-b-2 before:block before:absolute ">
            Hadir</h1>
        <p class="">Murid yang sudah berada di dalam kelas.</p>
    </div>
    <int class="font-[Montserrat] text-3xl font-black" id="hadir">{{ count($hadirs) }}</int>
</div>
</div>
<!-- belum hadir -->
<div
class="relative shadow-box font-[Montserrat] w-full p-5 rounded-lg border-solid border-[0.1px] border-opacity-5 border-[#81B7E980]">
<div class="flex items-center justify-between">
    <div>
        <h1
            class="font-[Montserrat] before:w-1/2 before:h-6 before:border-solid before:border-bg-blue-dark before:border-b-2 before:block before:absolute">
            Belum Hadir</h1>
        <p>Siswa yang belum berada di kelas.</p>
    </div>
    <int class="font-[Montserrat] text-3xl font-black" id="belum_hadir">{{ count($belum_hadir) }}</int>
</div>
</div>

{{-- manipulasi text content belum hadir --}}
<script>
    var belum_hadir = document.getElementById("belum_hadir")
    var hadir = document.getElementById("hadir")

    if (belum_hadir.textContent == "0") {
        belum_hadir.textContent = "-"
    }
    
    if(hadir.textContent == "0"){
        hadir.textContent = "-"
    }
</script>