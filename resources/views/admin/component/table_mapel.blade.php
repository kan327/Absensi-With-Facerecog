@foreach ($mapels as $mapel)

<tr class="hover:bg-[#F5F5F5] hover:font-bold rounded-full in-hover-to">
    <!-- please delete or reuse this onclick -->
    <td class="p-3 font-semibold" style="border-top-left-radius: 12px; border-bottom-left-radius: 12px;">{{ $no_mapel++ }}</td>
    <td class="p-3 font-semibold">{{ $mapel->pelajaran }}</td>
    <td class="" style="border-top-right-radius: 12px; border-bottom-right-radius: 12px;">
        <a href="admin/mapel/{{ $mapel->id }}" onclick="return confirm('Apakah anda yakin ingin menhapus data berikut ? ')"><span class="material-symbols-outlined this-one">delete</span></a>
    </td>
</tr>

@endforeach