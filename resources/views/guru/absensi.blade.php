@extends('main_guru')

@section('content')
<div class="absolute left-72 w-3/4">
    <!-- card -->
    <div
        class="shadow-box mt-32 p-8 w-5/6 mx-auto rounded-2xl border-solid border-[0.1px] border-opacity-5 border-black">
        <!-- top table -->
        <div>
            <div class="w-fit float-left">
                <h1 class="font-bold text-2xl font-[Montserrat]">Kelola Jadwal</h1>
                <p>Kelola semua jadwal anda dan tambahkan jadwal.</p>
            </div>
            <button class=" px-4 font-[quicksands] py-2 float-right bg-bg-blue-dark rounded-xl text-white font-bold" onclick="location.href='/absensi/tambah_jadwal'">+ Tambahkan Jadwal</button>
        </div>
        <!-- table -->
        <div class="mt-20 h-[50vh] w-full overflow-auto border-bg-blue-dark border-solid border-t-2">
            <table class="w-full font-[quicksands]" cellpadding="2">
                <!-- header table -->
                <thead class="font-extrabold bg-white top-0 sticky z-10">
                    <tr class="text-sm text-placeholder">
                        <th class="p-3">No</th>
                        <th class="p-3">Tanggal</th>
                        <th class="p-3">Kelas</th>
                        <th class="p-3">Matapel</th>
                        <th class="p-3">Mulai</th>
                        <th class="p-3">Selesai</th>
                        <th class="p-3">Aksi</th>
                    </tr>
                </thead>
                <!-- body -->
                <tbody class="text-center text-base font-bold cursor-pointer select-none">

                    @foreach ($jadwal_absens as $jadwal_absen)
                    <tr name="baris_jadwal" class="hover:bg-[#F5F5F5] hover:font-bold rounded-full in-hover-to">
                        <!-- please delete or reuse this onclick -->
                        <td class="p-3 font-semibold " style="border-top-left-radius: 12px; border-bottom-left-radius: 12px;">{{ $loop->iteration }} .
                        </td>
                        <td @if($jadwal_absen->tanggal >= $date_now) onclick="location.href = '/absen_siswa/{{ $jadwal_absen->tanggal }}/{{ $jadwal_absen->kelas_id }}/{{ $jadwal_absen->mapel_id }}'" @else onclick="validate('Jadwal Absen Telah Tertutup!')" @endif class="p-3 font-semibold">{{ \Carbon\Carbon::parse($jadwal_absen->tanggal)->format("d/m/Y") }}</td>
                        <td @if($jadwal_absen->tanggal >= $date_now) onclick="location.href = '/absen_siswa/{{ $jadwal_absen->tanggal }}/{{ $jadwal_absen->kelas_id }}/{{ $jadwal_absen->mapel_id }}'" @else onclick="validate('Jadwal Absen Telah Tertutup!')" @endif  class="p-3 font-semibold">{{ $jadwal_absen->kelas->kelas }}</td>
                        <td @if($jadwal_absen->tanggal >= $date_now) onclick="location.href = '/absen_siswa/{{ $jadwal_absen->tanggal }}/{{ $jadwal_absen->kelas_id }}/{{ $jadwal_absen->mapel_id }}'" @else onclick="validate('Jadwal Absen Telah Tertutup!')" @endif  class="p-3 font-semibold">{{ $jadwal_absen->mapel->pelajaran }}</td>
                        <td @if($jadwal_absen->tanggal >= $date_now) onclick="location.href = '/absen_siswa/{{ $jadwal_absen->tanggal }}/{{ $jadwal_absen->kelas_id }}/{{ $jadwal_absen->mapel_id }}'" @else onclick="validate('Jadwal Absen Telah Tertutup!')" @endif  class="p-3 font-semibold">{{ $jadwal_absen->mulai }}</td>
                        <td @if($jadwal_absen->tanggal >= $date_now) onclick="location.href = '/absen_siswa/{{ $jadwal_absen->tanggal }}/{{ $jadwal_absen->kelas_id }}/{{ $jadwal_absen->mapel_id }}'" @else onclick="validate('Jadwal Absen Telah Tertutup!')" @endif  class="p-3 font-semibold" name="jam_pulang">{{ $jadwal_absen->selesai }}</td>
                        <td  class=""
                        style="border-top-right-radius: 12px; border-bottom-right-radius: 12px;">

                            {{-- <a href="/absensi/edit"><span class="material-symbols-outlined">edit</span></a> --}}
                            <a onclick="return Noticme.any({text: 'Hapus!', message: 'Apakah Anda Yakin Ingin Menghapus Data Berikut?', confirm:true}).then(result => { if(result){ location.href='/absensi/hapus/{{ $jadwal_absen->id }}/{{ $jadwal_absen->tanggal }}/{{ $jadwal_absen->kelas_id }}/{{ $jadwal_absen->mapel_id }}' } })"><span class="material-symbols-outlined this-one">delete</span></a>
                            <a @if($time_now >= $jadwal_absen->selesai && $jadwal_absen->tanggal <= $date_now) href="/absensi/excel/{{ $jadwal_absen->tanggal }}/{{ $jadwal_absen->kelas_id }}/{{ $jadwal_absen->mapel_id }}" @else onclick="validate('Sesi Absen Belum Berakhir!')" @endif name="download_excel"><span class="material-symbols-outlined">file_download</span></a></td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="{{ asset('assets/JS/guru.js') }}"></script>
@endsection

