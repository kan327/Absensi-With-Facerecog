<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <title>Scan Wajah | Starbhak Absensi</title>
    <!-- css link -->
    <link rel="stylesheet" href="{{ asset('assets/CSS/output.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/suport.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- jquery --}}
    <script src="{{ asset('assets/JS/jquery.js') }}"></script>
    <!-- font montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,500;1,500&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Quicksand -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
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
                        'un-tet': '#8C8C8C',
                        'un-x-tet': '#939393',
                    },
                    boxShadow: {
                        nav: '2px 2px 50px 1px rgba(179, 185, 191, 0.1);',
                        side: ' 0px 5px 10px rgba(0, 0, 0, 0.05);',
                    }
                },
            }
        }
    </script>
    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,500;1,500&display=swap" rel="stylesheet">
</head>

<body class="text-tet" onload="configure()">
{{-- <body class="text-tet"> --}}
    
    {{-- navbar --}}
    @include('partials.navbar')

    {{-- sidebar --}}
    @include('partials.sidebar')

    <div class="absolute left-64 w-3/5 bg-white h-fit mt-32 ml-32 rounded-xl shadow-bxsd pb-12  ">
        <div class="border-b-blue border-2 w-10/12 mx-auto">
            <h1 class="text-xl ml-24 text-h1 font-bold mt-10 mb-2 font-['Montserrat']">Pengambilan Wajah Siswa</h1>
            <main class="mx-auto mt-5 w-4/5 text-base ">
                <form action="" class="mx-auto item-center flex flex-col">
                    {{-- @csrf --}}
                    <div class="mx-auto">
                        <div id="mycam" class="mx-auto"></div>
                        <div id="results" style="visibility: hidden; position: absolute;" name="gambar"></div>
                    </div>
                    <br><button onclick="saveSnap()" class="text-center bg-gray-600 text-base text-white rounded-md mx-auto w-3/4 mt-3 h-8">save</button>
                    <a href="/data_siswa/tambah_murid/simpan_dataset" type="button" class="text-center bg-gray-400 text-base text-white rounded-md mx-auto w-3/4 mt-3 h-8 mb-8">
                        Simpan Data
                    </a>
                   
                </form>
            </main>
        </div>
    </div>
    {{-- <script src="https://codepen.io/kan327/pen/PoaZWxe"></script> --}}
    {{-- cam js --}}
    {{-- <script src="{{ asset('cam_js/js/webcam.min.js') }}"></script>
    <script src="{{ asset('assets/JS/noticme.min.js') }}"></script> --}}
    
</body>
</html>
      

    {{-- php
if(isset($_POST['photoStore'])) {
    $encoded_data = $_POST['photoStore'];
    $binary_data = base64_decode($encoded_data);

    $photoname = uniqid().'.jpg';

    $result = file_put_contents('uploadPhoto/'.$photoname, $binary_data);

    if($result) {
        echo 'success';
    } else {
        echo die('Could not save image! check file permission.');
    }
} --}}