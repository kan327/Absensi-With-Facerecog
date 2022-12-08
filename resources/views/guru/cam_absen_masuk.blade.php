@extends('main_guru')
@section('content')
    <video id="videoInput" width="720" height="550" muted autoplay loop playsinline>

    <script src="{{ asset('cam_js/js/face-api.min.js') }}"></script>
    <script src="{{ asset('cam_js/js/script.js') }}"></script>
@endsection