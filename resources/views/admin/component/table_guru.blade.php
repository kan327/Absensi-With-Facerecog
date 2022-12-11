@foreach ($gurus as $akun_guru)
    <tr class="hover:bg-[#F5F5F5] hover:font-bold rounded-full in-hover-to">
    <!-- please delete or reuse this onclick -->
        <td class="p-3 font-semibold"
            style="border-top-left-radius: 12px; border-bottom-left-radius: 12px;">{{ $loop->iteration }}
        </td>
        <td class="p-3 font-semibold" name="">{{ $akun_guru->name }}</td>
        <td class="p-3 font-semibold" name="">{{ $akun_guru->nip }}</td>
        <td class="p-3 font-semibold" name="">{{ $akun_guru->username }}</td>
        <td class="p-3 font-semibold" name="">{{ $akun_guru->jenis_kelamin }}</td>
        <td class="" style="border-top-right-radius: 12px; border-bottom-right-radius: 12px;">
        <a href="admin/guru/{{ $akun_guru->id }}"> <span class="material-symbols-outlined">edit</span></a>
        <a href="admin/hapus_guru/{{ $akun_guru->id }}"><span class="material-symbols-outlined this-one ml-3">delete</span></a>
        </td>
    </tr>
@endforeach