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
    </main>
@endsection