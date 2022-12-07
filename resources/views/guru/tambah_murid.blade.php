<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Siswa | Starbhak Absensi</title>
    <link rel="stylesheet" href="{{ asset('assets/CSS/output.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/suport.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'blue-dark-10': '#1061FF',
                        'blue-purple-3F': '#3F80FF',
                        'blue-normal-19': '#1991FF',
                        'blue-light-34': '#349DFD',
                        'tet': '#393939',
                        'un-x-tet': '#939393',
                        'un-tet': '#8C8C8C',
                    },
                    boxShadow: {
                        nav: '2px 2px 50px 1px rgba(179, 185, 191, 0.1);',
                        side: ' 0px 5px 10px rgba(0, 0, 0, 0.05);',
                    }
                },
            }
        }
    </script>

    <!-- font material ++ -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,500;1,500&display=swap"
        rel="stylesheet">
</head>

<body class="text-bg-blue-dark">

    <!-- navbar top -->
    @include('partials.navbar')

    <!-- Sidebar left -->
    @include('partials.sidebar')

    <!-- content -->
    <div class="absolute flex justify-center items-center text-bg-blue-dark top-20 left-64 h-4/5 w-4/5 ">
         <!-- card -->
        <div style="border: 1px solid rgba(0, 0, 0, 0.1);
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" id="card" 
        class="w-3/5 h-4/5 rounded-xl shadow-card pt-7 px-10 bg-white">
            <!-- judul -->
            <div class="flex items-center w-full h-[8%]">
                <h1 class="font-[montserrat] text-2xl text-[#2C3E50] font-bold">
                    Data Siswa | {{ $kelas->first()->kelas }}
                </h1>
            </div>

            <!-- subjudul -->
            <div class="flex mt-2 items-center border-b-[2px] border-[#393939] w-full h-[5%]">
                <h1 class="mb-2 capitalize font-[quicksands] text-base text-gray-500 font-semibold">
                    Tambah Data Siswa
                </h1>
            </div>

             <!-- inputan -->
            <form class="my-4 w-full h-1/2" action="/data_siswa/tambah_murid" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="kelas" value="{{ $kelas->first()->id }}">
                <label class="font-bold font-[montserrat] text-base text-black" for="name">
                    Nama
                </label><br>
                <input name="nama" placeholder="Nama Lengkap"
                        class="font=[quicksand] font-semibold rounded text-[#6D6D6D] p-2 w-full h-1/5 border-[#9C9C9C] outline-none focus:border-[#6D6D6D] border-[1px]"
                        type="text">


                        <div class="flex  mt-3 w-full h-[60%]">
                            <div class="w-1/2 h-full">
    
                                <label class="font-bold font-[montserrat] text-base text-black" for="">
                                    jenis Kelamin
                                </label><br>
                                <select name="jeniskelamin" class=" rounded w-[90%] h-1/3   border-[1px] border-[#999bba] ">
                                    <option value="" disabled selected hidden>Pilih jenis kelamin</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
    
                            </div>
                            <div class="w-1/2 h-full">
                                <label class="font-bold font-[montserrat] text-base text-black" for="">
                                    Tanggal Lahir
                                </label><br>
                                <input
                                    class="rounded w-full h-1/3 border-[#9C9C9C] outline-none focus:border-[#6D6D6D] border-[1px]"
                                    type="date" name="tgllahir">
    
                            </div>
                        </div>

                         <!-- button -->
                    <div class=" w-full h-1/2 flex">

                        <div class=" h-full">

                            <div class="flex w-full h-1/2">

                                <div class="flex items-center ">
                                    <a href="/data_kelas/{{ $kelas->first()->id }}" class="text-black border-black border-[1px] rounded mr-5 px-5 py-[4%] hover:scale-110 hover:bg-bg-blue-dark hover:text-white">Batal</a>
                                </div>

                                <div class="flex  items-center w-1/2 h-full ">
                                    <button class="text-black border-black border-[1px] rounded w-[70%] h-3/4 hover:scale-110 hover:bg-bg-blue-dark hover:text-white" type="submit">Simpan</button>
                                    
                                </div>
                            </div>

                            <div class="flex justify-center  w-full h-1/3">
                                <p class="font-[quicksands] font-medium text-base text-[#595959]">Apakah anda yakin ingin menambahkan?</p>
                            </div>  
                
            </form>

            

</body>

</html>


<!-- npx tailwindcss -i ./src/input.css -o ./public/assets/css/output.css --watch -->