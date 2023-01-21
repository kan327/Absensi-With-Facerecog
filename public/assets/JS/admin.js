$(document).ready(function () {
    table_mapel();
    table_kelas();
    box();
});

// setup csrf token
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
    }
});

// untuk menampilkan box
function box() {
    $("#box").html("Mohon Tunggu Sebentar...")
    
    $.get("/admin/box", {}, function (data, status) {
        $("#box").html(data);
    })
}

// menampilkan data table mapel
function table_mapel() {
    $("#table_mapel").html("Mohon Tunggu Sebentar...")
    
    $.get("/admin/table_mapel", {}, function (data, status) {
        $("#table_mapel").html(data)
    })
}

// memberikan request ke controller 
function mapel_simpan() {
    $.ajax({
        url: "/admin/mapel",
        type: "POST",
        data: "pelajaran=" + $("#pelajaran").val(),
        success: function () {
            box();
            table_mapel();
            keiAlert("Mapel berhasil di tambahkan", "done", "bg-[#22c55e]");
        }
    })
}

// menampilkan data table kelas
function table_kelas() {
    $.get("/admin/table_kelas", {}, function (data, status) {
        $("#table_kelas").html(data)
    })
}

// memberikan request ke controller
function kelas_simpan() {
    $.ajax({
        url: "/admin/kelas",
        type: "POST",
        data: {
            kelas: $("#kelas").val()
        },
        success: function () {
            box();
            table_kelas();
            keiAlert("Kelas berhasil di tambahkan", "done", "bg-[#22c55e]");
        }
    })
}


// live search data guru
var search_guru = document.getElementById("search_guru")

live_search_guru('')

search_guru.addEventListener("keyup", function () {
    live_search_guru(search_guru.value)
})

function live_search_guru(keyword = '') {

    
    $("#data_guru").html("Mohon Tunggu Sebentar...")

    $.ajax({
        type: "GET",
        url: "/admin/search",
        data: "search_guru=" + keyword,
        success: function (ress) {
            $("#data_guru").html(ress)
        }
    })

}

// live search data siswa
var search_siswa = document.getElementById("search_siswa")

live_search_siswa('')

search_siswa.addEventListener("keyup", function () { 
    live_search_siswa(search_siswa.value)
})

function live_search_siswa(keyword = ''){

    $("#data_siswa").html("Mohon Tunggu Sebentar...")

    $.ajax({
        type: "GET",
        url: "/admin/siswa/search",
        data: "search_siswa="+keyword,
        success: function (ress) {
            $("#data_siswa").html(ress)
        }
    });
}


// search jadwal absen

var search_jadwal = document.getElementById("search_jadwal")

live_search_jadwal('')

search_jadwal.addEventListener("keyup", function () { 
    live_search_jadwal(search_jadwal.value)
})

function live_search_jadwal(keyword = ''){

    $("#data_jadwal").html("Mohon Tunggu Sebentar...")

    $.ajax({
        type: "GET",
        url: "/admin/jadwal/search",
        data: "search_jadwal="+keyword,
        success: function (ress) {
            $("#table_jadwal").html(ress)
        }
    });
}
function openfc(any, display='block'){
    var close_state = document.getElementsByClassName(any)
    for (let i = 0; i < close_state.length; i++) {
        const element = close_state[i];
        if(element.classList.contains('hidden')){
            element.classList.remove('hidden')
            element.classList.add(display)
        }else{
            element.classList.remove(display)
            element.classList.add('hidden')
        }
    }
}
function opensrcadmin(where, __self, size){
    let inp = document.getElementById(where)
    if(inp.classList.contains('opacity-0')){
        __self.classList.add('text-black')
        inp.classList.add('opacity-100')
        inp.classList.add('w-['+size+'%]')
        inp.classList.remove('select-none')
        inp.classList.remove('cursor-default')
        inp.classList.remove('w-[10%]')
        inp.classList.remove('opacity-0')
    }else{
        __self.classList.remove ('text-black')
        inp.classList.remove('opacity-100')
        inp.classList.remove('w-['+size+'%]')
        inp.classList.add('w-[10%]')
        inp.classList.add('cursor-default')
        inp.classList.add('select-none')
        inp.classList.add('opacity-0')
    }
}