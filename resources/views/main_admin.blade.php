<!DOCTYPE html>
<html lang="en">
<!-- wait for figma -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon untuk mode default -->
    <link rel="icon" href="{{ asset('assets/img/title_logo_dark.png') }}">
    <!-- Favicon untuk dark mode -->
    <link rel="icon" href="{{ asset('assets/img/title_logo_light.png') }}" media="(prefers-color-scheme: dark)">
    <script>
               const faviconDark = document.querySelector("link[rel='icon'][media='(prefers-color-scheme: dark)']");
        const faviconDefault = document.querySelector("link[rel='icon'][media='']");

        const runColorMode = (fn) => {
            if (!window.matchMedia) {
                return;
            }
            
            const query = window.matchMedia('(prefers-color-scheme: dark)');
            fn(query.matches);

            query.addEventListener('change', (event) => fn(event.matches));
        }

        runColorMode((isDarkMode) => {
            if (isDarkMode) {
                faviconDefault.remove();
                document.head.appendChild(faviconDark);
            } else {
                faviconDark.remove();
                document.head.appendChild(faviconDefault);
            }
        });
    </script>
    <title>@if($title == "dashboard_admin") Dashboard @endif @if($title == "pino_bot") Pino Bot @endif @if($title === "data_kelas_admin") Data Kelas @endif| Admin </title>
      
    {{-- tailwind --}}
    @vite('resources/css/app.css')
            
    <script src="{{ asset('assets/JS/jquery.js') }}"></script>

    {{-- alert --}}
    <script src="{{ asset('assets/JS/noticme.min.js') }}"></script>

    <!-- style css -->
    <link rel="stylesheet" href="{{ asset('assets/CSS/suport.css') }}">
    <!-- config -->

    {{-- fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'bg-blue-dark': '#2C3E50',
                        'dark-data': '#393939',
                        'placeholder': '#A0A0A0',
                        'bg': '#FCFCFF',
                        'blue-dark': '#1061FF',
                        'blue': '#349DFD',
                        'blue-table': '#002C9D',
                        'unselect': '#BAC5E7',
                        'stroke': '#81B7E9',
                        'tet': '#001458',
                        'tet-x': '#5A5A5A',
                    },
                    boxShadow: {
                        nav: '2px 3px 3px 1px rgba(0, 0, 0, 0.1);',
                        side: ' 0px 5px 10px rgba(0, 0, 0, 0.05);',
                        stable: ' 0px 3px 4px rgba(0, 0, 0, 0.25);',
                        box: ' 0px 4px 4px rgba(0, 0, 0, 0.25)',
                    },
                    screens: {
                        'lgs': '1150px',
                        'mds': '833px',
                        'vp-860': '860px'
                    },
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

<body class="text-bg-blue-dark h-[100vh] overflow-y-auto m-5 mt-6 bg-white pb-10 mb-10 text-sm md:text-base">
    <!-- nav -->
    @include('partials.navbar_admin')

    {{-- content --}}
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

    <script src="{{ asset('assets/JS/admin.js') }}"></script>



</body>

</html>