<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/img/title_logo.png') }}">
    <title>Scan Wajah | Starbhak Absensi</title>
    <!-- css link -->
    <link rel="stylesheet" href="{{ asset('assets/CSS/output.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/suport.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- jquery --}}
    {{-- <script src="{{ asset('assets/JS/jquery.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
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
                        'bg-blue-dark': '#2C3E50',
                        'dark-data': '#393939',
                        'placeholder': '#A0A0A0',
                        'bg': '#FCFCFF',
                    },
                    boxShadow: {
                        nav: '2px 3px 3px 1px rgba(0, 0, 0, 0.1);',
                        side: ' 0px 5px 10px rgba(0, 0, 0, 0.05);',
                        stable: ' 0px 3px 4px rgba(0, 0, 0, 0.25);',
                        box: ' 0px 4px 4px rgba(0, 0, 0, 0.25)',
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

<body class="text-tet">
    
    {{-- navbar --}}
    @include('partials.navbar')

    {{-- sidebar --}}
    @include('partials.sidebar')

    <div class="absolute left-64 w-3/4 bg-white h-fit mt-32 ml-12 rounded-xl shadow-bxsd pb-12  ">
        <div class="border-b-blue border-2 w-10/12 mx-auto pb-4">
            <h1 class="text-xl ml-24 text-h1 font-bold mt-10 mb-2 font-['Montserrat']">Pengambilan Wajah Siswa</h1>
            <form method="POST" action="/data_siswa/tambah_murid/simpan">
                @csrf
                <input type="hidden" name="id_siswa" value="{{ $id_siswa }}">
                <input type="hidden" name="nama_siswa" value="{{ $nama_siswa }}">
                <div class="row">
                    <div class="block" id="photo">
                        <div id="my_camera" class="mx-auto"></div>
                        <div id="results" class="mx-auto"></div>
                    </div>
                    <div class="flex justify-content flex-col">  
                        <input type=button value="Ambil Wajah" onClick="take_snapshot()" class="text-center px-[20%] py-2 cursor-pointer bg-white hover:bg-bg-blue-dark text-bg-blue-dark hover:text-white border border-bg-blue-dark rounded-md font-bold mt-8 flex mx-auto mb-2" style="display: block;" id="button1">
                        <input type="hidden" name="image" class="image-tag">
                        <button class="px-[20%] py-2 cursor-pointer bg-white hover:bg-bg-blue-dark text-bg-blue-dark hover:text-white border border-bg-blue-dark rounded-md font-bold mt-8 flex mx-auto mb-2" style="display: none;" id="button2">Simpan Wajah</button>
                        
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- alert --}}
    <script src="{{ asset('assets/JS/noticme.min.js') }}"></script>
    @if (Session::has("success"))
        <script>
            Noticme.any({
                text: "{{ Session::get('success') }}",
                type: 'success',
                timer: 2000,
                button: false
            })
        </script>
    @endif
    {{-- cam js --}}
    <script src="{{ asset('assets/JS/noticme.min.js') }}"></script>
    <script>
        var button1 = document.getElementById("button1")
        var button2 = document.getElementById("button2")
        var results = document.getElementById("results")
        var video = document.getElementById("my_camera")
        Webcam.set({
            width: 600,
            height: 450,
            image_format:'jpg',
            jpeg_quality: 1200
        });
        
        Webcam.attach('#my_camera');
        
        function take_snapshot() {
            button1.style.display = "none"
            button2.style.display = "block"
            video.style.display = "none"

            Webcam.snap( function(data_uri) {
                $(".image-tag").val(data_uri);
                results.innerHTML = '<img src="'+data_uri+'" name="image" id="image" class="mx-auto"/>';
            } );
        }
    </script>
</body>
</html>
      
