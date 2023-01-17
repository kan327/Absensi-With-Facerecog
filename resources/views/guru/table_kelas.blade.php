@extends('main_guru')

@section('content')
    <!-- content -->
    <div class="absolute left-72 w-3/4 pb-20">
        <!-- card 1 -->
        <div
            class="shadow-box mt-32 p-8 w-5/6 mx-auto rounded-2xl border-solid border-[0.1px] border-opacity-5 border-black">

            <div>
                <div class="w-fit float-left">
                    <h1 class="text-bg-blue-dark font-bold font-[Montserrat] text-2xl">Daftar Siswa | {{ $data_kelas->kelas }}</h1>
                    <p>Lihat dan Periksa kembali murid anda</p>
                </div>
                {{-- <button onclick="location.href='/data_kelas/tambah_murid/{{ $data_kelas->id }}'" class="px-4 py-2 float-right bg-bg-blue-dark rounded-xl text-white font-bold">+ Tambahkan
                    Murid</button> --}}
            </div>

            <!-- table -->
            <div class="mt-20 h-[50vh] w-full overflow-auto border-bg-blue-dark border-solid border-t-2">
                <table class="text-black w-full" cellpadding="2">
                    <thead class="text-[#8C8C8C] font-extrabold bg-white top-0 sticky z-10">
                        <tr class="text-sm text-un-tet">
                            <th class="p-3">No</th>
                            <th class="p-3">Nama</th>
                            <th class="p-3">Lahir</th>
                            <th class="p-3">Gender</th>
                            <th class="p-3">Kelas</th>
                        </tr>
                    </thead>
                    <tbody class="text-center text-base font-bold cursor-pointer select-none">

                        @foreach ($data_siswa as $siswa)
                            <tr class="hover:bg-[#F5F5F5] rounded-full in-hover-to">
                                <td class="p-3" style="border-top-left-radius: 12px; border-bottom-left-radius: 12px;">{{ $loop->iteration }}
                                </td>
                                <td class="p-3">{{ $siswa->nama_siswa }}</td>
                                <td class="p-3">{{ Carbon\Carbon::parse($siswa->tgl_lahir)->translatedFormat('d F Y') }}</td>
                                <td class="p-3">{{ $siswa->jenis_kelamin }}</td>
                                <td class="p-3" style="border-top-right-radius: 12px; border-bottom-right-radius: 12px;">
                                    {{ $siswa->kelas->kelas }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection