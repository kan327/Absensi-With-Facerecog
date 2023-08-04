<!DOCTYPE html>
<html lang="en">

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
    <title>
        @if ($title == 'dashboard_guru')
            Dashboard
            @endif @if ($title == 'profile_guru')
                Profile
                @endif @if ($title == 'absensi')
                    Absensi
                    @endif @if ($title == 'data_kelas')
                        Data Kelas
                    @endif| Starbhak Absensi
    </title>
    {{-- tailwind --}}
    @vite('resources/css/app.css')

    <!-- style css -->
    <link rel="stylesheet" href="{{ asset('assets/CSS/suport.css') }}">


    {{-- alert --}}
    <script src="{{ asset('assets/JS/noticme.min.js') }}"></script>

    <script src="{{ asset('assets/JS/guru.js') }}"></script>

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

        canvas {
            position: absolute;
        }

        video {
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
    {{-- fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- font material ++ -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,500;1,500&display=swap"
        rel="stylesheet">

</head>

<body class="text-bg-blue-dark h-[100vh] overflow-y-auto sm:mt-5 mt-6 bg-white pb-10 mb-10 text-sm md:text-base">

    <!-- navbar top -->
    @include('partials.navbar')

    <!-- Sidebar left -->
    @if(empty($sidebar))
    @include('partials.sidebar')
    @endif

    <!-- content -->
    @yield('content')

    @if (Session::has('success'))
        <script>
            Noticme.any({
                text: "{{ Session::get('success') }}",
                type: 'success',
                timer: 5000,
                button: false
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
    <script>
        function openfc(any='child', display = 'block') {
            var close_state = document.getElementsByClassName(any)
            for (let i = 0; i < close_state.length; i++) {
                const element = close_state[i];
                if (element.classList.contains('hidden')) {
                    element.classList.remove('hidden')
                    element.classList.add(display)
                } else {
                    element.classList.remove(display)
                    element.classList.add('hidden')
                }
            }
        }
    </script>
</body>

</html>


<!-- npx tailwindcss -i ./src/input.css -o ./public/assets/css/output.css --watch -->
