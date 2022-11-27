{{-- sidebar --}}

<div class="px-14 py-20 shadow-side w-fit h-[100vh] top-16 fixed">
    <a href="/profile">
        <div class="{{ ($title === 'profile_guru') ? 'font-black text-black' : 'text-un-x-tet' }}"><span class="material-symbols-outlined -mb-3 mr-5">person</span>
            Profile
        </div>
    </a>
    <a href="/">
        <div class="{{ ($title === 'dashboard_guru') ? 'mt-10 font-black text-black' : 'mt-10 text-un-x-tet' }}"><span class="material-symbols-outlined -mb-3 mr-5">home</span>
            Dashboard
        </div>
    </a>
    <a href="/absensi">
        <div class="{{ ($title === 'absensi') ? 'mt-10 font-black text-black' : 'mt-10 text-un-x-tet' }}"><span class="material-symbols-outlined -mb-3 mr-5">library_books</span>
            Absen
        </div>
    </a>
    <a href="/data_kelas">
        <div class="{{ ($title === 'data_kelas') ? 'mt-10 font-black text-black' : 'mt-10 text-un-x-tet' }}"><span class="material-symbols-outlined -mb-3 mr-5">assignment_ind</span>
            Data Kelas
        </div>
    </a>
    <div class="mt-10 text-un-x-tet"><span class="material-symbols-outlined -mb-3 mr-5">sms_failed</span>
        laporan
    </div>
</div>