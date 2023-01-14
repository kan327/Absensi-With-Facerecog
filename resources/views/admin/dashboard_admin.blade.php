@extends('main_admin')

@section('content')
    <!-- head -->
    <header class="flex justify-between px-10 py-5 max-w-[85rem] mx-auto">
        <div>
            <h1
                class="text-2xl font-black before:absolute before:w-20 before:h-10 before:border-solid before:border-bg-blue-dark before:border-b-2">
                Attendance STARBHAK</h1>
            <h2 class="mt-3">Membuat Absensi sekolah menjadi Sistematis dan Efisien</h2>
        </div>
        <div>
            <button onclick="location.href='/dokumentasi/admin'" class="hover:bg-bg-blue-dark hover:text-white px-7 py-1 mt-5 border-bg-blue-dark border-solid border-2 rounded-md font-bold">Dokumentasi</button>
        </div>
    </header>
    <!-- box -->
    <div class="grid grid-cols-4 gap-6 shadow-box p-5 rounded-t-none rounded border-bg-blue-dark border-solid border-t-2 max-w-[85rem] mx-auto" id="box">

    {{-- box --}}

    </div>
    <!-- layout Main -->
    <main class="my-10 max-w-[85rem] mx-auto pb-10">
        <!-- container -->
        <div class="flex justify-between">
            <!-- table data guru -->
            <div class="shadow-box p-5 w-[66%] rounded-2xl border-solid border-[0.1px] border-opacity-5 border-black" id="akun_guru">
                <!-- top table -->
                <div class="flex items-center justify-between">

                    <div class="w-fit">
                        <h1 class="font-bold text-2xl font-[Montserrat]">Data Guru</h1>
                        <p>Kelola akun guru dengan menambah atau mengubah.</p>
                    </div>

                    <div class="flex">
                        {{-- search --}}
                        <form action="">
                            <input id="search_guru" type="text" class=" border-solid border-2 border-dark-data mr-1 mt-0.5 py-1 px-2 rounded-md"
                                placeholder="Cari nama guru">
                        </form>
                        <button
                            class=" px-4  w-[40%] py-1 float-right bg-bg-blue-dark rounded-md text-white font-bold" onclick="location.href = 'admin/guru'">Tambah
                            Guru</button>
                    </div>
                </div>
                <!-- table -->
                <div class="mt-5 h-[50vh] w-full relative overflow-auto border-bg-blue-dark border-solid border-t-2" >
                    <table class="w-full " cellpadding="2">
                        <!-- header table -->
                        <thead class="font-extrabold bg-white top-0 sticky z-10">
                            <tr class="text-sm text-placeholder">
                                <th class="p-3">No</th>
                                <th class="p-3">Nama</th>
                                <th class="p-3">NIP</th>
                                <th class="p-3">Username</th>
                                <th class="p-3">Password</th>
                                <th class="p-3">Aksi</th>
                            </tr>
                        </thead>
                        <!-- body -->
                        <tbody class="text-center text-base font-bold cursor-pointer select-none" id="data_guru">
                            
                            {{-- table guru --}}

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- tabel data mapel -->
            <div class="w-[33%] shadow-box p-5 rounded-2xl border-solid border-[0.1px] border-opacity-5 border-black" id="data_mapel">
                <div>
                    <h1 class="font-bold text-2xl font-[Montserrat]">Mata Pelajaran</h1>
                    <p>Kelola mata pelajaran untuk guru.</p>
                </div>
                <div class="flex">
                    <form action="" class="mr-20">
                        <input type="text" id="pelajaran" class="border-solid border-2  border-dark-data mr-2 mt-0.5 py-1 px-2 rounded-md"
                            placeholder="Mapel baru">
                    </form>
                    <button
                        class=" w-[34%] px-4  py-2 float-right bg-bg-blue-dark rounded-md text-white font-bold" onclick="mapel_simpan()">+
                        Mapel</button>
                </div>
                <!-- table -->
                <div class="mt-5 h-[50vh] w-full overflow-auto border-bg-blue-dark border-solid border-t-2">
                    <table class="w-full " cellpadding="2">
                        <!-- header table -->
                        <thead class="font-extrabold bg-white top-0 sticky z-10">
                            <tr class="text-sm text-placeholder">
                                <th class="p-3">No</th>
                                <th class="p-3">Mapel</th>
                                <th class="p-3">Aksi</th>
                            </tr>
                        </thead>
                        <!-- body -->
                        <tbody class="text-center text-base font-bold cursor-pointer select-none" id="table_mapel">
                            {{-- table_mapel --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- tabel data murid -->
        <div class="flex justify-between mt-5">
            <div class="shadow-box p-5 w-[66%] rounded-2xl border-solid border-[0.1px] border-opacity-5 border-black">
                <!-- top table -->
                <div class="flex items-center justify-between">
                    <div class="w-fit">
                        <h1 class="font-bold text-2xl font-[Montserrat]">Data Siswa</h1>
                        <p>Kelola data siswa.</p>
                    </div>
                    <div class="flex">
                        <form action="">
                            <input id="search_siswa" type="text" class="border-solid border-2 border-dark-data mr-1 mt-0.5 py-1 px-2 rounded-md"
                                placeholder="Cari nama siswa">
                        </form>
                        
                    </div>
                </div>
                <!-- table -->
                <div class="mt-5 h-[50vh] relative w-full overflow-auto border-bg-blue-dark border-solid border-t-2">
                    <table class="w-full" cellpadding="2">
                        <!-- header table -->
                        <thead class="font-extrabold bg-white top-0 sticky z-10">
                            <tr class="text-sm text-placeholder">
                                <th class="p-3">No</th>
                                <th class="p-3">Nama</th>
                                <th class="p-3">Tgl/Lahir</th>
                                <th class="p-3">Jenis Kelamin</th>
                                <th class="p-3">Kelas</th>
                                <th class="p-3">Aksi</th>
                            </tr>
                        </thead>
                        <!-- body -->
                        <tbody class="text-center text-base font-bold cursor-pointer select-none" id="data_siswa">
                            
                            {{-- table siswa --}}

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="w-[33%] shadow-box p-5 rounded-2xl border-solid border-[0.1px] border-opacity-5 border-black" id="data_mapel">
                <div>
                    <h1 class="font-bold text-2xl font-[Montserrat] mb-3">Jadwal Absen</h1>
                </div>
                <div class="flex ">
                    {{-- <form action="" class="mr-20">
                        <input type="text" id="search_jadwal" class="border-solid border-2  border-dark-data mr-2 mt-0.5 py-1 px-2 rounded-md"
                            placeholder="Cari Jadwal Absen">
                    </form> --}}
                </div>
                <!-- table -->
                <div class="mt-5 h-[50vh] w-full overflow-auto border-bg-blue-dark border-solid border-t-2">
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
                    <table class="w-full " cellpadding="2">
                        <!-- header table -->
                        <thead class="font-extrabold bg-white top-0 sticky z-10">
                            <tr class="text-sm text-placeholder">
                                <th class="p-3">No</th>
                                <th class="p-3">Pelajaran</th>
                                <th class="p-3">Tanggal</th>
                            </tr>
                        </thead>
                        <!-- body -->
                        <tbody class="text-center text-base font-bold cursor-pointer select-none" id="table_jadwal">
                            {{-- table_jadwal --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <script src="{{ asset('assets/js/filter_date_admin.js') }}"></script>
@endsection