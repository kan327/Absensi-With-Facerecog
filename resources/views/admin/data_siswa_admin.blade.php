@extends('main_admin')

@section('content')
    <!-- layout Main min-w-[80vh] -->
<main class="max-w-[85rem] mx-auto">
    <!-- card -->
    <div
        class="shadow-box mt-10 p-8 md:w-3/4 mx-auto rounded-2xl border-solid border-[0.1px] border-opacity-5 border-black">
        <div class="flex sm:items-center sm:flex-row flex-col w-full justify-between">
            <div class="sm:w-1/2">
                <h1 class="font-bold  text-lg sm:text-xl md:text-2xl font-[Montserrat]">Daftar Siswa | {{ $kelas->kelas }}</h1>
                <p>Lihat dan Periksa kembali murid anda</p>
            </div>
            <div class="mt-1 sm:mt-0">
                <button class="px-4 py-2 bg-bg-blue-dark rounded-xl text-white font-bold" onclick="location.href=`/admin/data_kelas/tambah_murid/{{ $kelas->id }}`">+ Tambahkan
                    Murid</button>
            </div>
        </div>
        <!-- table -->
        <div class="mt-5 h-[50vh] font-[quicksands] w-full overflow-auto border-bg-blue-dark border-solid border-t-2">
            <table class="w-full min-w-[617px]" cellpadding="2">
                <thead class="text-[#8C8C8C] font-extrabold bg-white top-0 sticky z-10">
                    <tr class="text-sm text-un-tet">
                        <th class="p-3">No</th>
                        <th class="p-3">Nama</th>
                        <th class="p-3">Lahir</th>
                        <th class="p-3">Jenis Kelamin</th>
                        <th class="p-3"><span class="material-symbols-outlined">tune</span></th>
                    </tr>
                </thead>
                <tbody class="font-[quicksands] text-center font-bold cursor-pointer select-none" id="table_siswa">
                    @foreach ($data_siswas as $data_siswa)
                        <tr class="hover:bg-[#F5F5F5] rounded-full in-hover-to">
                            <td class="p-3" style="border-top-left-radius: 12px; border-bottom-left-radius: 12px;">{{ $loop->iteration }}.
                            </td>
                            <td class="p-3">{{ $data_siswa->nama_siswa }}</td>
                            <td class="p-3">{{ Carbon\Carbon::createFromFormat('Y-m-d', $data_siswa->tgl_lahir)->format('d F Y') }}</td>
                            <td class="p-3">
                                Laki-laki</td>
                            <td class="" style="border-top-right-radius: 12px; border-bottom-right-radius: 12px;">
                                <span class="material-symbols-outlined" onclick="location.href=`/admin/murid/{{ $data_siswa->id }}/{{ $data_siswa->kelas->id }}/kelas`">edit</span>
                                <span
                                    class="material-symbols-outlined this-one ml-2" onclick="hapusSiswa({{ $data_siswa->id }})">delete</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>
</main>

@if (Session::has("deleted"))
<script>
    Noticme.any({
        text: "{{ Session::get('deleted') }}",
        type: 'success',
        timer: 5000,
    })
</script>
@endif

<script>
    function hapusSiswa(id){
        Noticme.any({
            text: 'Hapus!', 
            type: 'info',
            message: 'Apakah Anda Yakin Ingin Menghapus Data Berikut?', 
            confirm:true
        }).then(result => { 
            if(result){ 
                location.href=`/admin/hapus_siswa/${id}/kelas` 
            } 
        })
    }
    function openfc() {
        var close_state = document.getElementsByClassName('child')
        for (let i = 0; i < close_state.length; i++) {
            const element = close_state[i];
            if (element.classList.contains('hidden')) {
                element.classList.remove('hidden')
                element.classList.add('block')
            } else {
                element.classList.remove('block')
                element.classList.add('hidden')
            }
        }
    }
    function opensrcadmin(where, __self, size) {
        let inp = document.getElementById(where)
        if (inp.classList.contains('opacity-0')) {
            __self.classList.add('text-black')
            inp.classList.add('opacity-100')
            inp.classList.add('w-[' + size + '%]')
            inp.classList.remove('select-none')
            inp.classList.remove('cursor-default')
            inp.classList.remove('w-[10%]')
            inp.classList.remove('opacity-0')
        } else {
            __self.classList.remove('text-black')
            inp.classList.remove('opacity-100')
            inp.classList.remove('w-[' + size + '%]')
            inp.classList.add('w-[10%]')
            inp.classList.add('cursor-default')
            inp.classList.add('select-none')
            inp.classList.add('opacity-0')
        }
    }
</script>
</body>

@endsection