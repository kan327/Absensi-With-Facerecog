@foreach ($data_grup_kelas as $grup_kelas)
<div class="relative border-[#E3E3E5] border-2 border-solid rounded-xl h-[166px] shadow-box">
    <svg class="absolute -left-1" width="199" height="165" viewBox="0 0 199 165" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 10C0 4.47715 4.47715 0 10 0H163.671C167.927 0 171.716 2.69285 173.115 6.71141L197.67 77.2245C199.177 81.5538 199.152 86.2697 197.598 90.5826L173.16 158.39C171.731 162.356 167.968 165 163.752 165H10C4.47716 165 0 160.523 0 155V10Z" fill="#2C3E50"/>
        <path d="M10 0.5H163.671C167.714 0.5 171.313 3.05821 172.643 6.87584L197.198 77.3889C198.667 81.61 198.643 86.208 197.127 90.4131L172.69 158.221C171.332 161.989 167.757 164.5 163.752 164.5H10C4.7533 164.5 0.5 160.247 0.5 155V10C0.5 4.7533 4.75329 0.5 10 0.5Z" stroke="black" stroke-opacity="0.1"/>
    </svg>                                                               
    <div class="z-10 p-3 flex justify-between relative items-center">
        <div class="text-white">
            <p class="mb-3">0{{ $no_grup++ }}</p>
            <h2
                class="text-xl font-semibold before:absolute before:w-32 before:h-8 before:border-solid before:border-bg before:border-b-2 mb-2">
                {{ $grup_kelas->nama_walas }}</h2>
            <p>Chat ID : {{ $grup_kelas->chat_id }}</p>
            <button onclick="location.href = '/admin/hapus_grup_kelas/{{ $grup_kelas->id }}'" class="border-[1px] border-bg border-solid px-2 rounded-md mt-2 hover:scale-110 hover:text-bg-blue-dark hover:bg-white hover:font-bold mr-3">Delete</button>
            <button onclick="location.href ='/admin/grup_kelas/{{ $grup_kelas->id }}'" class="border-[1px] border-bg border-solid px-2 rounded-md mt-2 hover:scale-110 hover:text-bg-blue-dark hover:bg-white hover:font-bold">Edit</button>
        </div>
        <div class="text-right">
            <h3>Group</h3>
            <p class="font-semibold">{{ $grup_kelas->nama_grup }}</p>
            <h3>Kelas</h3>
            <p class="font-semibold">{{ $grup_kelas->kelas }}</p>
        </div>
    </div>
</div>
@endforeach