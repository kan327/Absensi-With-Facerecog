@extends('main_admin')

@section('content')
<div class="text-bg-blue-dark ">
    <!-- card -->
    <div style="border: 1px solid rgba(0, 0, 0, 0.1);
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"
        id="card" class="w-[50%] fit rounded-xl shadow-card pt-7 px-10 bg-white mx-auto my-[5%]">
        <!-- judul -->
        <div class="flex items-center w-full h-[8%]">
            <h1 class="font-[montserrat] text-2xl text-[#2C3E50] font-bold">
                Data Siswa | {{ $siswa->first()->kelas->kelas }}
            </h1>
        </div>

        <!-- subjudul -->
        <div class="flex mt-2 items-center border-b-[2px] border-[#393939] w-full h-[5%]">
            <h1 class="mb-2 capitalize font-[quicksands] text-base text-gray-500 font-semibold">
                Edit Data Siswa : {{ $siswa->first()->nama_siswa }}
            </h1>
        </div>

        <!-- inputan -->
        <form class="my-4 w-full h-1/2" action="/admin/murid/{{ $siswa->first()->id }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <label class="font-bold font-[montserrat] text-base text-black" for="name">
                Nama
            </label><br>
            <input name="nama" value="{{ $siswa->first()->nama_siswa }}" placeholder="Nama Lengkap"
                class="font=[quicksand] font-semibold rounded text-bg-blue-dark p-2 w-full h-1/5 border-[#999bba] outline-none focus:border-[#999bba] border-[2px]"
                type="text"><br>
            @error('nama')
                <small class="text-red-600">{{ $message }}</small>
            @enderror


            <div class="flex  mt-3 w-full h-[60%]">
                <div class="w-1/2 h-full">

                    <label class="font-bold font-[montserrat] text-base text-black" for="">
                        Jenis Kelamin
                    </label><br>
                    <select name="jeniskelamin" class=" rounded w-[90%] font-bold text-bg-blue-dark cursor-pointer py-2 px-2  border-[2px] border-[#999bba] ">
                        <option value="" disabled selected hidden>Pilih jenis kelamin</option>
                        <option {{ ($siswa->first()->jenis_kelamin == "Laki-laki") ? "selected" : '' }} value="Laki-Laki">Laki-Laki</option>
                        <option {{ ($siswa->first()->jenis_kelamin == "Perempuan") ? "selected" : '' }} value="Perempuan">Perempuan</option>
                    </select>

                </div>
                <div class="w-1/2 h-full">
                    <label class="font-bold font-[montserrat] text-base text-black" for="">
                        Tanggal Lahir
                    </label><br>
                    <input
                        class="rounded py-[5px] text-bg-blue-dark font-bold px-2 w-full h-1/3 border-[#999bba] outline-none focus:border-[#999bba] border-[2px]"
                        type="date" value="{{ $siswa->first()->tgl_lahir }}" name="tgllahir" required>

                </div>
            </div>

            <!-- button -->
            <div class=" mt-5 w-full h-1/2 flex">

                <div class=" h-full">

                    <div class="flex w-full h-1/2">

                        <div class="flex items-center ">
                            <a href="/admin"
                                class="text-black border-black border-[1px] rounded mr-5 px-5 py-[4%] hover:scale-110 hover:bg-bg-blue-dark hover:text-white">Batal</a>
                        </div>

                        <div class="flex  items-center w-1/2 h-full ">
                            <button
                                class="text-black border-black border-[1px] rounded px-5 py-[3.2%] hover:scale-110 hover:bg-bg-blue-dark hover:text-white"
                                type="submit">Simpan </button>

                        </div>
                    </div>

                    <div class="flex justify-center mt-5  w-full h-1/3">
                        <p class="font-[quicksands] font-medium text-base text-[#595959]">Hati hati saat merubah data siswa!</p>
                    </div>

        </form>
@endsection