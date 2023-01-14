@extends('main_guru')

@section('content')
<div class="absolute left-72 w-3/4">
    <!-- card -->
    <div
        class="shadow-box mt-32 p-8 w-5/6 mx-auto rounded-2xl border-solid border-[0.1px] border-opacity-5 border-black">
        <!-- top table -->
        <div>
            <div class="w-fit float-left">
                <h1 class="font-bold text-2xl font-[Montserrat]">Kelola Jadwal</h1>
                <p>Kelola semua jadwal anda dan tambahkan jadwal.</p>
            </div>
            <button class=" px-4 font-[quicksands] py-2 float-right bg-bg-blue-dark rounded-xl text-white font-bold" onclick="location.href='/absensi/tambah_jadwal'">+ Tambahkan Jadwal</button>
        </div>
        <!-- table -->
        <div class="mt-20 h-[50vh] w-full overflow-auto border-bg-blue-dark border-solid border-t-2">
            <form action="">
                <div class="flex justify-between items-center mt-1">
                    <div class="flex my-2 align-middle">
                        {{-- select tahun --}}
                        <select name="tahun" id="tahun" class="border-solid border-2 border-placeholder mt-0.5 p-1 rounded-md mr-3">
                            <option value="{{ $year_now }}">Tahun Saat Ini</option>
                            <option value="{{ $year_now - 1 }}">1 Tahun Yang Lalu</option>
                            <option value="{{ $year_now - 2 }}">2 Tahun Yang Lalu</option>
                            <option value="{{ $year_now - 3 }}">3 Tahun Yang Lalu</option>
                        </select>
                        {{-- select bulan --}}
                        <select name="bulan" id="bulan" class="border-solid border-2 border-placeholder mt-0.5 p-1 rounded-md mr-3">
                            @for ($i = 0; $i < count($nama_bulan); $i++)
                                <option value="{{ $format_bulan[$i] }}">{{ $nama_bulan[$i] }}</option>
                            @endfor
                        </select>
                        {{-- select tanggal --}}
                        <select name="tgl" id="tgl" class="border-solid border-2 border-placeholder mt-0.5 p-1 rounded-md mr-3">
                            <option value="" selected>Pilih Tanggal</option>
                            @foreach ($tanggals as $tanggal)
                                <option value="{{ $tanggal }}">{{ $tanggal }}</option>
                            @endforeach
                        </select>

                        <div onclick="search()" class="relative ml-2">
                            <span class="cursor-pointer material-symbols-outlined absolute top-1.5 left-1 text-placeholder">search</span>
                        </div>
                        {{-- search --}}
                        {{-- <div class="relative ml-2">
                            <span onclick="opensrc('search_01', this)" class="cursor-pointer material-symbols-outlined absolute top-2.5 left-2 text-placeholder">search</span>
                            <input type="text" placeholder="cari jadwal mapel" class="select-none cursor-default w-0 opacity-0 indent-10 placeholder:text-placeholder border-solid border-2 border-placeholder mr-1 mt-0.5 p-1.5 rounded-md" name="" id="search_01">
                            <script>
                                function opensrc(where, __self){
                                    let inp = document.getElementById(where)
                                    if(inp.classList.contains('opacity-0')){
                                        __self.classList.add('text-black')
                                        inp.classList.add('opacity-100')
                                        inp.classList.add('w-full')
                                        inp.classList.remove('select-none')
                                        inp.classList.remove('cursor-default')
                                        inp.classList.remove('w-0')
                                        inp.classList.remove('opacity-0')
                                    }else{
                                        __self.classList.remove ('text-black')
                                        inp.classList.remove('opacity-100')
                                        inp.classList.remove('w-full')
                                        inp.classList.add('w-0')
                                        inp.classList.add('cursor-default')
                                        inp.classList.add('select-none')
                                        inp.classList.add('opacity-0')
                                    }
                                }
                            </script>
                        </div> --}}
                    </div>
                </div>
            </form>
            <table class="w-full font-[quicksands]" cellpadding="2">
                <!-- header table -->
                <thead class="font-extrabold bg-white top-0 sticky z-10">
                    <tr class="text-sm text-placeholder">
                        <th class="p-3">No</th>
                        <th class="p-3">Tanggal</th>
                        <th class="p-3">Kelas</th>
                        <th class="p-3">Matapel</th>
                        <th class="p-3">Mulai</th>
                        <th class="p-3">Selesai</th>
                        <th class="p-3">Aksi</th>
                    </tr>
                </thead>
                <!-- body -->
                <tbody class="text-center text-base font-bold cursor-pointer select-none" id="table_jadwal">

                    

                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="{{ asset('assets/JS/guru.js') }}"></script>
<script src="{{ asset('assets/JS/filter_date.js') }}"></script>
@endsection

