<!-- Content Tambah Guru -->

<div class="absolute flex justify-center h-[87%] items-center top-20 w-full ">

    <!-- card -->
    <div class="flex h-[90%] w-[90%] bg-white">

        <!-- one -->
        <div class="flex justify-center items-center h-full w-2/5 ">
            <img src="{{ asset('assets/img/Group 291.png') }}" alt="">
        </div>

        <!-- two -->
        <div class="h-full pl-10 w-3/5">
            <!-- judul -->
            <h1
                class="w-full flex justify-center h-[10%] items-end text-2xl text-[#1A91FF] font-[montserrat] font-semibold">
                Tambah akun Guru
            </h1>

            <!-- sub judul 1 -->
            <h2 class="mt-5 items-end text-xl text-[#1A91FF] font-[montserrat] font-semibold">
                Data guru
            </h2>

            {{-- form --}}
            <form action="/admin/tambah_guru" method="post">
                @csrf
                <!-- input data guru -->
            <div class="flex mt-5">

                <!-- inputan kiri -->
                <div class="w-1/2 h-fit">
                    <p class="text-[#1061FF] font-[quicksands] text-lg font-semibold">
                        Nama Guru
                    </p>
                    <input type="text" name="name" class="font-bold p-2 outline-none w-11/12 h-9 rounded-md border-solid border-[1px] border-[#1061FF]" value="{{ old('name') }}"><br>
                    @error('name')
                        <small>{{ $message }}</small>
                    @enderror

                    <p class="mt-6 text-[#1061FF] font-[quicksands] text-lg font-semibold">
                        Email Guru
                    </p>
                    <input type="email" name="email" class="font-bold p-2 outline-none w-11/12 h-9 rounded-md border-solid border-[1px] border-[#1061FF]"  value="{{ old('email') }}"><br>
                    @error('email')
                        <small>{{ $message }}</small>
                    @enderror
                </div>


                <!-- inputan kanan -->
                <div class="w-1/2 h-fit">
                    <p class="text-[#1061FF] font-[quicksands] text-lg font-semibold">
                        NIP
                    </p>
                    <input type="number" name="nip" class="font-bold p-2 outline-none w-11/12 h-9 rounded-md border-solid border-[1px] border-[#1061FF]"  value="{{ old('nip') }}"><br>
                    @error('nip')
                        <small>{{ $message }}</small>
                    @enderror

                    <p class="mt-6 text-[#1061FF] font-[quicksands] text-lg font-semibold">
                        No Telepon
                    </p>
                    <input type="number" name="no_hp" class="font-bold p-2 outline-none w-11/12 h-9 rounded-md border-solid border-[1px] border-[#1061FF]"  value="{{ old('no_hp') }}"><br>
                    @error('no_hp')
                        <small>{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- sub judul 2 -->
            <h2 class="mt-5 items-end text-xl text-[#1A91FF] font-[montserrat] font-semibold">
                Akun guru
            </h2>

            <!-- input akun guru -->
            <div class="mt-5 flex">

                <!-- inputan kiri -->
                <div class="w-1/2 h-fit">
                    <p class="text-[#1061FF] font-[quicksands] text-lg font-semibold">
                        Username
                    </p>
                    <input type="text" name="username" class="font-bold p-2 outline-none w-11/12 h-9 rounded-md border-solid border-[1px] border-[#1061FF]"  value="{{ old('username') }}"><br>
                    @error('username')
                        <small>{{ $message }}</small>
                    @enderror
                </div>


                <!-- inputan kanan -->
                <div class="w-1/2 h-fit">
                    <p class="text-[#1061FF] font-[quicksands] text-lg font-semibold">
                        Password
                    </p>
                    <input type="password" name="password" class="font-bold p-2 outline-none w-11/12 h-9 rounded-md border-solid border-[1px] border-[#1061FF]"  value="{{ old('password') }}"><br>
                    @error('password')
                        <small>{{ $message }}</small>
                    @enderror

                </div>
            </div>
            
            
            <!-- Button -->
            <div class="flex justify-between w-full mt-5 pr-7">
                <a href="/admin" class=" hover:bg-red-300 text-lg text-white font-bold py-2 px-6 rounded-md bg-red-500 ">Kembali</a>
                <button type="submit" class=" hover:bg-[#5BB1FF] text-lg text-white font-bold py-2 px-6 rounded-md bg-[#1061FF] ">Create Account</button>
            </form>
        </div>
        </div>
    </div>
</div>

{{-- onclick="keiAlert('Data Berhasil Disimpan')" --}}
{{--  onclick="keiAlert('Data Berhasil Disimpan')" --}}
