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
            onclick="location.href='/dokumentasi/admin'" class="px-7 py-1 mt-5 border-bg-blue-dark border-solid border-2 rounded-md font-bold">Dokumentasi</button>
        </div>
    </header>
    <!-- box -->
    <div id="box" style="box-sizing: content-box !important;"
        class="grid md:grid-cols-4 gap-y-5 md:gap-y-0 xl:gap-6 md:gap-[45%] mds:gap-[40%] lg:gap-[30%] lgs:gap-[15.5%] shadow-box p-1 md:p-5 border-bg-blue-dark border-solid border-t-2 max-w-[85rem] mx-auto overflow-auto scroll-m-0">
    
    {{-- box --}}

    </div>
    <!-- layout Main -->
    <main class="mt-10 max-w-[85rem] mx-auto">
        <!-- container -->
        <div class="flex justify-between lg:flex-row flex-col">
            <!-- table data guru -->
            <div class="shadow-box p-5 lg:w-[66%] w-full rounded-2xl border-solid border-[0.1px] border-opacity-5 border-black">
                <!-- top table -->
                <div class="flex sm:items-center justify-between sm:flex-row flex-col items-start">
                    <div class="sm:w-1/2">
                        <h1 class="font-bold text-2xl font-[Montserrat]">Data Guru</h1>
                        <p>Kelola akun guru dengan menambah atau mengubah.</p>
                    </div>
                    <div class="flex sm:flex-row flex-col sm:w-fit w-full">
                        {{-- search --}}
                        <form action="">
                            <div class="relative w-full">
                                <i class="hidden sm:block">
                                    <i onclick="opensrcadmin('search_guru', this, 90)" class="fa-solid fa-magnifying-glass z-40 cursor-pointer absolute top-3 left-2 text-placeholder"></i>
                                    {{-- <span  class="">search</span></i> --}}
                                </i>
                                <i class="sm:hidden">
                                    <i onclick="opensrcadmin('search_guru', this, 100)" class="fa-solid fa-magnifying-glass z-40 cursor-pointer absolute top-3 left-2 text-placeholder"></i>
                                    {{-- <span  class="">search</span></i> --}}
                                </i>
                                <input placeholder="cari" class="select-none cursor-default w-[10%] opacity-0 indent-10 placeholder:text-placeholder border-solid border-2 border-dark-data mr-1 mt-0.5 p-1 rounded-md" name="" id="search_guru" type="text">
                            </div>
                        </form>
                        <button
                            class="px-4 sm:w-[35%] sm:mt-0 mt-2 py-2 float-right bg-bg-blue-dark rounded-md text-white font-bold" onclick="location.href = 'admin/guru'">+
                            Guru</button>
                        {{-- PLEASE FIX THS PRBLM, UNDEFINED WHEN I PUT IN ADMIN JS --}}
                        <script>
                            function opensrcadmin(where, __self, size){
                                let inp = document.getElementById(where)
                                if(inp.classList.contains('opacity-0')){
                                    __self.classList.add('text-black')
                                    inp.classList.add('opacity-100')
                                    inp.classList.add('w-['+size+'%]')
                                    inp.classList.remove('select-none')
                                    inp.classList.remove('cursor-default')
                                    inp.classList.remove('w-[10%]')
                                    inp.classList.remove('opacity-0')
                                }else{
                                    __self.classList.remove ('text-black')
                                    inp.classList.remove('opacity-100')
                                    inp.classList.remove('w-['+size+'%]')
                                    inp.classList.add('w-[10%]')
                                    inp.classList.add('cursor-default')
                                    inp.classList.add('select-none')
                                    inp.classList.add('opacity-0')
                                }
                            }
                        </script>
                        {{-- --- --}}
                    </div>
                </div>
                <!-- table -->
                <div class="mt-5 h-[50vh] w-full overflow-auto border-bg-blue-dark border-solid border-t-2 relative">
                    <table class="w-full min-w-[717px]" cellpadding="2">
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
            <div class="lg:w-[33%] lg:my-0 my-5 w-full shadow-box p-5 rounded-2xl border-solid border-[0.1px] border-opacity-5 border-black">
                <div class="flex items-center justify-between lg:flex-col lg:items-start sm:items-start sm:flex-row flex-col">
                    <div class="w-full sm:w-1/2 lg:w-full">
                        <h1 class="font-bold text-2xl font-[Montserrat]">Mata Pelajaran</h1>
                        <p>Kelola mata pelajaran untuk Guru.</p>
                    </div>
                    <div class="flex sm:flex-row flex-col sm:w-fit w-full">
                        <form action="">
                            <input type="text" id="pelajaran" class="lg:mt-0.5 my-1 border-solid border-2 w-full sm:w-[95%] border-dark-data mr-2 p-1 rounded-md"
                                placeholder="Mapel baru">
                        </form>
                        <button class="sm:w-[35%] sm:mt-0 mt-2 px-4 py-2 float-right bg-bg-blue-dark rounded-md text-white font-bold" onclick="mapel_simpan('{{ csrf_token() }}')">+
                            Mapel</button>
                    </div>
                </div>
                <!-- table -->
                <div class="mt-5 h-[50vh] w-full overflow-auto border-bg-blue-dark border-solid border-t-2 relative">
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
        <div class="flex sm:mt-5 justify-between lg:flex-row flex-col">
        <!-- tabel data murid -->
            <div class="shadow-box p-5 lg:w-[66%] w-full rounded-2xl border-solid border-[0.1px] border-opacity-5 border-black">
                <!-- top table -->
                <div class="flex sm:items-center justify-between sm:flex-row flex-col">
                    <div class="sm:w-fit">
                        <h1 class="font-bold text-2xl font-[Montserrat]">Data Murid</h1>
                        <p>Kelola data murid.</p>
                    </div>
                    <div class="flex sm:flex-row flex-col sm:w-fit w-full">
                        <form action="">
                            <div class="relative w-full">
                                <i class="hidden sm:block">
                                    <i onclick="opensrcadmin('search_siswa', this, 90)" class="fa-solid fa-magnifying-glass z-40 cursor-pointer absolute top-3 left-2 text-placeholder"></i>
                                    {{-- <span  class="">search</span></i> --}}
                                </i>
                                <i class="sm:hidden">
                                    <i onclick="opensrcadmin('search_siswa', this, 100)" class="fa-solid fa-magnifying-glass z-40 cursor-pointer absolute top-3 left-2 text-placeholder"></i>
                                    {{-- <span  class="">search</span></i> --}}
                                </i>
                                <input type="text" placeholder="cari" class="select-none cursor-default w-[10%] opacity-0 indent-10 placeholder:text-placeholder border-solid border-2 border-dark-data mr-1 mt-0.5 p-1 rounded-md" name="" id="search_siswa">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- table -->
                <div class="mt-5 h-[50vh] w-full overflow-auto  border-bg-blue-dark border-solid border-t-2 relative">
                    <table class="w-full min-w-[717px]" cellpadding="2">
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
            <div class="lg:w-[33%] lg:my-0 my-5 w-full shadow-box p-5 rounded-2xl border-solid border-[0.1px] border-opacity-5 border-black" id="data_mapel">
                <div>
                    <h1 class="font-bold text-2xl font-[Montserrat]">Jadwal Absen</h1>
                </div>
                <div class="flex ">
                    {{-- <form action="" class="mr-20">
                        <input type="text" id="search_jadwal" class="border-solid border-2  border-dark-data mr-2 mt-0.5 py-1 px-2 rounded-md"
                            placeholder="Cari Jadwal Absen">
                    </form> --}}
                </div>
                <!-- table -->
                <div class="mt-5 h-[50vh] w-full overflow-auto border-bg-blue-dark border-solid border-t-2 relative">
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
                                    <i class="fa-solid fa-magnifying-glass cursor-pointer absolute top-3 left-1 text-placeholder"></i>
                                </div>
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