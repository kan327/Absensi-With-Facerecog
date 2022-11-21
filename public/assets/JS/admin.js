$(document).ready(function(){
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
function box(){
    $.get("/admin/box",{},function(data, status){
        $("#box").html(data);
    })
}

// menampilkan data table mapel
function table_mapel(){
    $.get("/admin/table_mapel",{},function(data, status){
        $("#table_mapel").html(data)
    })
}

// memberikan request ke controller 
function mapel_simpan(){
    $.ajax({
        url:"/admin/mapel",
        type:"POST",
        data:"pelajaran="+$("#pelajaran").val(),
        success:function(){
            box();
            table_mapel();
            keiAlert("Mapel berhasil di tambahkan", "done", "bg-[#22c55e]");
        }
    })
}

// menampilkan data table kelas
function table_kelas(){
    $.get("/admin/table_kelas",{},function(data, status){
        $("#table_kelas").html(data)
    })
}

// memberikan request ke controller
function kelas_simpan(){
    $.ajax({
        url:"/admin/kelas",
        type:"POST",
        data:{
            kelas: $("#kelas").val()
        },
        success : function(){
            box();
            table_kelas();
            keiAlert("Kelas berhasil di tambahkan", "done", "bg-[#22c55e]");
        }
    })
}