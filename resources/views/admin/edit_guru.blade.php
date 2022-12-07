@extends('main_admin')

@section('content')
<div class="w-[100vw]">
    <!-- card -->
   <div style="border: 1px solid rgba(0, 0, 0, 0.1);
   box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" id="card" 
   class="w-[60%] h-fit rounded-xl shadow-card my-[4%] p-10 mx-auto bg-white">
       <!-- judul -->
       <div class="flex items-center w-full h-[8%]">
           <h1 class="border-b-[2px] border-[#393939]  font-[montserrat] text-2xl text-[#2C3E50] font-bold">
               Edit Akun Guru
           </h1>
       </div>

       <!-- subjudul -->
       <div class="flex mt-2 items-center w-full">
           <h1 class="capitalize font-[quicksands] text-base text-gray-500 font-medium">
               Harap Hati Hati Saat Mengedit Akun Guru.
           </h1>
       </div>

        <!-- inputan -->
       <form class="mt-2 w-full h-1/2" action="/admin/guru/{{ $gurus->id }}" method="POST">
           @csrf
           <!-- sub judul 1 -->
           <h2 class=" items-end text-xl text-[#2C3E50] font-[montserrat] font-semibold mb-2">
               Data guru
           </h2>

           <!-- input data guru -->
           <div class="flex">

               <!-- inputan kiri -->
               <div class="w-1/2 h-fit">
                   <p class="text-[#2C3E50] font-[quicksands] text-lg font-semibold">
                       Nama Guru
                   </p>
                   <input name="name" type="text" class="font-bold pl-3 outline-none w-[90%] h-8 rounded-md border-solid border-[1px] border-[#2C3E50]" value="{{ $gurus->name }}"><br>
                   @error('name')
                       <small class="text-red-500 font-bold">{{ $message }}</small>
                   @enderror

                   <p class=" text-[#2C3E50] font-[quicksands] mt-1 text-lg font-semibold">
                       Email Guru
                   </p>
                   <input name="email" type="email" class="font-bold pl-3 outline-none w-[90%] h-8 rounded-md border-solid border-[1px] border-[#2C3E50]" value="{{ $gurus->email }}"><br>
                   @error('email')
                       <small class="text-red-500 font-bold">{{ $message }}</small>
                   @enderror
               </div>


               <!-- inputan kanan -->
               <div class="w-1/2 h-fit">
                   <p class="text-[#2C3E50] font-[quicksands] text-lg font-semibold">
                       NIP
                   </p>
                   <input name="nip" type="number" class="font-bold pl-3 outline-none w-[90%] h-8 rounded-md border-solid border-[1px] border-[#2C3E50]" value="{{ $gurus->nip }}">
                   <br>
                   @error('nip')
                       <small class="text-red-500 font-bold">{{ $message }}</small>
                   @enderror

                   <p class=" text-[#2C3E50] mt-1 font-[quicksands] text-lg font-semibold">
                       No Telepon
                   </p>
                   <input name="no_hp" type="number" class="font-bold pl-3 outline-none w-[90%] h-8 rounded-md border-solid border-[1px] border-[#2C3E50]" value="{{ $gurus->no_hp }}"><br>
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
           <div class="flex">

               <!-- inputan kiri -->
               <div class="w-1/2 h-fit">
                   <p class="text-[#2C3E50] font-[quicksands] text-lg font-semibold">
                       Username
                   </p>
                   <input name="username" type="text" class="font-bold pl-3 outline-none w-[90%] h-8 rounded-md border-solid border-[1px] border-[#2C3E50]"value="{{ $gurus->username }}"><br>
                   @error('username')
                       <small class="text-red-500 font-bold">{{ $message }}</small>
                   @enderror
               </div>


               <!-- inputan kanan -->
               <div class="w-1/2 h-fit">
                   <p class="text-[#2C3E50] font-[quicksands] text-lg font-semibold">
                       Password
                   </p>
                   <input name="password" type="password" class="font-bold pl-3 outline-none w-[90%] h-8 rounded-md border-solid border-[1px] border-[#2C3E50]" value="{{ $gurus->password }}"><br>
                   @error('password')
                       <small class="text-red-500 font-bold">{{ $message }}</small>
                   @enderror
               </div>
               
               </div>
               
               <!-- button -->
               <div class="w-full mt-5 h-[5vh]">
                   <a href="{{ url("/admin") }}"
                       class="font-[quicksands] font-semibold text-[#2C3E50] mr-2 border-[2px] border-[#2C3E50] rounded p-1 px-2">Kembali
                       </a>

                   <button type="submit"
                       class="font-[quicksands] font-semibold bg-[#2C3E50] text-white border-[2px] border-[#2C3E50] rounded w-[13%] h-full">Buat
                       </button>
               </div>

               
           </form>
@endsection