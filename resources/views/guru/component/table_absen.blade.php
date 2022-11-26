<table class="w-full" cellpadding="10">
    <!-- header table -->
    <thead class="font-extrabold bg-white top-0 sticky z-10">
        <tr class="text-sm text-un-tet">
            <th class="p-3 w-32">No</th>
            <th class="p-3">Nama</th>
            <th class="p-3">Masuk</th>
            <th class="p-3">Pulang</th>
            <th class="p-3">Keterangan</th>
            <th class="p-3">Aksi</th>
        </tr>
    </thead>
    <!-- body -->
    <tbody class="text-center text-base font-bold text-n-tet-x cursor-pointer select-none">

        @foreach ($data_absensi as $data_absen)
            <tr class="text-black" id="dat-s-{{ $i }}" name="row-siswa">

                <td style="border-top-left-radius: 12px; border-bottom-left-radius: 12px;">
                    {{ $no++ }}</td>

                <input type="hidden" value="{{ $data_absen->id }}" name="id_siswa">

                <td class="text-left">{{ $data_absen->siswa->nama_siswa }}</td>
                <td name="jam_masuk">{{ $data_absen->masuk }}</td>
                <td name="jam_pulang">{{ $data_absen->pulang }}</td>
                <td class="text-left">

                    <select class="custom-select mx-auto" name="keterangan" id="">

                        <option value="Belum Hadir" {{ $data_absen->keterangan === 'Belum Hadir' ? 'selected' : '' }}>
                            Belum Hadir</option>
                        <option value="Hadir" {{ $data_absen->keterangan === 'Hadir' ? 'selected' : '' }}>Hadir
                        </option>
                        <option value="Alpha" {{ $data_absen->keterangan === 'Alpha' ? 'selected' : '' }}>Alpha
                        </option>
                        <option value="Terlambat" {{ $data_absen->keterangan === 'Terlambat' ? 'selected' : '' }}>
                            Terlambat</option>
                        <option value="Sakit" {{ $data_absen->keterangan === 'Sakit' ? 'selected' : '' }}>Sakit
                        </option>
                        <option value="Izin" {{ $data_absen->keterangan === 'Izin' ? 'selected' : '' }}>Izin
                        </option>

                    </select>

                </td>
                <td style="border-top-right-radius: 12px; border-bottom-right-radius: 12px;">
                    <label class="toggle">
                        <input class="toggle__input" type="checkbox" onclick="tes('dat-s-{{ $i++ }}')"
                            name="checkbox">
                        <span class="toggle__label">
                        </span>
                    </label>
                </td>
            </tr>
        @endforeach

    </tbody>
</table>
<div style="border-top: black solid 2px; padding: 10px 30px; display: flex; justify-content: space-between;">
    <p>Centang Semua ---</p>
    <input type="checkbox" onclick="centang(this)"></td>
</div>



<script>
    function centang(any) {
        if (any.checked) {
            var checkbox = document.getElementsByName('checkbox')
            for (r = 0; r < checkbox.length; r++) {
                checkbox[r].setAttribute('checked', true)
            }
        } else {
            var checkbox = document.getElementsByName('checkbox')
            for (i = 0; i < checkbox.length; i++) {
                checkbox[i].removeAttribute('checked')
            }
        }
    }

    function tes(any) {
        document.getElementById(any).classList.toggle("active")
    }

    function tutup_absen() {

        var id_siswa = document.getElementsByName("id_siswa")

        var id_siswas = []

        for (i = 0; i < id_siswa.length; i++) {
            id_siswas.push(id_siswa[i].value)
        }
        // console.log(id_siswas)

        var masuk = document.getElementsByName("jam_masuk")

        var jam_masuk = []

        for(j = 0; j < masuk.length; j++){
            jam_masuk.push(masuk[j].textContent)
        }

        // console.log(jam_masuk)
        
        var keterangan = document.getElementsByName("keterangan")

        var keterangans = []

        for(k = 0; k < id_siswa.length; k++){

            if(masuk[k].textContent == "--"){
                jam_masuk[k] = "{{ $data_mulai }}"
                // keterangan[k][3].setAttribute('selected', true)
                keterangans.push(keterangan[k][3].value)
            }else{
                keterangans.push(keterangan[k].value)
            }

        }

        var data_keterlambatan = []

        for(a = 0; a < id_siswa.length; a++){
            data_keterlambatan.push({
                id_siswa : id_siswas[a],
                jam_masuk : jam_masuk[a],
                keterangan : keterangans[a]
            })
        }

        // console.log(keterangans)        
        // console.log(data_absen)
        // console.log(jam_masuk)

        kirim_request_keterlambatan(data_keterlambatan)

        function kirim_request_keterlambatan(allData){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                }
            });

            $.ajax({
                url: "/absen_siswa/{{ $tanggals }}/{{ $kelas }}/{{ $mapels }}/tutup_absen",
                type: "POST",
                data: {
                    datas: allData
                },
                success: function(ress) {

                    console.log(ress)

                    
                    keiAlert(ress, "done", "bg-[#22c55e]")
                    
                    table_absen()

                }
            });

        }
    }

    // mengubah jam pulang
    function pulang() {

        var id_siswa = document.getElementsByName("id_siswa")

        var id_siswas = []

        for (i = 0; i < id_siswa.length; i++) {
            id_siswas.push(id_siswa[i].value)
        }

        // console.log(id_siswas)

        var masuk = document.getElementsByName("jam_masuk")
        var pulang = document.getElementsByName("jam_pulang")
        var checkbox = document.getElementsByName("checkbox")

        var data_pulang = []
        var date = new Date()
        for (p = 0; p < pulang.length; p++) {

            if (checkbox[p].checked) {

                console.log(masuk[p].textContent)

                if(masuk[p].textContent == "--"){

                    data_pulang.push(pulang[p].textContent)
                }else{

                    data_pulang.push("{{ $data_selesai }}")
                }
                // data_pulang.push(date.getHours()+":"+date.getMinutes()+":"+date.getSeconds())
    
                // data_pulang.push(masuk[p].textContent)
                    
            


            } else {
                data_pulang.push(pulang[p].textContent)
                // keiAlert("Tidak ada yang di pilih!", "close", "bg-red-600");
            }

        }

        var data_waktu = []

        for (w = 0; w < id_siswa.length; w++) {
            data_waktu.push({
                id_siswa: id_siswa[w].value,
                data_pulang: data_pulang[w]
            })
        }

        // console.log(data_waktu)

        kirim_request_waktu(data_waktu)

        function kirim_request_waktu(allData) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                }
            });

            $.ajax({
                url: "/absen_siswa/{{ $tanggals }}/{{ $kelas }}/{{ $mapels }}/manual_pulang",
                type: "POST",
                data: {
                    datas: allData
                },
                success: function(ress) {

                    // console.log(ress)

                    
                    keiAlert(ress, "done", "bg-[#22c55e]")

                    table_absen()

                }
            });

        }
    }

    // mengubah ketaragngan 
    function save() {

        // menangkap id siswa
        var id_siswa = document.getElementsByName("id_siswa")

        var id_siswas = []

        // menangkap id siswa ke dalam array
        for (i = 0; i < id_siswa.length; i++) {
            id_siswas.push(id_siswa[i].value)
            // console.log(id_siswas)
        }


        // menangkap jam masuk
        var mulai = document.getElementsByName("jam_masuk")

        var mulais = []

        // menangkap jam mulai ke dalam array
        for (j = 0; j < mulai.length; j++) {
            mulais.push(mulai[j].textContent)
            // console.log(mulais)
        }


        // meng set centang keterangan
        var ket = document.getElementsByName("ket")

        var centang_ket = "notSelected"

        for (cent = 0; cent < ket.length; cent++) {

            if (ket[cent].checked) {
                centang_ket = ket[cent].value

                // console.log(centang_ket)
            }

        }


        // keterangan option dan checkbox
        var keterangan = document.getElementsByName("keterangan") //keterangan 

        var check = document.getElementsByName("checkbox") // checkbox

        // console.log(check[0].value)

        var checks = []

        for (j = 0; j < check.length; j++) {

            if (centang_ket == "notSelected") {
                // box_absen_ket()

                checks.push(keterangan[j].value)

                if (checks[j] === "Belum Hadir") {
                    keterangan[j][0].setAttribute('selected', true)
                    if (mulais[j] != "--") {
                        mulais[j] = "--"
                    }
                }

                if (checks[j] === "Hadir") {
                    keterangan[j][1].setAttribute('selected', true)

                    if (mulais[j] == "--") {
                        mulais[j] = "{{ $data_mulai }}"
                    }

                    // table_absen()
                }

                if (checks[j] === "Alpha") {
                    keterangan[j][2].setAttribute('selected', true)
                    if (mulais[j] != "--") {
                        mulais[j] = "--"
                    }
                }

                if (checks[j] === "Terlambat") {
                    keterangan[j][3].setAttribute('selected', true)
                    if (mulais[j] == "--") {
                        mulais[j] = "--"
                    }
                }

                if (checks[j] === "Sakit") {
                    keterangan[j][4].setAttribute('selected', true)
                    if (mulais[j] != "--") {
                        mulais[j] = "--"
                    }
                }

                if (checks[j] === "Izin") {
                    keterangan[j][5].setAttribute('selected', true)
                    if (mulais[j] != "--") {
                        mulais[j] = "--"
                    }
                }

            } else if (check[j].checked) {
                // box_absen_ket()
                // table_absen()

                check[j].setAttribute("checked", true)
                checks.push(centang_ket)

                // console.log(checks)
                if (checks[j] === "Belum Hadir") {
                    keterangan[j][0].setAttribute('selected', true)
                    if (mulais[j] != "--") {
                        mulais[j] = "--"
                    }
                }

                if (checks[j] === "Alpha") {
                    keterangan[j][2].setAttribute('selected', true)
                    if (mulais[j] != "--") {
                        mulais[j] = "--"
                    }
                }

                if (checks[j] === "Hadir") {
                    keterangan[j][1].setAttribute('selected', true)

                    if (mulais[j] == "--") {
                        mulais[j] = "{{ $data_mulai }}"
                    }
                }

                if (checks[j] === "Terlambat") {
                    keterangan[j][3].setAttribute('selected', true)
                    if (mulais[j] != "--") {
                        mulais[j] = "--"
                    }
                }

                if (checks[j] === "Sakit") {
                    keterangan[j][4].setAttribute('selected', true)
                    if (mulais[j] != "--") {
                        mulais[j] = "--"
                    }
                }

                if (checks[j] === "Izin") {
                    keterangan[j][5].setAttribute('selected', true)
                    if (mulais[j] != "--") {
                        mulais[j] = "--"
                    }
                }

            } else {
                // box_absen_ket()
                checks.push(keterangan[j].value)

                if (checks[j] === "Belum Hadir") {
                    keterangan[j][0].setAttribute('selected', true)
                    if (mulais[j] != "--") {
                        mulais[j] = "--"
                    }
                }

                if (checks[j] === "Alpha") {
                    keterangan[j][2].setAttribute('selected', true)
                    if (mulais[j] != "--") {
                        mulais[j] = "--"
                    }
                }

                if (checks[j] === "Hadir") {
                    keterangan[j][1].setAttribute('selected', true)

                    if (mulais[j] == "--") {
                        mulais[j] = "{{ $data_mulai }}"
                    }
                }

                if (checks[j] === "Terlambat") {
                    keterangan[j][3].setAttribute('selected', true)
                    if (mulais[j] != "--") {
                        mulais[j] = "--"
                    }
                }

                if (checks[j] === "Sakit") {
                    keterangan[j][4].setAttribute('selected', true)
                    if (mulais[j] != "--") {
                        mulais[j] = "--"
                    }
                }

                if (checks[j] === "Izin") {
                    keterangan[j][5].setAttribute('selected', true)
                    if (mulais[j] != "--") {
                        mulais[j] = "--"
                    }
                }

            }
            // console.log(checks)
            // table_absen()
        }

        // keseluruhan

        var all = []
        for (i = 0; i < id_siswa.length; i++) {

            all.push({
                id_siswa: id_siswas[i],
                mulai: mulais[i],
                check: checks[i]
            })

        }

        // console.log(all)
        kirim_request_keterangan(all)

        function kirim_request_keterangan(allData) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                }
            });

            $.ajax({
                url: "/absen_siswa/{{ $tanggals }}/{{ $kelas }}/{{ $mapels }}",
                type: "POST",
                data: {
                    datas: allData
                },
                success: function(ress) {

                    
                    keiAlert(ress, "done", "bg-[#22c55e]")

                    table_absen()
                    
                    box_absen_ket()
                }
            });
        }
    }
</script>
