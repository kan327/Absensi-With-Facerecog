
{{-- Content Absensi --}}

<div class="absolute left-72 w-3/4">
        <h1 class="text-3xl text-blue font-bold mt-32 font-[Montserrat]">Riwayat Mata Pelajaran</h1>
        <button class="bg-blue text-white py-2 px-4 rounded-xl mt-5 w-fit mx-auto font-semibold" onclick="keiAlert('Data Berhasil Disimpan')">+ Buat</button>

        <!-- table -->
        <div class="h-96 overflow-auto mt-5">
            <table class="w-full font-[Montserrat]">
                <thead class="text-blue-table bg-white font-extrabold text-xl shadow-stable top-0 sticky z-10">
                    <tr class="">
                        <th class="p-3">NO</th>
                        <th class="p-3">HARI</th>
                        <th class="p-3">KELAS</th>
                        <th class="p-3">MAPEL</th>
                        <th class="p-3">MULAI</th>
                        <th class="p-3">PULANG</th>
                        <th class="p-3">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                        <tr class="text-center border-tet-x border-t-0 border-l-0 border-r-0 border-[1px] border-solid hover:font-bold cursor-pointer">
                            <td class="p-3"><a href="/absensi/siswa/XI PPLG 1/PBO">1</a></td>
                            
                            <td class="p-3"><a href="/absensi/siswa_masuk/XI PPLG 1/PBO">27/10/2022</a></td>
                            <td class="p-3"><a href="/absensi/siswa_masuk/XI PPLG 1/PBO">XI PPLG 1</a></td>
                            <td class="p-3"><a href="/absensi/siswa_masuk/XI PPLG 1/PBO">PBO</a></td>
                            <td class="p-3"><a href="/absensi/siswa_masuk/XI PPLG 1/PBO">07.00</a></td>
                            <td class="p-3"><a href="/absensi/siswa_masuk/XI PPLG 1/PBO">12.40</a></td>
                            <td class="p-3"><span class="material-symbols-outlined -mb-3 mr-5">edit</span> <span class="material-symbols-outlined -mb-3 mr-5">folder</span></td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- jquery --}}
    <script src="{{ asset('assets/JS/jquery.js') }}"></script>

    {{-- <script>
        $(document).ready(function () {
            let lastcnt = 0;
            let cnt;
            chkNewScan();

            function chkNewScan() {
                countTodayScan();
                setTimeout(chkNewScan, 1000);
            }

            function countTodayScan() {
                $.ajax({
                    url: '/countTodayScan',
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        cnt = data.rowcount;
                        if (cnt > lastcnt) {
                            reloadTable();
                        }
                        lastcnt = cnt;
                    },
                    error: function (result) {
                        console.log('no result!')
                    }
                })
            }

            function reloadTable() {
                $.ajax({
                    url: '/loadData',
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        var tr = $("#totalabsen");
                        tr.empty();
                        $.each(response, function (index, item) {
                            inc = 1
                            if (item.length > 0) {
                                for (let i = 0; i < item.length; i++) {
                                    tr.append('<tr class="text-center border-tet-x border-t-0 border-l-0 border-r-0 border-[1px] border-solid hover:font-bold cursor-pointer p-3">' +
                                        '<td class="p-3">' + inc + '</td>' +
                                        '<td class="p-3">' + item[i][2] + '</td>' +
                                        '<td class="p-3">' + item[i][3] + '</td>' +
                                        '<td class="p-3">' + item[i][4] + '</td>' +
                                        '<td class="p-3">' + item[i][5] + '</td>' +                                    
                                        '<td class="p-3">' + item[i][6] + '</td>' +
                                    '</tr>');
                                    inc++

                                }
                            }
                        });
                    },
                    error: function (result) {
                        console.log('no result!')
                    }
                });
            }
        });
    </script> --}}

<!-- Tailwind -->
<script src="https://cdn.tailwindcss.com"></script>
    <!-- npx tailwindcss -i ./src/input.css -o ./public/assets/css/output.css --watch -->