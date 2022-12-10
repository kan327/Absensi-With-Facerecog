<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
{{-- <body class="text-tet"> --}}
    
    {{-- navbar --}}
    @include('partials.navbar')

    {{-- sidebar --}}
    @include('partials.sidebar')

    <div class="absolute left-64 w-3/5 bg-white h-fit mt-32 ml-32 rounded-xl shadow-bxsd pb-12  ">
        <div class="border-b-blue border-2 w-10/12 mx-auto pb-14">
            <h1 class="text-xl ml-24 text-h1 font-bold mt-10 mb-2 font-['Montserrat']">Pengambilan Wajah Siswa</h1>
            <div class="mx-auto">
                <div class="mt-5">
                    <div id="my_camera" class="block mx-auto"></div>
                </div>
                <div id="results" class="none"></div>
                <form method="post" id="photoForm">
                    <input type="hidden" id="photoStore" name="photoStore" value="">
                </form>
            </div>
            <div class="flex justify-evenly mt-8">
                <button type="button" class="px-4 py-3 bg-bg-blue-dark rounded-xl text-white font-bold" id="takephoto">Ambil Gambar</button>
                <button type="submit" class="px-4 py-3 bg-bg-blue-dark rounded-xl text-white font-bold" id="uploadphoto" form="photoForm">Upload</button>
            </div>
            <div class="flex justify-content">  
                <a href="/data_siswa/tambah_murid/simpan_dataset" type="button" class="text-center bg-gray-400 text-base text-white rounded-md mx-auto w-3/4 mt-3 h-8 mb-8">
                    Simpan Data
                </a>
            </div>
        </div>
    </div>
    {{-- cam js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/JS/noticme.min.js') }}"></script>
    <script src="{{ asset('cam_js/plugin/webcamjs/webcam.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                }
            });
            Webcam.set({
                width: 320,
                height: 240,
                image_format: 'jpeg',
                jpeg_quality: 90
            });
        
            Webcam.reset();
            Webcam.on('error', function() {
                $('#photoModal').modal('hide');
                Noticme.any({
                    text: "Data Berhasil Ditambahkan",
                    type: 'success',
                    timer: 5000,
                })
            });
            Webcam.attach('#my_camera');
        
            $('#takephoto').on('click', take_snapshot);
        
        
            $('#photoForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '/data_siswa/tambah_murid/simpan',
                    type: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        console.log(data)
                        if(data == 'success') {
                            Webcam.reset();
        
                            $('#my_camera').addClass('d-block');
                            $('#my_camera').removeClass('d-none');
        
                            $('#results').addClass('d-none');
        
                            $('#takephoto').addClass('d-block');
                            $('#takephoto').removeClass('d-none');
    
                            $('#uploadphoto').addClass('d-none');
                            $('#uploadphoto').removeClass('d-block');
        
                            Noticme.any({
                                text: "Sukses !",
                                messege: "Photo uploaded successfully",
                                type: 'success',
                                timer: 5000,
                            })
                            setTimeout( () => {
                                location.reload()
                            }, 5000)
                        }
                        else {
                            Noticme.any({
                                text: "Gagal !",
                                messege: "Terjadi Suatu Masalah",
                                type: 'danger',
                                timer: 5000,
                                button: true
                            })
                        }
                    }
                })
            })
        })
        
        function take_snapshot()
        {
            //take snapshot and get image data
            Webcam.snap(function(data_uri) {
                //display result image
                $('#results').html('<img src="' + data_uri + '" class="d-block mx-auto rounded"/>');
        
                var raw_image_data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
                $('#photoStore').val(raw_image_data);
            });
        
            $('#my_camera').removeClass('block');
            $('#my_camera').addClass('hidden');
        
            $('#results').removeClass('none');
        
            $('#takephoto').removeClass('d-block');
            $('#takephoto').addClass('d-none');
        
            $('#uploadphoto').removeClass('d-none');
            $('#uploadphoto').addClass('d-block');
        }
    </script>
    
</body>
</html>
      
