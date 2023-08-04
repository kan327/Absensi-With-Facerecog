@foreach ($siswas as $siswa)

<tr class="hover:bg-[#F5F5F5] hover:font-bold rounded-full in-hover-to">
    <!-- please delete or reuse this onclick -->
    <td class="p-3 font-semibold"
        style="border-top-left-radius: 12px; border-bottom-left-radius: 12px;">{{ $loop->iteration }}
    </td>
    <td class="p-3 font-semibold">{{ $siswa->nama_siswa }}</td>
    <td class="p-3 font-semibold">{{ Carbon\Carbon::parse($siswa->tgl_lahir)->translatedFormat('d F Y') }}</td>
    <td class="p-3 font-semibold">{{ $siswa->jenis_kelamin }}</td>
    <td class="p-3 font-semibold">{{ $siswa->kelas->kelas }}</td>
    
    <td class="" style="border-top-right-radius: 12px; border-bottom-right-radius: 12px;">
        <a href="/admin/murid/{{ $siswa->id }}/admin">
            <i class="fa-regular fa-pen-to-square p-1"></i>
            {{-- <span class="material-symbols-outlined">edit</span> --}}
        </a>
        <a href="/admin/hapus_siswa/{{ $siswa->id }}">
            <i class="fa-regular fa-trash-can this-one ml-3 p-1"></i>
            {{-- <span class="material-symbols-outlined this-one">delete</span> --}}
        </a>
</tr>

@endforeach