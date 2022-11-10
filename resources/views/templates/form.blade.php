{{-- Content form siswa --}}
    <div class="absolute left-64 w-3/5 bg-white h-fit mt-32 ml-32 rounded-xl shadow-bxsd pb-12  ">
        <h1 class="text-xl ml-24 text-h1 font-bold mt-10 mb-2 font-['Montserrat']">Tambah Data Siswa</h1>
        <div class="border-b-blue border-2 w-10/12 mx-auto"></div>
        <main class="mx-auto mt-5 w-4/5 text-base ">
            <form class="mx-auto item-center flex flex-col" method="post" action="/addprsn_submit">
                <h2 class="font-['Quicksand'] font-semibold text-tet text-ms">Silahkan Isi Data Terlebih Dahulu</h2>
                <input type="hidden" name="id" placeholder="id" class=" text-center border-2 border-blue-dark border-opacity-40 rounded-md w-3/4 mt-4 h-8 mx-auto" value="">
                <input type="text" name="nama" id="nama-siswa" placeholder="Nama Siswa" class=" text-center border-2 border-blue-dark border-opacity-40 rounded-md w-3/4 mt-4 h-8 mx-auto" required>
                <p id="err-1" class="font-['Quicksand'] font-semibold mx-auto text-red-600"></p>
                <select class="text-center border-2 border-blue-dark border-opacity-40 rounded-md mx-auto w-3/4 mt-3 h-8" required name="kelas">
                    <option value="">Kelas</option>
                    <option value="XI-PPLG 1">XI-PPLG 1</option>
                    <option value="XI-PPLG 2">XI-PPLG 2</option>
                </select>
                <select class="text-center border-2 border-blue-dark border-opacity-40 rounded-md mx-auto w-3/4 mt-3 h-8" required name="jkelamin">
                    <option value="">Jenis Kelamin</option>
                    <option value="Laki Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
                <input type="number" placeholder="NISN" class="text-center border-2 border-blue-dark border-opacity-40 rounded-md mx-auto w-3/4 mt-3 h-8" required name="nisn">
                <p id="err-2" class="font-['Quicksand'] font-semibold mx-auto text-red-600"></p>
    
                <input type="submit" id="btn-1" class="text-center bg-gray-400 text-base text-white rounded-md mx-auto w-3/4 mt-3 h-8" value="Pindai Wajah">
            </form>
        </main>
    </div>
