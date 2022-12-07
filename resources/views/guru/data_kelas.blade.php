@extends('main_guru')

@section('content')
<div class="absolute left-72 w-3/4">
    <!-- card -->
    <div
        class="shadow-box mt-32 p-8 w-full mx-auto rounded-2xl border-solid border-[0.1px] border-opacity-5 border-black">
        <h2 class="font-[Montserrat] font-semibold text-lg mb-4">Data Kelas</h2>
        <!-- scrolling -->
        <div class="w-full grid grid-cols-3 2xl:grid-cols-4 gap-2">

            @foreach ($kelas_gurus as $kelas_guru)
                <div class="flex bg-bg-blue-dark p-5 text-white rounded-xl items-center w-full justify-between ">
                    <div class="">
                        <h1>{{ count(App\Models\Siswa::where("kelas_id", $kelas_guru->kelas->id)->get()) }} Siswa</h1>
                        <h1>{{ $kelas_guru->kelas->kelas }}</h1>
                    </div>
                    <button class="border-[1px] border-bg hover:bg-white hover:text-bg-blue-dark border-solid px-2 rounded-md" onclick="location.href='/data_kelas/{{ $kelas_guru->kelas->id }}'">Detail</button>
                </div>
            @endforeach

        </div>
    </div>   
</div>
@endsection