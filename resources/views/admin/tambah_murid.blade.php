@extends('main_admin')

@section('content')
    <!-- content -->
    <main class="mt-10 max-w-[85rem] mx-auto">
        <!-- card w-[60%] -->
        <div
            class="lg:w-[60%] sm:w-11/12 shadow-box md:mt-20 mx-auto border-solid h-fit xl:p-10 xl:pb-6 p-5 bg-white border-[1px] border-black border-opacity-40 rounded-xl">
            <!-- judul -->
            <div class="flex items-center w-full h-[8%]">
                <h1 class="font-[montserrat] text-lg sm:text-xl md:text-2xl text-[#2C3E50] font-bold">
                    Data Siswa | {{ $kelas->kelas }}
                </h1>
            </div>

            <!-- subjudul -->
            <div class="flex mt-2 items-center border-b-[2px] border-[#393939] w-full h-[5%]">
                <h1 class="mb-2 capitalize font-[quicksands] text-sm md:text-base text-gray-500 font-semibold">
                    Tambah Data Siswa
                </h1>
            </div>

            <!-- inputan -->
            <form class="my-4 w-full h-1/2" action="/admin/data_kelas/tambah_murid" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_siswas" value="{{ $id_siswa[0]->id_siswas }}">
                <input type="hidden" name="kelas" value="{{ $kelas->id }}">
                <label class="font-bold font-[montserrat] text-sm md:text-base text-bg-blue-dark" for="name">
                    Nama
                </label><br>
                <input name="nama" placeholder="Nama Lengkap"
                    class="font-semibold rounded placeholder:placeholder p-2 w-full border-bg-blue-dark outline-none focus:border-dark-data border-[1px]"
                    type="text">


                <div class="flex sm:flex-row flex-col justify-between mt-3 w-full h-[60%]">
                    <div class="sm:w-[45%]">

                        <label class="font-bold font-[montserrat] text-sm md:text-base text-bg-blue-dark" for="">
                            Jenis Kelamin
                        </label><br>
                        <select name="jeniskelamin"
                            class="font-semibold rounded placeholder:placeholder p-2 w-full border-bg-blue-dark outline-none focus:border-dark-data border-[1px]">
                            <option value="" disabled selected hidden>Pilih jenis kelamin</option>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>

                    </div>
                    <div class="sm:w-[45%]">
                        <label class="font-bold font-[montserrat] text-sm md:text-base text-bg-blue-dark" for="">
                            Tanggal Lahir
                        </label><br>
                        <input
                            class="font-semibold rounded placeholder:placeholder p-1.5 w-full border-bg-blue-dark outline-none focus:border-dark-data border-[1px]"
                            type="date" name="tgllahir">

                    </div>
                </div>

                <!-- button -->
                <div class="mt-10">
                    <div class="w-full flex h-[5vh]">
                        <a href="/admin/data_kelas/{{ $kelas->id }}"
                            class="px-[20px] py-1 font-[quicksands] font-semibold text-[#2C3E50] border-[2px] border-[#2C3E50] rounded mr-5 h-full">Batal</a>
                        <button type="submit"
                            class="font-[quicksands] font-semibold bg-[#2C3E50] text-white border-[2px] border-[#2C3E50] rounded w-[100px] h-full">Simpan
                        </button>
                    </div>
                    <div class="mt-2">
                        <p class="font-[quicksands] font-medium text-sm md:text-base text-[#595959]">Apakah anda
                            yakin ingin menambahkan murid?</p>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection