<!-- content mastersiswa -->
    <div class="absolute left-72 w-3/4">
        <h1 class="text-3xl text-blue font-bold mt-32 font-[Montserrat]">Daftar Siswa</h1>
        <a href="/siswa/tambah">
            <button class="bg-blue text-white py-2 px-4 rounded-xl mt-5 w-fit mx-auto font-semibold">+ Buat</button>
        </a>
        <!-- onclick="keiAlert('Data Berhasil Disimpan')" -->
        <!-- table -->
        <div class="h-96 overflow-auto mt-5">
            <table class="w-full font-[Montserrat]">
                <thead class="text-blue-table bg-white font-extrabold text-xl shadow-stable top-0 sticky z-10">
                    <tr class="">
                        <th class="p-3">NO</th>
                        <th class="p-3">Name</th>
                        <th class="p-3">Kelas</th>
                        <th class="p-3">NISN</th>
                        <th class="p-3">Jenis Kelamin</th>
                        <th class="p-3">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <a href="#">{{ $data }}</a>
                        <tr class="text-center border-tet-x border-t-0 border-l-0 border-r-0 border-[1px] border-solid hover:font-bold cursor-pointer">
                            <td class="p-3">no</td>
                            <td class="p-3"></td>
                            <td class="p-3"></td>
                            <td class="p-3"></td>
                            <td class="p-3"></td>
                            <td class="p-3">
                                <a href="">
                                    <span class="material-symbols-outlined -mb-3 mr-5">edit</span>
                                </a> 
                                <a href="">
                                    <span class="material-symbols-outlined -mb-3 mr-5">folder</span>
                                </a>
                            </td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>