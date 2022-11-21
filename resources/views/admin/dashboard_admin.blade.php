<!DOCTYPE html>
<html lang="en">
<!-- wait for figma -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>
    <!-- style css -->
    <link rel="stylesheet" href="{{ asset('assets/CSS/output.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/suport.css') }}">
    <!-- config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'blue-dark': '#1061FF',
                        'blue-table': '#002C9D',
                        'blue': '#349DFD',
                        'tet': '#001458',
                        'unselect': '#BAC5E7',
                        'tet-x': '#5A5A5A',
                        'stroke': '#81B7E9',
                        'blueside': '#93A2DA',
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

<body class="text-tet h-[100vh] overflow-y-auto">
    <!-- navbar top -->
    @include('partials.navbar_admin')

    <!-- content -->
    <div class="mx-auto w-[81%] flex justify-between">
        <!-- <div class="mx-auto w-[1102px] flex"> use this when u want responsive design -->
        <!-- left content -->
        <div class="w-[65%]">
            <h1 class="text-3xl text-blue font-bold mt-32 mb-5 font-[Montserrat]">Welcome, {{ auth()->guard('admin')->user()->username }}!</h1>
            <!-- box -->
            <div class="flex justify-between ">
                <!-- box 1 -->
                <div class="w-[31%] pl-4 pt-4 pb-4 bg-blue rounded-xl text-white relative">
                    <div class="flex justify-between ">
                        <p>01</p><span class="material-symbols-outlined pr-4">more_vert</span>
                    </div>
                    <div class="mt-3 ml-5 w-fit">
                        <h1 class="w-fit font-medium font-[Montserrat] select-none">Total Kelas</h1>
                        <int class="w-fit font-bold text-2xl">24</int>
                    </div>
                    <img class="absolute bottom-0 right-0 max-w-[35%] -mr-1 " src="{{ asset('assets/img/yellow-blue.png') }}" alt="">
                </div>
                <!-- box 2 -->
                <div class="w-[31%] pl-4 pt-4 pb-4 bg-blue rounded-xl text-white relative">
                    <div class="flex justify-between ">
                        <p>01</p><span class="material-symbols-outlined pr-4">more_vert</span>
                    </div>
                    <div class="mt-3 ml-5 w-fit">
                        <h1 class="w-fit font-medium font-[Montserrat]">Total Guru</h1>
                        <int class="w-fit font-bold text-2xl">24</int>
                    </div>
                    <img class="absolute bottom-0 right-0 max-w-[35%] -mr-1" src="{{ asset('assets/img/yellow-blue.png') }}" alt="">
                </div>
                <!-- box 3 -->
                <div class="w-[31%] pl-4 pt-4 pb-4 bg-blue rounded-xl text-white relative">
                    <div class="flex justify-between ">
                        <p>01</p><span class="material-symbols-outlined pr-4">more_vert</span>
                    </div>
                    <div class="mt-3 ml-5 w-fit">
                        <h1 class="w-fit font-medium font-[Montserrat]">Total Mapel</h1>
                        <int class="w-fit font-bold text-2xl">24</int>
                    </div>
                    <img class="absolute bottom-0 right-0 max-w-[35%] -mr-1" src="{{ asset('assets/img/yellow-blue.png') }}" alt="">
                </div>
            </div>
            <!-- table -->
            <div class="relative">
                <div class="flex justify-end w-full my-5">
                    <button class="bg-blue text-white py-2 px-4 rounded-xl  w-fit font-semibold"
                        onclick="keiAlert('Data Berhasil Disimpan')">+ buat</button>
                </div>
                <div class="border-blue border-[1px] border-solid rounded-xl">
                    <h1 class="text-blue font-extrabold w-fit mx-auto my-1">Akun Guru</h1>
                    <div class="h-56 w-full overflow-y-auto overflow-x-hidden">
                        <table class="w-full" cellpadding="5">
                            <thead class="table-fixed top-0 sticky z-10 bg-white">
                                <tr
                                    class="border-blue-dark border-t-0 border-l-0 border-r-0 border-[1px] border-solid ">
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>NIP</th>
                                    <th>No.tlp</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gurus as $guru)
                                    <tr
                                        class="border-tet-x text-tet-x border-t-0 border-l-0 border-r-0 border-[1px] text-sm border-solid hover:text-blue hover:border-blue cursor-pointer">
                                        <th>{{ $no_guru++ }}</th>
                                        <th class="break-words max-w-[100px]">{{ $guru['name'] }}</th>
                                        <th class="break-words max-w-[100px]">{{ $guru['nip'] }}</th>
                                        <th class="break-words max-w-[100px]">0{{ $guru['no_hp'] }}</th>
                                        <th class="break-words max-w-[100px]">{{ $guru['email'] }}</th>
                                        <th class="break-words max-w-[100px]">{{ $guru['username'] }}</th>
                                        <th class="break-words max-w-[100px]">*********</th>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                        <img class="absolute bottom-0 right-0 max-w-[25%]" style="z-index: -99;"
                            src="{{ asset('assets/img/yellow-blue.png') }}" alt="">
                    </div>
                </div>
            </div>
            <!-- how to use? -->
            <div class="border-blue border-[1px] border-solid rounded-xl my-5 px-5 py-4 relative ">
                <h1
                    class="text-xl w-fit border-solid border-b-2 border-blue text-blue font-bold mb-5 font-[Montserrat]">
                    Apa saja yang bisa Admin lakukan?</h1>
                <div class="overflow-auto h-40">
                    <p>Admin bisa membuat 3 hal:</p>
                    <ol class="ml-5 mb-5">
                        <li>-Kelas</li>
                        <li>-Mata Pelajaran</li>
                        <li>-Akun Guru</li>
                    </ol>
                    <p>Cara Menambahkan: Kelas & Mata Pelajaran</p>
                    <ol class="ml-5 mb-5">
                        <li>1. Perhatikan field/kolom pada tabel di sebelah kanan</li>
                        <li>2. Tiap-tiap tabel kanan, memiliki 1 kolom atau form untuk mengisi tabel dibawahnya</li>
                        <li>3. Form atau data yang dimasukan bisa menjadi Opsi atau Pilihan Guru pada saat memilih studi
                            apa yang mereka ajarkan.</li>
                    </ol>
                    <p>Cara Menambahkan: Akun Guru</p>
                    <ol class="ml-5 mb-5">
                        <li>1. Klik button “+Buat” maka anda akan diarahkan ke halaman pengisian data atau Form</li>
                        <li>2. Dalam form ada 2 Data yang harus terisi di setiap kolom : Data DIri Guru & Akun yang
                            nantinya digunakan Guru</li>
                    </ol>
                </div>
                <img class="absolute bottom-0 left-0 max-w-[15%]" style="z-index: -99;"
                    src="{{ asset('assets/img/yellow-blue-r.png') }}" alt="">
            </div>
        </div>
        <!-- right bar -->
        <div class="w-[33%]">
            <!-- mapel -->
            <div class="mt-[11.5rem] border-blueside text-blueside border-2 border-solid w-[90%] p-4 rounded">
                <h3 class="text-lg font-semibold">Mata Pelajaran</h3>
                <input type="text" class="border-blueside border-2 border-solid w-[68%] rounded"
                    placeholder="Tambah Mapel" id="pelajaran">
                <button class="bg-blueside text-white py-0.5 px-3 rounded w-fit font-semibold" onclick="mapel_simpan()">
                    simpan</button>
                <div class="border-blueside text-blueside border-2 border-solid rounded-lg mt-5 h-60 overflow-y-auto p-2">
                    <table class="w-full text-center">
                        <thead class="table-fixed top-0 sticky z-10 bg-white">
                            <tr class="border-blueside border-t-0 border-l-0 border-r-0 border-[1px] border-solid">
                                <th>No</th>
                                <th>Mapel</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mapels as $mapel)

                            <tr
                                class="border-tet-x text-tet-x border-t-0 border-l-0 border-r-0 border-[1px] text-sm border-solid hover:text-blue hover:border-blue cursor-pointer">
                                <td>{{ $no_mapel++ }}</td>
                                <td>{{ $mapel['pelajaran'] }}</td>
                                <td>Symbols</td>
                            </tr>
                            
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- kelas -->
            <div class="mt-5 border-blueside text-blueside border-2 border-solid w-[90%] p-4 rounded">
                <h3 class="text-lg font-semibold">Kelas</h3>
                <input type="text" class="border-blueside border-2 border-solid w-[68%] rounded"
                    placeholder="Tambah Kelas">
                <button type="submit" class="bg-blueside text-white py-0.5 px-3 rounded w-fit font-semibold">
                    simpan</button>
                <div class="border-blueside text-blueside border-2 border-solid rounded-lg mt-5 h-60 overflow-y-auto p-2">
                    <table class="w-full text-center">
                        <thead class="table-fixed top-0 sticky z-10 bg-white">
                            <tr class="border-blueside border-t-0 border-l-0 border-r-0 border-[1px] border-solid">
                                <th>No</th>
                                <th>Kelas</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelas as $kels)
                            
                            <tr
                                class="border-tet-x text-tet-x border-t-0 border-l-0 border-r-0 border-[1px] text-sm border-solid hover:text-blue hover:border-blue cursor-pointer">
                                <td>{{ $no_kelas++ }}</td>
                                <td>{{ $kels['kelas'] }}</td>
                                <td>Symbols</td>
                            </tr>
                            
                            @endforeach
                    
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="relative -bottom-2">
        <img class="absolute -bottom-5 left-0 max-w-[8%] -mr-1" src="{{ asset('assets/img/l-blue.png') }}" alt="">
        <img class="absolute -bottom-5 right-0 max-w-[8%] -mr-1" src="{{ asset('assets/img/r-blue.png') }}" alt="">
    </div>

    <!-- custom alert -->
    <script src="{{ asset('assets/JS/cstkei.alert.js') }}"></script>

    <script src="{{ asset('assets/JS/jquery.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
            }
        })

        function mapel_simpan(){
            $.ajax({
            url:"/mapel",
            type:"POST",
            data:{
                pelajaran : $("#pelajaran").val()
            },
            success:function(ress){
                console.log(ress)
            }
        })
        }
    </script>
    
    {{-- tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>