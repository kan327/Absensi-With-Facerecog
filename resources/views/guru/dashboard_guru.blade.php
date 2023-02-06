@extends('main_guru')

@section('content')
<!-- content -->
<div class="absolute vp-860:left-72 sm:pl-10 vp-860:pr-20 vp-860:pl-10 pr-2 pl-2 sm:pr-10 vp-860:w-3/4 w-[100vw] //lgs:bg-black //bg-transparent mx-auto max-w-7xl">
    <h1 class="md:text-3xl text-2xl font-bold mt-32 sm:text-left text-center font-[Montserrat]">Hai, {{ auth()->user()->username }}!</h1>
    <div class="mt-10 grid sm:grid-cols-2 lgs:grid-cols-3 w-full gap-10 lg:px-5 sm:p-1 p-1">
        <!-- box 1 session -->
        @if (count($live_absens) > 0)
        @foreach ($live_absens as $live_absen)
            <div onclick="location.href= '/absen_siswa/{{ $live_absen->tanggal }}/{{ $live_absen->kelas_id }}/{{ $live_absen->mapel_id }}'"
                class="items-center hover:bg-bg-blue-dark hover:text-white shadow-box border-solid border-[0.1px] border-opacity-5 border-black p-6 rounded-md w-[100%] flex justify-between">
                <div>
                    <h3 class="font-semibold text-sm">Sesi Aktif</h3>
                    <h2 class="text-md md:text-lg lg:text-xl font-extrabold">{{$live_absen->kelas->kelas}}</h2>
                </div>
                <int class="font-bold text-xl md:text-2xl mt-2">Masuk</int>
            </div>
        @endforeach
        @else
            <div
                class="items-center hover:bg-bg-blue-dark hover:text-white shadow-box border-solid border-[0.1px] border-opacity-5 border-black p-6 rounded-md w-[100%] flex justify-between">
                <div>
                    <h3 class="font-semibold text-sm">Sesi Aktif</h3>
                    <h2 class="text-md md:text-lg lg:text-xl font-extrabold">Tidak Ada Sesi Aktif</h2>
                </div>
                <int class="font-bold text-xl md:text-2xl mt-2"></int>
            </div>
        @endif
        <!-- box 2 -->
        <div @if($jum_kelas > 0 && $jum_mapel > 0)onclick = "location.href= '/absensi/tambah_jadwal'"@else onclick="validate('Anda Harus Memilih Kelas Dan Mapel')"@endif 
            class="items-center hover:bg-bg-blue-dark hover:text-white shadow-box border-solid border-[0.1px] border-opacity-5 border-black p-6 rounded-md w-[100%] flex justify-between">
            <div>
                <h3 class="font-semibold text-sm">Jadwal</h3>
                <h2 class="text-md md:text-lg lg:text-xl font-extrabold">Mata Pelajaran</h2>
            </div>
            <int class="font-bold"><span class="material-symbols-outlined" style="font-size: 40px;">add_box</span>
            </int>
        </div>
        <!-- box 3 -->
        <div
            class="items-center hover:bg-bg-blue-dark hover:text-white shadow-box border-solid border-[0.1px] border-opacity-5 border-black p-6 rounded-md w-[100%] flex justify-between web-hover">
            <div>
                <h3 class="font-semibold text-sm">Total</h3>
                <h2 class="text-md md:text-lg lg:text-xl font-extrabold">Kelas Anda!</h2>
            </div>
            <int class="font-bold text-sm mt-2 h-10 w-[80px] overflow-y-auto overflow-x-hidden">
                @foreach ($gurus as $guru)
                @foreach ($guru->guru_kelas as $kelas_guru)
                    {{ $kelas_guru->kelas }}<br>
                @endforeach
            @endforeach</int>
        </div>
        <!-- -- -->
    </div>
    <!-- contains 2 big box -->
    <div class="mt-10 flex w-full justify-evenly lg:flex-row flex-col sm:px-1 px-1 lg:px-0">
        <!-- box 1 bio -->
        <div
            class="shadow-box lg:w-[28%] w-full border-solid border-[0.1px] border-opacity-5 p-5 text-center border-black rounded-md text-dark-data lg:mb-0 mb-10">
            <h1 class="font-bold text-md md:text-lg lg:text-xl font-[Montserrat]">{{ auth()->user()->name }}</h1>
            <p>GURU</p>
            <h2 class="mt-5 font-semibold font-[Montserrat]">Mata Pelajaran</h2>
            <div class="h-20 overflow-auto">
                @foreach ($gurus as $guru)
                    @foreach ($guru->guru_mapel as $mapel_guru)
                        {{ $mapel_guru->pelajaran }}<br>
                    @endforeach
                @endforeach
            </div>
            <button onclick="location.href = '/profile'" class="px-4 py-1 mt-5 border-bg-blue-dark border-solid border-2 rounded-md font-bold">Detail Profil</button>
        </div>
        <!-- box 2 -->
        <div
            class="p-5 flex flex-col lg:w-[65%] w-full shadow-box border-solid border-[0.1px] border-opacity-5 text border-black rounded-md">
            <div class="flex sm:flex-row flex-col justify-between border-bg-blue-dark border-solid border-b-2">
                <h1 class="text-md md:text-lg lg:text-xl font-extrabold  font-[Montserrat] w-fit">Data absen terbaru</h1>
                <p class="text-dark-data font-[Montserrat]">{{ $tanggal }}</p>
            </div>
            <!-- table -->
            <div class="mt-0 h-[30vh] w-full overflow-auto">
                <table class="w-full min-w-[525px]" cellpadding="2">
                    <!-- header table -->
                    <thead class="font-extrabold bg-white top-0 sticky z-10">
                        <tr class="text-sm text-placeholder">
                            <th class="p-3">No</th>
                            <th class="p-3">Nama</th>
                            <th class="p-3">Kelas</th>
                            <th class="p-3">Masuk</th>
                            <th class="p-3">Pulang</th>
                        </tr>
                    </thead>
                    <!-- body -->
                    <tbody class="text-center font-bold text-n-tet-x cursor-pointer select-none">
                        @if (count($live_siswa_absens) > 0 )
                        @foreach ($live_siswa_absens as $live_siswa_absen)
                        <tr class="hover:bg-[#F5F5F5] rounded-full in-hover-to"
                            onclick="location.href = 'javascript:void(0)'">
                            <!-- please delete or reuse this onclick-->
                            <td class="p-3" style="border-top-left-radius: 12px; border-bottom-left-radius: 12px;">{{ $no_absen++ }}
                            </td>
                            <td class="p-3">{{ $live_siswa_absen->siswa->nama_siswa }}</td>
                            <td class="p-3">{{ $live_siswa_absen->kelas->kelas }}</td>
                            <td class="p-3">{{ $live_siswa_absen->masuk }}</td>
                            <td class="p-3"
                                style="border-top-right-radius: 12px; border-bottom-right-radius: 12px;">{{ $live_siswa_absen->pulang }}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <!-- -- -->
    </div>
</div>


@if (Session::has("validate"))
    <script>
        validate("{{ Session::get('validate') }}")
    </script>
@endif
@endsection