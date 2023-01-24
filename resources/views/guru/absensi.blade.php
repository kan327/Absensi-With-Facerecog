@extends('main_guru')

@section('content')
<div
    class="absolute vp-860:left-72 sm:pl-10 vp-860:pr-20 vp-860:pl-10 pr-2 pl-2 sm:pr-10 vp-860:w-3/4 w-[100vw] //lgs:bg-black //bg-transparent mx-auto max-w-7xl">
    <!-- card -->
    <div
        class="shadow-box mt-32 p-8 sm:w-5/6 mx-auto rounded-2xl border-solid border-[0.1px] border-opacity-5 border-black">
        <!-- top table -->
        <div class="flex sm:items-center sm:flex-row flex-col w-full justify-between">
            <div class="sm:w-1/2">
                <h1 class="font-bold text-lg sm:text-xl md:text-2xl font-[Montserrat]">Kelola Jadwal</h1>
                <p>Kelola semua jadwal anda dan tambahkan jadwal.</p>
            </div>
            <div class="mt-1 sm:mt-0">
                <button class="px-4 font-[quicksands] py-2 bg-bg-blue-dark rounded-xl text-white font-bold" onclick="location.href='/absensi/tambah_jadwal'">+ Tambahkan
                    Jadwal</button>
            </div>
        </div>
        <!-- table -->
        <div class="mt-5 h-[50vh] w-full overflow-auto border-bg-blue-dark border-solid border-t-2">
            <table class="w-full min-w-[575px] font-[quicksands]" cellpadding="2">
                <div class="top-0 sticky z-10 bg-white">
                    <form action="" class="top-0 sticky z-10 bg-white">
                        <div class="mt-1">
                            <div class="flex my-2">
                                {{-- select tahun --}}
                                <select name="tahun" id="tahun"
                                    class="border-solid border-2 border-placeholder mt-0.5 p-1 rounded-md mr-3">
                                    <option value="{{ $year_now }}">Tahun Saat Ini</option>
                                    <option value="{{ $year_now - 1 }}">1 Tahun Yang Lalu</option>
                                    <option value="{{ $year_now - 2 }}">2 Tahun Yang Lalu</option>
                                    <option value="{{ $year_now - 3 }}">3 Tahun Yang Lalu</option>
                                </select>
                                {{-- select bulan --}}
                                <select name="bulan" id="bulan"
                                    class="border-solid border-2 border-placeholder mt-0.5 p-1 rounded-md mr-3">
                                    @for ($i = 0; $i < count($nama_bulan); $i++)
                                        <option value="{{ $format_bulan[$i] }}">{{ $nama_bulan[$i] }}</option>
                                    @endfor
                                </select>
                                {{-- select tanggal --}}
                                <select name="tgl" id="tgl"
                                    class="border-solid border-2 border-placeholder mt-0.5 p-1 rounded-md mr-3">
                                    <option value="" selected>Pilih Tanggal</option>
                                    @foreach ($tanggals as $tanggal)
                                        <option value="{{ $tanggal }}">{{ $tanggal }}</option>
                                    @endforeach
                                </select>
                                <div onclick="search()" class="relative ml-2">
                                    <span class="cursor-pointer material-symbols-outlined absolute top-1.5 left-1 text-placeholder">search</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- header table -->
                <thead class="font-extrabold bg-white top-12 sticky z-10">
                    <tr class="text-sm text-placeholder">
                        <th class="p-3">No</th>
                        <th class="p-3">Tanggal</th>
                        <th class="p-3">Kelas</th>
                        <th class="p-3">Matapel</th>
                        <th class="p-3">Mulai</th>
                        <th class="p-3">Selesai</th>
                        <th class="p-3"><span class="material-symbols-outlined">tune</span></th>
                    </tr>
                </thead>
                <!-- body -->
                <tbody class="text-center font-bold cursor-pointer select-none" id="table_jadwal">

                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="{{ asset('assets/JS/guru.js') }}"></script>
<script src="{{ asset('assets/JS/filter_date.js') }}"></script>
@endsection

