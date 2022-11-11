@foreach ($data as $datas)
    <tr class="border-tet-x text-tet-x border-t-0 border-l-0 border-r-0 border-[1px] text-sm border-solid hover:text-blue hover:border-blue cursor-pointer">
        <th>{{ $no_guru++ }}</th>
        <th class="break-words max-w-[100px]">{{ $datas->name }}</th>
        <th class="break-words max-w-[100px]">{{ $datas->nip }}</th>
        <th class="break-words max-w-[100px]">0{{ $datas->no_hp }}</th>
        <th class="break-words max-w-[100px]">{{ $datas->email }}</th>
        <th class="break-words max-w-[100px]">{{ $datas->username }}</th>
    </tr>
@endforeach