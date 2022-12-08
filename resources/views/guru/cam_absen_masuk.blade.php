@extends('main_guru')
@section('content')
    <div class="absolute left-72 w-3/4">
        <div class="shadow-box mt-32 p-8 w-5/6 mx-auto rounded-2xl border-solid border-[0.1px] border-opacity-5 border-black">
            <video id="videoInput" width="720" muted controls class="mx-auto mt-4"></video>
            <div class="button flex justify-center">
                <button class="px-12 py-3 bg-bg-blue-dark rounded-xl text-white font-bold mt-8 flex mx-auto mb-2" onclick="location.href = '/absen_siswa/{{ $tanggals }}/{{ $kelas }}/{{ $mapels }}'">Kembali</button>
            </div>
        </div>
        {{-- autoplay loop playsinline --}}
    </div>

    <script src="{{ asset('cam_js/js/face-api.min.js') }}"></script>
    <script src="{{ asset('cam_js/js/script.js') }}"></script>
@endsection