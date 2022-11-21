@foreach ($mapels as $mapel)

<tr
    class="border-tet-x text-tet-x border-t-0 border-l-0 border-r-0 border-[1px] text-sm border-solid hover:text-blue hover:border-blue cursor-pointer">
    <td>{{ $no_mapel++ }}</td>
    <td>{{ $mapel['pelajaran'] }}</td>
    <td>
        <a href="admin/mapel/{{ $mapel->id }}"><span class="material-symbols-outlined text-red-600">delete</span></a>
    </td>
</tr>

@endforeach