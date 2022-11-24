<div>
    @foreach ($data_jadwals as $data_jadwal)
        <p class="text-[#656363]">Mapel</p>
        <int class="text-blue-normal-19 text-xl">{{ $data_jadwal->mapel->pelajaran }}</int>
    @endforeach
</div>
<div>
    <p class="text-[#656363]">Total Siswa</p>
    <int class="text-blue-normal-19 text-xl">{{ count($data_siswas) }} Orang</int>
</div>
<div>
    <p class="text-[#656363]">Belum Hadir</p>
    <int class="text-blue-normal-19 text-xl" id="belum_hadir">{{ count($belum_hadir) }} Orang</int>
</div>

{{-- manipulasi text content belum hadir --}}
<script>
    var belum_hadir = document.getElementById("belum_hadir")

    if (belum_hadir.textContent == "0 Orang") {
        belum_hadir.textContent = "-"
    }
</script>