@foreach ($data_jadwal as $jadwal)

<tr class="hover:bg-[#F5F5F5] hover:font-bold rounded-full in-hover-to">
    <!-- please delete or reuse this onclick -->
    <td class="p-3 font-semibold" style="border-top-left-radius: 12px; border-bottom-left-radius: 12px;">{{ $loop->iteration }}</td>
    <td class="p-3 font-semibold">{{ $jadwal->mapel->pelajaran }}</td>
    <td class="" style="border-top-right-radius: 12px; border-bottom-right-radius: 12px;">{{ $jadwal->tanggal }}</td>
</tr>

@endforeach