<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@if($title == "dashboard_guru") Dashboard @endif @if($title == "profile_guru") Profile @endif @if($title == "absensi") Absensi @endif @if($title == "data_kelas") Data Kelas @endif| Starbhak Absensi</title>

    <!-- style css -->
    <link rel="stylesheet" href="{{ asset('assets/CSS/output.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/suport.css') }}">

    {{-- tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>
    
    {{-- alert --}}
    <script src="{{ asset('assets/JS/noticme.min.js') }}"></script>
    
    {{-- jquery --}}
    <script src="{{ asset('assets/JS/jquery.js') }}"></script>

    {{-- style --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <style>
        li {
            list-style: none;
        }

        li label {

            display: inline-block;
            background-color: rgba(255, 255, 255, .9);
            color: #A0A0A0;
            border-radius: 8px;
            white-space: nowrap;
            margin: 3px 0px;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-tap-highlight-color: transparent;
            transition: all .2s;
        }

        li label {
            padding: 8px 12px;
            cursor: pointer;
        }

        li label::before {
            display: inline-block;
            font-style: normal;
            font-variant: normal;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            font-size: 12px;
            padding: 2px 6px 2px 2px;

            transition: transform .3s ease-in-out;
        }

        li input[type="checkbox"]:checked+label::before {
            content: "\f00c";
            transform: rotate(-360deg);
            transition: transform .3s ease-in-out;
        }

        li input[type="checkbox"]:checked+label {
            border: 2px solid #2C3E50;
            background-color: #ffffff;
            color: #2C3E50;
            transition: all .2s;
        }

        li input[type="checkbox"] {
            display: absolute;
        }

        li input[type="checkbox"] {
            position: absolute;
            opacity: 0;
        }

        canvas{
            position: absolute;
        }

        video{
            position: relative;
        }
    </style>

    <!-- config -->
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
    @yield('content')

    @if (Session::has("success"))
        <script>
            Noticme.any({
                text: "{{ Session::get('success') }}",
                type: 'success',
                timer: 5000,
            })
        </script>
    @endif

    @if (Session::has('wrong'))
        <script>
            Noticme.any({
                text: "Gagal !",
                messege: "{{ Session::get('wrong') }}",
                type: 'danger',
                timer: 5000,
                button: true
            })
        </script>  
    @endif
    
</body>

</html>


<!-- npx tailwindcss -i ./src/input.css -o ./public/assets/css/output.css --watch -->