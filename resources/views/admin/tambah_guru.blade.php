@extends('main_admin')

@section('content')
    <main class="mt-10 max-w-[85rem] mx-auto">
        <!-- card -->
        <div
            class="lg:w-[60%] sm:w-11/12 shadow-box md:mt-20 mx-auto border-solid h-fit xl:p-10 p-5 bg-white border-[1px] border-black border-opacity-40 rounded-xl">
            <!-- judul -->
            <div class="flex items-center w-full h-[8%]">
                <h1
                    class="border-b-[2px] border-[#393939]  font-[montserrat] text-lg sm:text-xl md:text-2xl text-[#2C3E50] font-bold">
                    Tambah Akun Guru
                </h1>
            </div>

            <!-- subjudul -->
            <div class="flex mt-2 items-center w-full">
                <h1 class="capitalize font-[quicksands] text-base text-gray-500 font-medium">
                    Akun yang di tambahkan bisa langsung digunakan oleh guru tersebut.
                </h1>
            </div>

            <!-- inputan -->
            <form class="mt-2 w-full h-1/2" action="/admin/tambah_guru" method="POST">
                @csrf
                <!-- sub judul 1 -->
                <h2 class=" items-end text-lg md:text-xl text-[#2C3E50] font-[montserrat] font-semibold mb-2">
                    Data guru
                </h2>

                <!-- input data guru -->
                <div class="flex sm:flex-row flex-col">

                    <!-- inputan kiri -->
                    <div class="sm:w-1/2 sm:mr-5">
                        <p class="text-[#2C3E50] font-[quicksands] text-base lg:text-lg font-semibold">
                            Nama Guru
                        </p>
                        <div class="flex">
                            <input name="name" placeholder="Nama Guru" type="text" class="font-bold pl-3 outline-none sm:w-[62%] w-[100%] mr-2 h-8 rounded-md border-solid border-[1px] border-[#2C3E50]" value="{{ old('name') }}">
                            <select name="jeniskelamin" id="" class="font-bold pl-3 outline-none  h-8 rounded-md border-solid border-[1px] border-[#2C3E50]">
                                <option value="L">Laki-Laki</option>
                                <option value="P">perempuan</option>
                            </select>
                        </div>
                        @error('name')
                            <small class="text-red-500 font-bold">{{ $message }}</small>
                        @enderror

                        <p class=" text-[#2C3E50] font-[quicksands] mt-1 text-base lg:text-lg font-semibold">
                            Email Guru
                        </p>
                        <input name="email" placeholder="Email Guru" type="email" class="font-bold pl-3 outline-none w-full h-8 rounded-md border-solid border-[1px] border-[#2C3E50]" value="{{ old('email') }}"><br>
                        @error('email')
                            <small class="text-red-500 font-bold">{{ $message }}</small>
                        @enderror
                    </div>


                    <!-- inputan kanan -->
                    <div class="sm:w-1/2">
                        <p class="text-[#2C3E50] font-[quicksands] text-base lg:text-lg font-semibold">
                            NIP
                        </p>
                        <input name="nip" type="number" placeholder="NIP Guru" class="font-bold pl-3 outline-none w-full h-8 rounded-md border-solid border-[1px] border-[#2C3E50]" value="{{ old('nip') }}"><br>
                        @error('nip')
                            <small class="text-red-500 font-bold">{{ $message }}</small>
                        @enderror

                        <p class=" text-[#2C3E50] mt-1 font-[quicksands] text-base lg:text-lg font-semibold">
                            No Telepon
                        </p>
                        <input name="no_hp" placeholder="No Telepon Guru" type="number" class="font-bold pl-3 outline-none w-full h-8 rounded-md border-solid border-[1px] border-[#2C3E50]" value="{{ old('no_hp') }}"><br>
                        @error('no_hp')
                            <small class="text-red-500 font-bold">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- sub judul 2 -->
                <h2 class="mt-3 items-end text-xl text-[#2C3E50] font-[montserrat] font-semibold mb-2">
                    Akun guru
                </h2>

                <!-- input akun guru -->
                <div class="flex sm:flex-row flex-col">

                    <!-- inputan kiri -->
                    <div class="sm:w-1/2 sm:mr-5">
                        <p class="text-[#2C3E50] font-[quicksands] text-base lg:text-lg font-semibold">
                            Username
                        </p>
                        <input name="username" placeholder="Username Guru" type="text" class="font-bold pl-3 outline-none w-full h-8 rounded-md border-solid border-[1px] border-[#2C3E50]" value="{{ old('username') }}"><br>
                        @error('username')
                            <small class="text-red-500 font-bold">{{ $message }}</small>
                        @enderror
                    </div>


                    <!-- inputan kanan -->
                    <div class="sm:w-1/2">
                        <p class="text-[#2C3E50] font-[quicksands] text-base lg:text-lg font-semibold">
                            Password
                        </p>
                        <input name="password" type="password" placeholder="Password Guru" class="font-bold pl-3 outline-none w-full h-8 rounded-md border-solid border-[1px] border-[#2C3E50]"><br>
                        @error('password')
                            <small class="text-red-500 font-bold">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <!-- button -->
                <div class="w-full mt-5 h-[5vh]">
                    <a href="{{ url('/admin') }}"
                    class="font-[quicksands] font-semibold text-[#2C3E50] mr-2 border-[2px] border-[#2C3E50] rounded p-1 px-2">Kembali
                    </a>

                    <button type="submit"
                    class="font-[quicksands] min-w-[85px] font-semibold bg-[#2C3E50] text-white border-[2px] border-[#2C3E50] rounded w-[12%] h-full">Buat
                    </button>
                </div> 
            </form>
        </div>
    </main>
@endsection
