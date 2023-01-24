@extends('main_guru')

@section('content')
    <!-- content -->
    <div class="absolute vp-860:left-72 sm:pl-10 vp-860:pr-20 vp-860:pl-10 pr-2 pl-2 sm:pr-10 vp-860:w-3/4 w-[100vw] //lgs:bg-black //bg-transparent mx-auto">
        <!-- card -->
        <div
            class="shadow-box mt-32 p-8 w-5/6 mx-auto rounded-2xl border-solid border-[0.1px] border-opacity-5 border-black">
            <div class="flex sm:items-center sm:flex-row flex-col w-full justify-between">
                <div class="//sm:w-1/2//">
                    <h1 class="font-bold  text-lg sm:text-xl md:text-2xl font-[Montserrat]">Daftar Siswa | XI-PPLG 2</h1>
                    <p>Lihat dan Periksa kembali murid anda</p>
                </div>
                {{-- <div class="mt-1 sm:mt-0">
                    <button class="px-4 py-2 bg-bg-blue-dark rounded-xl text-white font-bold">+ Tambahkan
                        Murid</button>
                </div> --}}
            </div>
            <!-- table -->
            <div class="mt-5 h-[50vh] w-full overflow-auto border-bg-blue-dark border-solid border-t-2">
                <table class="w-full min-w-[555px] font-[quicksands]" cellpadding="2">
                    <thead class="text-[#8C8C8C] font-extrabold bg-white top-0 sticky z-10">
                        <tr class="text-sm text-un-tet">
                            <th class="p-3">No</th>
                            <th class="p-3">Nama</th>
                            <th class="p-3">Lahir</th>
                            <th class="p-3">Gender</th>
                            <th class="p-3">Kelas</th>
                        </tr>
                    </thead>
                    <tbody class="text-center font-bold cursor-pointer select-none">
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