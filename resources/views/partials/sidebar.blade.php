<div class="px-14 py-20 shadow-side w-fit h-[100vh] top-16 fixed z-40">
    <a href="/profile">
        <div class=" {{ ($title === "profile_guru") ? 'font-black text-bg-blue-dark' : 'text-dark-data' }} hover:font-black hover:text-bg-blue-dark"><span class="material-symbols-outlined -mb-3 mr-5 {{ ($title === "profile_guru") ? 'p-1 rounded-md text-white bg-bg-blue-dark' : '' }} hover:p-1 hover:rounded-md hover:text-white hover:bg-bg-blue-dark">person</span>
            Profile
        </div>
    </a> 
    <a href="/">
        <div class="{{ ($title === "dashboard_guru") ? 'mt-10 font-black text-bg-blue-dark' : 'mt-10 text-dark-data' }} hover:mt-10 hover:font-black hover:text-bg-blue-dark"><span class="material-symbols-outlined -mb-3 mr-5 {{ ($title === "dashboard_guru") ? 'p-1 rounded-md text-white bg-bg-blue-dark' : '' }} hover:p-1 hover:rounded-md hover:text-white hover:bg-bg-blue-dark">home</span>
            Dashboard
        </div>
    </a>
    <a class="cursor-pointer" @if($jum_kelas > 0 && $jum_mapel > 0)href="/absensi"@else onclick="validate('Anda Harus Memilih Kelas Dan Mapel')"@endif>
        <div class="{{ ($title === "absensi") ? 'mt-10 font-black text-bg-blue-dark' : 'mt-10 text-dark-data' }} hover:mt-10 hover:font-black hover:text-bg-blue-dark"><span class="material-symbols-outlined -mb-3 mr-5 {{ ($title === "absensi") ? 'p-1 rounded-md text-white bg-bg-blue-dark' : '' }} hover:p-1 hover:rounded-md hover:text-white hover:bg-bg-blue-dark">library_books</span>
            Absen
        </div>
    </a>
    <a class="cursor-pointer" @if($jum_kelas > 0 && $jum_mapel > 0) href="/data_kelas"@else onclick="validate('Anda Harus Memilih Kelas Dan Mapel')"@endif>
        <div class="{{ ($title === "data_kelas") ? 'mt-10 font-black text-bg-blue-dark' : 'mt-10 text-dark-data' }} hover:mt-10 hover:font-black hover:text-bg-blue-dark"><span class="material-symbols-outlined -mb-3 mr-5 {{ ($title === "data_kelas") ? 'p-1 rounded-md text-white bg-bg-blue-dark' : '' }} hover:p-1 hover:rounded-md hover:text-white hover:bg-bg-blue-dark">assignment_ind</span>
            Data Kelas
        </div>
    </a>
    <a href="/dokumentasi">
        <div class="mt-10 text-dark-data hover:mt-10 hover:font-black hover:text-bg-blue-dark"><span class="material-symbols-outlined -mb-3 mr-5 hover:p-1 hover:rounded-md hover:text-white hover:bg-bg-blue-dark">sms_failed</span>
            Dokumentasi
        </div>
    </a>
</div>