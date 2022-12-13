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
                        <td class="p-3 font-semibold " style="border-top-left-radius: 12px; border-bottom-left-radius: 12px;">{{ $no_jadwal++ }}
                        </td>
                        <td onclick="location.href = '/absen_siswa/{{ $jadwal_absen->tanggal }}/{{ $jadwal_absen->kelas_id }}/{{ $jadwal_absen->mapel_id }}'" class="p-3 font-semibold">{{ \Carbon\Carbon::parse($jadwal_absen->tanggal)->format("d/m/Y") }}</td>
                        <td onclick="location.href = '/absen_siswa/{{ $jadwal_absen->tanggal }}/{{ $jadwal_absen->kelas_id }}/{{ $jadwal_absen->mapel_id }}'" class="p-3 font-semibold">{{ $jadwal_absen->kelas->kelas }}</td>
                        <td onclick="location.href = '/absen_siswa/{{ $jadwal_absen->tanggal }}/{{ $jadwal_absen->kelas_id }}/{{ $jadwal_absen->mapel_id }}'" class="p-3 font-semibold">{{ $jadwal_absen->mapel->pelajaran }}</td>
                        <td onclick="location.href = '/absen_siswa/{{ $jadwal_absen->tanggal }}/{{ $jadwal_absen->kelas_id }}/{{ $jadwal_absen->mapel_id }}'" class="p-3 font-semibold">{{ $jadwal_absen->mulai }}</td>
                        <td onclick="location.href = '/absen_siswa/{{ $jadwal_absen->tanggal }}/{{ $jadwal_absen->kelas_id }}/{{ $jadwal_absen->mapel_id }}'" class="p-3 font-semibold" name="jam_pulang">{{ $jadwal_absen->selesai }}</td>
                        <td  class=""
                        style="border-top-right-radius: 12px; border-bottom-right-radius: 12px;">

                            {{-- <a href="/absensi/edit"><span class="material-symbols-outlined">edit</span></a> --}}
                            <a href="/absensi/hapus/{{ $jadwal_absen->id }}/{{ $jadwal_absen->tanggal }}/{{ $jadwal_absen->kelas_id }}/{{ $jadwal_absen->mapel_id }}"><span class="material-symbols-outlined this-one">delete</span></a>
                            <a href="/absensi/excel/{{ $jadwal_absen->tanggal }}/{{ $jadwal_absen->kelas_id }}/{{ $jadwal_absen->mapel_id }}" name="download_excel"><span class="material-symbols-outlined">file_download</span></a></td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    var download_excel = document.getElementsByName("download_excel")
    var jam_pulang = document.getElementsByName("jam_pulang")
    var baris_jadwal = document.getElementsByName("baris_jadwal")
    var date = new Date()
    var date_now = date.getHours()+":"+date.getMinutes()+":"+date.getSeconds()

    for(i=0; i < download_excel.length; i++){
        
        if("{{ $time_now }}" > jam_pulang[i].textContent){
            baris_jadwal[i].addEventListener("click", ()=>{
                location.href = ""
            })
            console.log(baris_jadwal)
            console.log(jam_pulang[i].textContent+" Di buka")
        }else{
            download_excel[i].style.pointerEvents = "none";
            console.log(jam_pulang[i].textContent+" Di tutup")
        }    
        console.log(date_now)
    }
</script>
@endsection

