$(document).ready(function () {
    table_mapel();
    table_kelas();
    box();
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
    }
});

// untuk menampilkan box
function box() {
    
    $.get("/admin/box", {}, function (data, status) {
        $("#box").html(data);
    })
}

// menampilkan data table mapel
function table_mapel() {
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
