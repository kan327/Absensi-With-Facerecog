<table class="w-full text-center">
    <thead class="table-fixed top-0 sticky z-10 bg-white">
        <tr class="border-blueside border-t-0 border-l-0 border-r-0 border-[1px] border-solid">
            <th>No</th>
            <th>Mapel</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $datas)
        <tr
            class="border-tet-x text-tet-x border-t-0 border-l-0 border-r-0 border-[1px] text-sm border-solid hover:text-blue hover:border-blue cursor-pointer">
            <td>{{ $no++ }}</td>
            <td>{{ $datas['pelajaran'] }}</td>
            <td>Symbols</td>
        </tr>
        @endforeach
    </tbody>
</table>