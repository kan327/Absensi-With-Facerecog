@foreach ($jadwal_absens as $jadwal_absen)
    <tr name="baris_jadwal" class="hover:bg-[#F5F5F5] hover:font-bold rounded-full in-hover-to">
        <!-- please delete or reuse this onclick -->
        <td class="p-3 font-semibold " style="border-top-left-radius: 12px; border-bottom-left-radius: 12px;">
            {{ $loop->iteration }} .
        </td>
        <td @if ($jadwal_absen->tanggal >= $date_now) onclick="location.href = '/absen_siswa/{{ $jadwal_absen->tanggal }}/{{ $jadwal_absen->kelas_id }}/{{ $jadwal_absen->mapel_id }}'" @else onclick="validate('Jadwal Absen Telah Tertutup!')" @endif
            class="p-3 font-semibold">{{ \Carbon\Carbon::parse($jadwal_absen->tanggal)->format('d/m/Y') }}</td>
        <td @if ($jadwal_absen->tanggal >= $date_now) onclick="location.href = '/absen_siswa/{{ $jadwal_absen->tanggal }}/{{ $jadwal_absen->kelas_id }}/{{ $jadwal_absen->mapel_id }}'" @else onclick="validate('Jadwal Absen Telah Tertutup!')" @endif
            class="p-3 font-semibold">{{ $jadwal_absen->kelas->kelas }}</td>
        <td @if ($jadwal_absen->tanggal >= $date_now) onclick="location.href = '/absen_siswa/{{ $jadwal_absen->tanggal }}/{{ $jadwal_absen->kelas_id }}/{{ $jadwal_absen->mapel_id }}'" @else onclick="validate('Jadwal Absen Telah Tertutup!')" @endif
            class="p-3 font-semibold">{{ $jadwal_absen->mapel->pelajaran }}</td>
        <td @if ($jadwal_absen->tanggal >= $date_now) onclick="location.href = '/absen_siswa/{{ $jadwal_absen->tanggal }}/{{ $jadwal_absen->kelas_id }}/{{ $jadwal_absen->mapel_id }}'" @else onclick="validate('Jadwal Absen Telah Tertutup!')" @endif
            class="p-3 font-semibold">{{ $jadwal_absen->mulai }}</td>
        <td @if ($jadwal_absen->tanggal >= $date_now) onclick="location.href = '/absen_siswa/{{ $jadwal_absen->tanggal }}/{{ $jadwal_absen->kelas_id }}/{{ $jadwal_absen->mapel_id }}'" @else onclick="validate('Jadwal Absen Telah Tertutup!')" @endif
            class="p-3 font-semibold" name="jam_pulang">{{ $jadwal_absen->selesai }}</td>
        <td class="" style="border-top-right-radius: 12px; border-bottom-right-radius: 12px;">

            {{-- <a href="/absensi/edit"><span class="material-symbols-outlined">edit</span></a> --}}
            <a
                onclick="return Noticme.any({text: 'Hapus!', type: 'info', message: 'Apakah Anda Yakin Ingin Menghapus Data Berikut?', confirm:true}).then(result => { if(result){ location.href='/absensi/hapus/{{ $jadwal_absen->id }}/{{ $jadwal_absen->tanggal }}/{{ $jadwal_absen->kelas_id }}/{{ $jadwal_absen->mapel_id }}' } })"><span
                    class="material-symbols-outlined this-one">delete</span>
            </a>
            <a @if ($time_now >= $jadwal_absen->selesai && $jadwal_absen->tanggal <= $date_now) href="/absensi/excel/{{ $jadwal_absen->tanggal }}/{{ $jadwal_absen->kelas_id }}/{{ $jadwal_absen->mapel_id }}" @else onclick="validate('Sesi Absen Belum Berakhir!')" @endif
                name="download_excel"><span class="material-symbols-outlined">file_download</span>
            </a>
        </td>
    </tr>
@endforeach
