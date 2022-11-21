<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
              
    {{-- tailwind --}}

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="{{ asset('assets/CSS/login.css') }}">

    <!-- roboto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>

<body>
    <!-- Container -->
    <div class="bg">
        <!-- vector -->
        <div class="img">
            <img src="{{ asset('assets/img/decor.png') }}" alt="">
        </div>
        <div class="imgs">
            <img src="{{ asset('assets/img/decor2.png') }}" alt="">
        </div>
        <!-- login -->
        <div class="login">
            <!-- card -->
            <div class="card">
                <!-- One -->
                <div class="one">
                    <!-- FOTO KANAN -->
                    <img src="{{ asset('assets/img/Online presentation_Outline.png') }}" alt="">
                </div>


                <!-- two -->
                <div class="two">
                    <!-- judul -->
                    <div class="line"></div>
                    <div class="admin">
                        <h2>Login Account</h2>


                        @if (Session::has("wrong"))
                            <div class="alert">
                                <p>{{ Session::get("wrong") }}</p>
                                <p class="material-symbols-outlined">
                                    cancel
                                </p>
                            </div>
                        @endif

                        @if (Session::has("success"))
                            <div class="succes">
                                <p>{{ Session::get("success") }}</p>
                                <p class="material-symbols-outlined">
                                    check_circle
                                </p>
                            </div>
                        @endif
                    </div>

                    <!-- Inputan -->

                    <form action="/login" method="post">
                        @csrf
                        <!-- input username -->
                        <div class="input1">
                            <svg width="24" viewBox="0 0 24 24">
                                <path
                                    d="M20.822 18.096c-3.439-.794-6.64-1.49-5.09-4.418 4.72-8.912 1.251-13.678-3.732-13.678-5.082 0-8.464 4.949-3.732 13.678 1.597 2.945-1.725 3.641-5.09 4.418-3.073.71-3.188 2.236-3.178 4.904l.004 1h23.99l.004-.969c.012-2.688-.092-4.222-3.176-4.935z" />
                            </svg>
    
                            <input class="input" placeholder="Email" autocomplete="off" name="email" type="text " value="{{ old('email') }}">
                        </div>
                        <!-- input password -->
                        @error('email')
                            <small class="require">{{ $message }}</small>
                        @enderror
                        <div class="input2">
                            <svg viewBox="0 0 24 24" width="24">
                                <path
                                    d="m18.75 9h-.75v-3c0-3.309-2.691-6-6-6s-6 2.691-6 6v3h-.75c-1.24 0-2.25 1.009-2.25 2.25v10.5c0 1.241 1.01 2.25 2.25 2.25h13.5c1.24 0 2.25-1.009 2.25-2.25v-10.5c0-1.241-1.01-2.25-2.25-2.25zm-10.75-3c0-2.206 1.794-4 4-4s4 1.794 4 4v3h-8zm5 10.722v2.278c0 .552-.447 1-1 1s-1-.448-1-1v-2.278c-.595-.347-1-.985-1-1.722 0-1.103.897-2 2-2s2 .897 2 2c0 .737-.405 1.375-1 1.722z" />
                            </svg>
    
                            <input class="input" placeholder="Password" name="password" type="password">
                        </div>
                        @error('password')
                            <small class="require">{{ $message }}</small>
                        @enderror
    
                        <!-- button login -->
                        <button class="Login" type="submit">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

{{-- <!-- Tailwind -->
<script src="https://cdn.tailwindcss.com"></script> --}}
</html>