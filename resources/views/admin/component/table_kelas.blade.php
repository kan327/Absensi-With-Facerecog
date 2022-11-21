@foreach ($kelas as $kels)

<tr
class="border-tet-x text-tet-x border-t-0 border-l-0 border-r-0 border-[1px] text-sm border-solid hover:text-blue hover:border-blue cursor-pointer">
    <td>{{ $no_kelas++ }}</td>
    <td>{{ $kels['kelas'] }}</td>
    <td>
        <a href="admin/kelas/{{ $kels->id }}"><span class="material-symbols-outlined text-red-600">delete</span></a>
    </td>
</tr>

@endforeach