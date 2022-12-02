<!-- box 1 -->
<div class="relative border-[#E3E3E5] border-2 border-solid rounded-xl h-[137px] shadow-box">
    <svg class="absolute -left-1" width="220" height="135.47" viewBox="0 0 188 117" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path
            d="M0 10C0 4.47715 4.47715 0 10 0H155.87C159.755 0 163.289 2.25085 164.932 5.77212L185.986 50.9013C188.526 56.3455 188.484 62.6432 185.872 68.0531L164.968 111.348C163.299 114.804 159.8 117 155.963 117H9.99999C4.47714 117 0 112.523 0 107V10Z"
            fill="#2C3E50" />
        <path
            d="M10 0.5H155.87C159.561 0.5 162.918 2.6383 164.479 5.98351L185.533 51.1127C188.01 56.4208 187.969 62.561 185.422 67.8357L164.518 111.131C162.933 114.414 159.609 116.5 155.963 116.5H9.99999C4.75328 116.5 0.5 112.247 0.5 107V10C0.5 4.75329 4.75329 0.5 10 0.5Z"
            stroke="black" stroke-opacity="0.1" />
    </svg>
    <div class="z-10 p-3 flex justify-between relative items-center">
        <div class="text-white">
            <p class="mb-3">01</p>
            <h2
                class="text-xl font-semibold before:absolute before:w-32 before:h-8 before:border-solid before:border-bg before:border-b-2">
                Data Siswa</h2>
            <button class="border-[1px] border-bg border-solid px-2 rounded-md mt-3 hover:scale-110 hover:text-bg-blue-dark hover:bg-white hover:font-bold" onclick="location.href = '#data_siswa'">Detail</button>
        </div>
        <int class="text-3xl font-black font-[Montserrat]">{{ count($siswas) }}</int>
    </div>
</div>
<!-- box 2 -->
<div class="relative border-[#E3E3E5] border-2 border-solid rounded-xl h-[137px] shadow-box">
    <svg class="absolute -left-1" width="220" height="135.47" viewBox="0 0 188 117" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path
            d="M0 10C0 4.47715 4.47715 0 10 0H155.87C159.755 0 163.289 2.25085 164.932 5.77212L185.986 50.9013C188.526 56.3455 188.484 62.6432 185.872 68.0531L164.968 111.348C163.299 114.804 159.8 117 155.963 117H9.99999C4.47714 117 0 112.523 0 107V10Z"
            fill="#2C3E50" />
        <path
            d="M10 0.5H155.87C159.561 0.5 162.918 2.6383 164.479 5.98351L185.533 51.1127C188.01 56.4208 187.969 62.561 185.422 67.8357L164.518 111.131C162.933 114.414 159.609 116.5 155.963 116.5H9.99999C4.75328 116.5 0.5 112.247 0.5 107V10C0.5 4.75329 4.75329 0.5 10 0.5Z"
            stroke="black" stroke-opacity="0.1" />
    </svg>
    <div class="z-10 p-3 flex justify-between relative items-center">
        <div class="text-white">
            <p class="mb-3">02</p>
            <h2
                class="text-xl font-semibold before:absolute before:w-32 before:h-8 before:border-solid before:border-bg before:border-b-2">
                Akun Guru</h2>
            <button class="border-[1px] border-bg border-solid px-2 rounded-md mt-3 hover:scale-110 hover:text-bg-blue-dark hover:bg-white hover:font-bold" onclick="location.href = '#akun_guru'">Detail</button>
        </div>
        <int class="text-3xl font-black font-[Montserrat]">{{ count($gurus) }}</int>
    </div>
</div>
<!-- box3 -->
<div class="relative border-[#E3E3E5] border-2 border-solid rounded-xl h-[137px] shadow-box">
    <svg class="absolute -left-1" width="220" height="135.47" viewBox="0 0 188 117" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path
            d="M0 10C0 4.47715 4.47715 0 10 0H155.87C159.755 0 163.289 2.25085 164.932 5.77212L185.986 50.9013C188.526 56.3455 188.484 62.6432 185.872 68.0531L164.968 111.348C163.299 114.804 159.8 117 155.963 117H9.99999C4.47714 117 0 112.523 0 107V10Z"
            fill="#2C3E50" />
        <path
            d="M10 0.5H155.87C159.561 0.5 162.918 2.6383 164.479 5.98351L185.533 51.1127C188.01 56.4208 187.969 62.561 185.422 67.8357L164.518 111.131C162.933 114.414 159.609 116.5 155.963 116.5H9.99999C4.75328 116.5 0.5 112.247 0.5 107V10C0.5 4.75329 4.75329 0.5 10 0.5Z"
            stroke="black" stroke-opacity="0.1" />
    </svg>
    <div class="z-10 p-3 flex justify-between relative items-center">
        <div class="text-white">
            <p class="mb-3">03</p>
            <h2
                class="text-xl font-semibold before:absolute before:w-32 before:h-8 before:border-solid before:border-bg before:border-b-2">
                Mata Pelajaran</h2>
            <button class="border-[1px] border-bg border-solid px-2 rounded-md mt-3 hover:scale-110 hover:text-bg-blue-dark hover:bg-white hover:font-bold" onclick="location.href = '#data_mapel'">Detail</button>
        </div>
        <int class="text-3xl font-black font-[Montserrat]">{{ count($mapels) }}</int>
    </div>
</div>
<!-- box 4 -->
<div class="relative border-[#E3E3E5] border-2 border-solid rounded-xl h-[137px] shadow-box">
    <svg class="absolute -left-1" width="220" height="135.47" viewBox="0 0 188 117" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path
            d="M0 10C0 4.47715 4.47715 0 10 0H155.87C159.755 0 163.289 2.25085 164.932 5.77212L185.986 50.9013C188.526 56.3455 188.484 62.6432 185.872 68.0531L164.968 111.348C163.299 114.804 159.8 117 155.963 117H9.99999C4.47714 117 0 112.523 0 107V10Z"
            fill="#2C3E50" />
        <path
            d="M10 0.5H155.87C159.561 0.5 162.918 2.6383 164.479 5.98351L185.533 51.1127C188.01 56.4208 187.969 62.561 185.422 67.8357L164.518 111.131C162.933 114.414 159.609 116.5 155.963 116.5H9.99999C4.75328 116.5 0.5 112.247 0.5 107V10C0.5 4.75329 4.75329 0.5 10 0.5Z"
            stroke="black" stroke-opacity="0.1" />
    </svg>
    <div class="z-10 p-3 flex justify-between relative items-center">
        <div class="text-white">
            <p class="mb-3">04</p>
            <h2
                class="text-xl font-semibold before:absolute before:w-32 before:h-8 before:border-solid before:border-bg before:border-b-2">
                Group Telegram</h2>
            <button onclick='location.href = "/admin/pino_bot"' class="border-[1px] border-bg border-solid px-2 rounded-md mt-3 hover:scale-110 hover:text-bg-blue-dark hover:bg-white hover:font-bold">Detail</button>
        </div>
        <int class="text-3xl font-black font-[Montserrat]">{{ count($kelas) }}</int>
    </div>
</div>