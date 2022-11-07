<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="{{ asset('assets/CSS/login.css') }}">

    <!-- roboto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
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
                    <img src="{{ asset('assets/img/Data Arranging_Flatline.png') }}" alt="">
                </div>


                <!-- two -->
                <div class="two">
                    <!-- judul -->
                    <div class="line"></div>
                    <div class="admin">
                        <h2>Login Admin</h2>

                        @if (Session::has("wrong"))
                            <div class="alert">
                                {{ Session::get("wrong") }}
                            </div>
                        @endif
                    </div>

                    <!-- Inputan -->

                    <form action="/login_admin" method="post">
                        @csrf
                        <!-- input username -->
                        <div class="input1">
                            <svg width="24" viewBox="0 0 24 24">
                                <path
                                    d="M20.822 18.096c-3.439-.794-6.64-1.49-5.09-4.418 4.72-8.912 1.251-13.678-3.732-13.678-5.082 0-8.464 4.949-3.732 13.678 1.597 2.945-1.725 3.641-5.09 4.418-3.073.71-3.188 2.236-3.178 4.904l.004 1h23.99l.004-.969c.012-2.688-.092-4.222-3.176-4.935z" />
                            </svg>
    
                            <input class="input" placeholder="Username" name="username" type="text " value="{{ old('username') }}">
                        </div>
                        <!-- input password -->
                        @error('username')
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

</html>