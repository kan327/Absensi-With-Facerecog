<!-- content -->
<div class="absolute left-72 w-3/4">
        <h1 class="text-3xl text-blue font-bold mt-32 font-[Montserrat]">Hai, {{ auth()->guard("user")->user()->username }} !</h1>
        <div class="mt-10 flex w-full justify-evenly">
            <!-- box 1 session -->
            <div 
                class="border-stroke hover:bg-blue hover:text-white border-2 border-solid p-6 rounded-md w-[28%] flex justify-between cursor-pointer">
                <div>
                    <h3 class="font-semibold text-sm">Sesi Aktif</h3>
                    <h2 class="text-xl font-extrabold">XI-PPLG 1</h2>
                </div>
                <int class="font-bold text-2xl mt-2">Masuk</int>
            </div>
            <!-- box 2 -->
            <div
                class="border-stroke hover:bg-blue hover:text-white border-2 border-solid p-6 rounded-md w-[28%] flex justify-between cursor-pointer">
                <div>
                    <h3 class="font-semibold text-sm">Jadwal</h3>
                    <h2 class="text-xl font-extrabold">Mata Pelajaran</h2>
                </div>
                <int class="font-bold"><span class="material-symbols-outlined" style="font-size: 40px;">add_box</span>
                </int>
            </div>
            <!-- box 3 -->
            <div
                class="border-stroke hover:bg-blue hover:text-white border-2 border-solid p-6 rounded-md w-[28%] flex justify-between web-hover cursor-pointer">
                <div>
                    <h3 class="font-semibold text-sm">Total</h3>
                    <h2 class="text-xl font-extrabold">Kelas Anda!</h2>
                </div>
                <int class="font-bold text-sm mt-2 h-10 w-[80px] overflow-y-auto overflow-x-hidden">
                    XI PPLG 1, <br> XI MM 2, <br> XI TEI 2, <br> XI TKJ 1, <br> XI BC 1</int>
            </div>
            <!-- -- -->
        </div>
        <!-- contains 2 big box -->
        <div class="mt-10 flex w-full justify-evenly">
            <!-- box 1 bio -->
            <div class="border-stroke border-2 border-solid p-6 rounded-md w-[44%]">
                <h1 class="text-xl font-extrabold">Data Diri</h1>
                <div class="flex w-full justify-between"> 
                    <table class="font-medium mt-5" cellpadding = '5'>
                        <tr>
                            <td>NIP</td>
                            <td>:</td>
                            <td class="break-words max-w-[150px]"> {{ auth()->guard("user")->user()->id }}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td class="break-words max-w-[150px]"> {{ auth()->guard("user")->user()->username }}</td>
                        </tr>
                        <tr>
                            <td>No. Telepon</td>
                            <td>:</td>
                            <td class="break-words max-w-[150px]"> 0{{ auth()->guard("user")->user()->no_hp }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td class="break-words max-w-[150px]"> {{ auth()->guard("user")->user()->email }}</td>
                        </tr>
                    </table>
                    <img src="{{ asset('assets/img/image 54.png') }}" class="rounded w-28 h-36" alt="Your profile :3">
                </div>

            </div>
            <!-- box 2 -->
            <div class="border-stroke border-2 border-solid p-3 flex flex-col rounded-md w-[44%]">
                <h1 class="text-xl font-extrabold w-fit mx-auto">Absen Terbaru</h1>
                <div class="h-[165px] w-full overflow-y-auto overflow-x-hidden">
                    <!-- table -->
                    <table class="w-full ">
                        <thead class="table-fixed">
                            <tr class="border-blue-dark border-t-0 border-l-0 border-r-0 border-[1px] border-solid">
                                <th>No</th>
                                <th>Name</th>
                                <th>Kelas</th>
                                <th>Masuk</th>
                                <th>pulang</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-tet-x text-tet-x border-t-0 border-l-0 border-r-0 border-[1px] border-solid hover:text-blue hover:border-blue cursor-pointer">
                                <th>1</th>
                                <th class="break-words max-w-[147px]">Fathir Akmal B</th>
                                <th>XI - PPLG 1</th>
                                <th>07.45</th>
                                <th>07.45</th>
                            </tr>
                        </tbody>
                        
                    </table>
                </div>
            </div>
            <!-- -- -->
        </div>
    </div>

<!-- Tailwind -->
<script src="https://cdn.tailwindcss.com"></script>
<!-- npx tailwindcss -i ./src/input.css -o ./public/assets/css/output.css --watch -->