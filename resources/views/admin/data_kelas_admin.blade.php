@extends('main_admin')

@section('content')
    <!-- head -->
<header class="flex justify-between flex-col md:flex-row md:px-10 py-5 max-w-[85rem] mx-auto">
    <div>
        <h1
            class="text-2xl font-black md:before:absolute md:before:w-20 md:before:h-10 md:before:border-solid md:before:border-bg-blue-dark md:before:border-b-2">
            Attendance STARBHAK</h1>
        <h2 class="mt-3">Membuat Absensi Sekolah Menjadi Sistematis dan Efisien</h2>
    </div>
    <div class="grid items-center">
        <button
            class="px-7 py-1 mt-5 border-bg-blue-dark border-solid border-2 rounded-md font-bold hover:bg-bg-blue-dark hover:text-white" onclick="location.href=`/dokumentasi/admin`">Dokumentasi</button>
    </div>
</header>
<!-- box -->
<div style="box-sizing: content-box !important;"
        class="grid xl:grid-cols-4 md:grid-cols-2 lg:grid-cols-3 gap-3 shadow-box p-1 md:p-5 border-bg-blue-dark border-solid border-t-2 max-w-[85rem] max-h-[100vh] mx-auto overflow-auto scroll-m-0">
    <!-- box 1 -->
    @foreach ($data_kelas as $kelas)
    <div
        class="relative overflow-hidden bg-white border-bg-blue-dark border-[1px] border-solid rounded-xl h-[150px] shadow-box min-w-[80vw] md:min-w-[280.5px] xl:min-w-[300.5px]">
        <svg class="absolute -right-1" width="102" height="155" viewBox="0 0 102 155" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M102 0H14.9032L0 78.8305L14.9032 155H102V0Z" fill="#2C3E50" />
        </svg>
        <div class="z-10 p-3 flex justify-between relative items-center">
            <div class="text-bg-blue-dark">
                <p class="mb-3">0{{ $loop->iteration }}</p>
                <h2
                    class="max-w-[166px] max-h-8 cursor-default overflow-auto no-scroll text-lg md:text-xl font-semibold before:absolute before:w-32 before:h-8 before:border-solid before:border-bg before:border-b-2">
                    {{ $kelas->kelas }}</h2>
                <p class="max-w-[166px] max-h-8 cursor-default overflow-auto no-scroll">{{ $kelas->nama_walas }}</p>
                <button class="border-[1px] border-bg-blue-dark border-solid px-2 rounded-md mt-3 hover:bg-bg-blue-dark hover:text-white" onclick="location.href=`/admin/data_kelas/{{ $kelas->id }}`">Detail</button>
            </div>
            <int class="text-3xl text-white font-black mr-3 md:mr-0 mt-1 lg:mt-2 lg:m-0 font-[Montserrat] block">{{ count(App\Models\Siswa::where("kelas_id", $kelas->id)->get()) }}
            </int>
        </div>
    </div>        
    @endforeach
    
</div>
<!-- layout Main min-w-[80vh] -->
<main class="mt-10 max-w-[85rem] mx-auto">

</main>


<script>
    function openfc() {
        var close_state = document.getElementsByClassName('child')
        for (let i = 0; i < close_state.length; i++) {
            const element = close_state[i];
            if (element.classList.contains('hidden')) {
                element.classList.remove('hidden')
                element.classList.add('block')
            } else {
                element.classList.remove('block')
                element.classList.add('hidden')
            }
        }
    }
    function opensrcadmin(where, __self, size) {
        let inp = document.getElementById(where)
        if (inp.classList.contains('opacity-0')) {
            __self.classList.add('text-black')
            inp.classList.add('opacity-100')
            inp.classList.add('w-[' + size + '%]')
            inp.classList.remove('select-none')
            inp.classList.remove('cursor-default')
            inp.classList.remove('w-[10%]')
            inp.classList.remove('opacity-0')
        } else {
            __self.classList.remove('text-black')
            inp.classList.remove('opacity-100')
            inp.classList.remove('w-[' + size + '%]')
            inp.classList.add('w-[10%]')
            inp.classList.add('cursor-default')
            inp.classList.add('select-none')
            inp.classList.add('opacity-0')
        }
    }
</script>

@endsection