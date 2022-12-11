 <!-- table_absen -->
 <table class="w-full" cellpadding="10" >
    <!-- header table -->
    <thead class="font-extrabold bg-white top-0 sticky z-10 bg-bg">
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
    <tbody class="text-center text-base font-bold text-n-tet-x cursor-pointer select-none relative">

    @foreach ($data_absensi as $data_absen)
        <tr class="text-black" id="dat-s-{{ $i }}" name="row-siswa">
            <td style="border-top-left-radius: 12px; border-bottom-left-radius: 12px;">{{ $no++ }}</td>

            <input type="hidden" value="{{ $data_absen->id }}" name="id_siswa">

            <td class="">{{ $data_absen->siswa->nama_siswa }}</td>
            <td name="jam_masuk">{{  $data_absen->masuk }}</td>
            <td name="jam_pulang">{{ $data_absen->pulang }}</td>

            <td class="text-center">
                <!-- select keterangan -->
                <select
                    class="block text-center mx-auto py-2.5 px-2 text-sm text-white rounded-md bg-bg-blue-dark border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer" name="keterangan">

                    <option value="Belum Hadir" {{ $data_absen->keterangan === 'Belum Hadir' ? 'selected' : '' }}>Belum Hadir</option>

                    <option value="Hadir" {{ $data_absen->keterangan === 'Hadir' ? 'selected' : '' }}> Hadir</option>

                    <option value="Alpha" {{ $data_absen->keterangan === 'Alpha' ? 'selected' : '' }}>Alpha</option>

                    <option value="Terlambat" {{ $data_absen->keterangan === 'Terlambat' ? 'selected' : '' }}>Terlambat</option>

                    <option value="Sakit" {{ $data_absen->keterangan === 'Sakit' ? 'selected' : '' }}>Sakit</option>

                    <option value="Izin" {{ $data_absen->keterangan === 'Izin' ? 'selected' : '' }}>Izin
                    </option>

                </select>
                <input type="hidden" name="keterangan_absen">

            </td>
            <td style="border-top-right-radius: 12px; border-bottom-right-radius: 12px;">
                <label class="toggle">
                    <input class="toggle__input" type="checkbox"
                        {{-- onclick="selectRow('dat-s-1', this)"  --}}
                        onclick = 'tes("dat-s-{{ $i++ }}")' 
                        name="checkbox">
                    <span class="toggle__label">
                    </span>
                </label>
            </td>
        </tr>
    @endforeach
        <!-- pilih semua -->
        <tr class="sticky -bottom-2 z-10 bg-bg">
            <td colspan="4" ></td>
            <td class="text-center">Pilih Semua</td>
            <td>
                <label class="toggle">
                    <input class="toggle__input" type="checkbox"
                        {{-- onclick="selectRow('dat-s-1', this)" --}}
                         id="select_all">
                    <span class="toggle__label">
                    </span>
                </label>
            </td>
        </tr>

    </tbody>
</table>



<script>
    var date = new Date()
    var date_now = date.getHours()+":"+date.getMinutes()+":"+date.getSeconds()
    var select_all = document.getElementById("select_all")
    var checkbox = document.getElementsByName("checkbox")

    var row_siswa = document.getElementsByName("row_siswa")

    // var id_siswa = document.getElementById("dat-s-1")
    
    // id_siswa.classList.toggle("active")
    
    select_all.addEventListener("click", function(){
        if(select_all.checked){
            
            for(i = 0; i < checkbox.length; i++){
                checkbox[i].checked = true
            }
            
        }else{
            
            for(i = 0; i < checkbox.length; i++){
                checkbox[i].checked = false
            }

        }
    })

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
                // jam_masuk[k] = "{{ $batas_hadir }}"
                // keterangan[k][3].setAttribute('selected', true)
                keterangans.push(keterangan[k][0].value)
            }else{
                jam_masuk[k] = jam_masuk[k]
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

                    
                    
                    Noticme.any({
                        text: ress,
                        type: 'success',
                        timer: 3000,
                        button: true
                    })
                      
                    
                    table_absen()

                    box_absen_ket()

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

        var keterangan = document.getElementsByName("keterangan")
        var masuk = document.getElementsByName("jam_masuk")
        var pulang = document.getElementsByName("jam_pulang")
        var checkbox = document.getElementsByName("checkbox")

        var keterangan_absensi = ""
        var set_keterangan = []
        var keterangan_absen = []
        for(i = 0; i < keterangan.length; i++){

            // optional
            if(checkbox[i].checked){
                
                if(keterangan[i].value == "Belum Hadir"){

                    keterangan[i][2].setAttribute('selected', true)
                    keterangan_absensi = "Tidak Hadir"

                }else if(keterangan[i].value == "Hadir"){

                    keterangan_absensi = "Hadir"

                }else if(keterangan[i].value == "Alpha"){

                    keterangan_absensi = "Tidak Hadir"
                    
                }else if(keterangan[i].value == "Terlambat"){
                    
                    keterangan_absensi = "Hadir"
                    
                }else if(keterangan[i].value == "Sakit"){

                    if (masuk[i].textContent != "--") {

                        // ketika hadir
                        if(masuk[i].textContent >= "{{ $data_mulai }}" && masuk[i].textContent < "{{ $batas_hadir }}"){

                            masuk[i].textContent = masuk[i].textContent
                            keterangan_absensi = "Hadir"
                            // console.log(masuk[i].textContent)

                        }else if(masuk[i].textContent >= "{{ $batas_hadir }}"){ //ketika terlambat

                            keterangan_absensi = "Tidak Hadir"
                            masuk[i].textContent = masuk[i].textContent

                        }

                    }else{ //ketika tidak ada jam masuk

                        keterangan_absensi = "Tidak Hadir"
                        masuk[i].textContent = "{{ $batas_hadir }}"

                    }
                    
                }else if(keterangan[i].value == "Izin"){

                    if (masuk[i].textContent != "--") {

                        // ketika hadir
                        if(masuk[i].textContent >= "{{ $data_mulai }}" && masuk[i].textContent < "{{ $batas_hadir }}"){

                            masuk[i].textContent = masuk[i].textContent
                            keterangan_absensi = "Hadir"
                            // console.log(masuk[i].textContent)

                        }else if(masuk[i].textContent >= "{{ $batas_hadir }}"){ //ketika terlambat

                            keterangan_absensi = "Tidak Hadir"
                            masuk[i].textContent = masuk[i].textContent

                        }

                    }else{ //ketika tidak ada jam masuk

                        keterangan_absensi = "Tidak Hadir"
                        masuk[i].textContent = "{{ $batas_hadir }}"

                    }

                }
                
            }

            keterangan_absen.push(keterangan_absensi)
            
            set_keterangan.push(keterangan[i].value)

        }
        // console.log(set_keterangan)
        console.log(keterangan_absen)
        
        var data_pulang = []
        var date = new Date()
        for (p = 0; p < pulang.length; p++) {

            if (checkbox[p].checked) {

                // console.log(masuk[p].textContent)

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
                data_pulang: data_pulang[w],
                set_keterangans: set_keterangan[w],
                keterangan_absens: keterangan_absen[w]
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

                    
                    Noticme.any({
                        text: ress,
                        type: 'success',
                        timer: 3000,
                        button: true
                    })

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

        var keterangan_absen = document.getElementsByName("keterangan_absen")

        var check = document.getElementsByName("checkbox") // checkbox

        // console.log(check[0].value)

        var checks = []

        var checks_absen = []

        for (j = 0; j < check.length; j++) {

            if (centang_ket == "notSelected") {
                // box_absen_ket()

                checks.push(keterangan[j].value)
                

                if (checks[j] === "Belum Hadir") {
                    keterangan[j][0].setAttribute('selected', true)
                    if (mulais[j] != "--") {
                        // keterangan_absen[j].value = ""
                        mulais[j] = "--"
                    }else{
                        mulais[j] = "--"
                    }
                }

                if (checks[j] === "Hadir") {
                    keterangan[j][1].setAttribute('selected', true)

                    if (mulais[j] == "--") {
                        mulais[j] = "{{ $data_mulai }}"
                        keterangan_absen[j].value = "Hadir"
                    }else{
                        mulais[j] = "{{ $data_mulai }}"
                        keterangan_absen[j].value = "Hadir"
                    }

                    // table_absen()
                }

                if (checks[j] === "Alpha") {
                    keterangan[j][2].setAttribute('selected', true)
                    if (mulais[j] != "--") {
                        mulais[j] = "--"
                        keterangan_absen[j].value = "Tidak Hadir"
                    }else{
                        mulais[j] = "--"
                        keterangan_absen[j].value = "Tidak Hadir"
                    }
                }

                if (checks[j] === "Terlambat") {
                    keterangan[j][3].setAttribute('selected', true)
                    if (mulais[j] == "--") {
                        mulais[j] = "{{ $batas_hadir }}"
                        keterangan_absen[j].value = "Hadir"
                    }else{
                        mulais[j] = "{{ $batas_hadir }}"
                        keterangan_absen[j].value = "Hadir"
                    }
                }

                if (checks[j] === "Sakit") {
                    keterangan[j][4].setAttribute('selected', true)

                    // ketika sudah ada jam masuk
                    if (mulais[j] != "--") {

                        // ketika hadir
                        if(mulais[j] >= "{{ $data_mulai }}" && mulais[j] < "{{ $batas_hadir }}"){

                            mulais[j] = mulais[j]
                            keterangan_absen[j].value = "Hadir"
                            // console.log(mulais[j])

                        }else if(mulais[j] >= "{{ $batas_hadir }}"){ //ketika terlambat

                            keterangan_absen[j].value = "Tidak Hadir"
                            mulais[j] = mulais[j]

                        }

                    }else{ //ketika tidak ada jam masuk

                        keterangan_absen[j].value = "Tidak Hadir"
                        mulais[j] = "{{ $batas_hadir }}"

                    }
                }

                if (checks[j] === "Izin") {
                    keterangan[j][5].setAttribute('selected', true)

                    if (mulais[j] != "--") {
                        // ketika hadir
                        if(mulais[j] >= "{{ $data_mulai }}" && mulais[j] < "{{ $batas_hadir }}"){

                            mulais[j] = mulais[j]
                            keterangan_absen[j].value = "Hadir"
                            // console.log(mulais[j])

                        }else if(mulais[j] >= "{{ $batas_hadir }}"){ //ketika terlambat

                            keterangan_absen[j].value = "Tidak Hadir"
                            mulais[j] = mulais[j]

                        }

                    }else{

                        keterangan_absen[j].value = "Tidak Hadir"
                        mulais[j] = "{{ $batas_hadir }}"

                    }

                }

                checks_absen.push(keterangan_absen[j].value)

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
                        keterangan_absen[j].value = "Tidak Hadir"
                    }else{
                        mulais[j] = "--"
                        keterangan_absen[j].value = "Tidak Hadir"
                    }
                }

                if (checks[j] === "Hadir") {
                    keterangan[j][1].setAttribute('selected', true)

                    if (mulais[j] == "--") {
                        mulais[j] = "{{ $data_mulai }}"
                        keterangan_absen[j].value = "Hadir"
                    }else{
                        mulais[j] = "{{ $data_mulai }}"
                        keterangan_absen[j].value = "Hadir"
                    }
                }

                if (checks[j] === "Terlambat") {
                    keterangan[j][3].setAttribute('selected', true)
                    if (mulais[j] != "--") {
                        mulais[j] = "{{ $batas_hadir }}"
                        keterangan_absen[j].value= "Hadir"
                    }else{
                        mulais[j] = "{{ $batas_hadir }}"
                        keterangan_absen[j].value= "Hadir"
                    }
                }

                if (checks[j] === "Sakit") {
                    keterangan[j][4].setAttribute('selected', true)

                    // ketika sudah ada jam masuk
                    if (mulais[j] != "--") {

                        // ketika hadir
                        if(mulais[j] >= "{{ $data_mulai }}" && mulais[j] < "{{ $batas_hadir }}"){

                            mulais[j] = mulais[j]
                            keterangan_absen[j].value = "Hadir"
                            // console.log(mulais[j])

                        }else if(mulais[j] >= "{{ $batas_hadir }}"){ //ketika terlambat

                            keterangan_absen[j].value = "Tidak Hadir"
                            mulais[j] = mulais[j]

                        }

                    }else{ //ketika tidak ada jam masuk

                        keterangan_absen[j].value = "Tidak Hadir"
                        mulais[j] = "{{ $batas_hadir }}"

                    }

                }

                if (checks[j] === "Izin") {
                    keterangan[j][5].setAttribute('selected', true)
                    if (mulais[j] != "--") {

                        // ketika hadir
                        if(mulais[j] >= "{{ $data_mulai }}" && mulais[j] < "{{ $batas_hadir }}"){

                            mulais[j] = mulais[j]
                            keterangan_absen[j].value = "Hadir"
                            // console.log(mulais[j])

                        }else if(mulais[j] >= "{{ $batas_hadir }}"){ //ketika terlambat

                            keterangan_absen[j].value = "Tidak Hadir"
                            mulais[j] = mulais[j]

                        }

                    }else{ //ketika tidak ada jam masuk

                        keterangan_absen[j].value = "Tidak Hadir"
                        mulais[j] = "{{ $batas_hadir }}"

                    }
                }

                checks_absen.push(keterangan_absen[j].value)

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
                        keterangan_absen[j].value = "Tidak Hadir"
                    }else{
                        mulais[j] = "--"
                        keterangan_absen[j].value = "Tidak Hadir"
                    }
                }

                if (checks[j] === "Hadir") {
                    keterangan[j][1].setAttribute('selected', true)

                    if (mulais[j] == "--") {
                        mulais[j] = "{{ $data_mulai }}"
                        keterangan_absen[j].value = "Hadir"
                    }else{
                        mulais[j] = "{{ $data_mulai }}"
                        keterangan_absen[j].value = "Hadir"
                    }
                }

                if (checks[j] === "Terlambat") {
                    keterangan[j][3].setAttribute('selected', true)
                    if (mulais[j] != "--") {
                        mulais[j] = "{{ $batas_hadir }}"
                        keterangan_absen[j].value = "Hadir"
                    }else{
                        mulais[j] = "{{ $batas_hadir }}"
                        keterangan_absen[j].value = "Hadir"
                    }
                }

                if (checks[j] === "Sakit") {
                    keterangan[j][4].setAttribute('selected', true)
                    if (mulais[j] != "--") {

                        // ketika hadir
                        if(mulais[j] >= "{{ $data_mulai }}" && mulais[j] < "{{ $batas_hadir }}"){

                            mulais[j] = mulais[j]
                            keterangan_absen[j].value = "Hadir"
                            // console.log(mulais[j])

                        }else if(mulais[j] >= "{{ $batas_hadir }}"){ //ketika terlambat

                            keterangan_absen[j].value = "Tidak Hadir"
                            mulais[j] = mulais[j]

                        }

                    }else{ //ketika tidak ada jam masuk

                        keterangan_absen[j].value = "Tidak Hadir"
                        mulais[j] = "{{ $batas_hadir }}"

                    }
                }

                if (checks[j] === "Izin") {
                    keterangan[j][5].setAttribute('selected', true)
                    if (mulais[j] != "--") {

                        // ketika hadir
                        if(mulais[j] >= "{{ $data_mulai }}" && mulais[j] < "{{ $batas_hadir }}"){

                            mulais[j] = mulais[j]
                            keterangan_absen[j].value = "Hadir"
                            // console.log(mulais[j])

                        }else if(mulais[j] >= "{{ $batas_hadir }}"){ //ketika terlambat

                            keterangan_absen[j].value = "Tidak Hadir"
                            mulais[j] = mulais[j]

                        }

                    }else{ //ketika tidak ada jam masuk

                        keterangan_absen[j].value = "Tidak Hadir"
                        mulais[j] = "{{ $batas_hadir }}"

                    }
                }

                checks_absen.push(keterangan_absen[j].value)

            }
            // console.log(checks)
            // console.log(checks_absen)
            // table_absen()
        }

        // keseluruhan

        var all = []
        for (i = 0; i < id_siswa.length; i++) {

            all.push({
                id_siswa: id_siswas[i],
                mulai: mulais[i],
                check: checks[i],
                check_absen : checks_absen[i]
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

                    
                    Noticme.any({
                        text: ress,
                        type: 'success',
                        timer: 3000,
                        button: true
                    })

                    table_absen()
                    
                    box_absen_ket()
                }
            });
        }
    }
</script>
