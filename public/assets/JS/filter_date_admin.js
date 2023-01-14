table_jadwal()

function table_jadwal(){
    $.ajax({
        type: "GET",
        url: `admin/table_jadwal`,
        success: function (ress) {
            $("#table_jadwal").html(ress)
        }
    });
}

function search(){
    var tahun = document.getElementById("tahun")
    var bulan = document.getElementById("bulan")
    var tanggal = document.getElementById("tgl")

    if(tanggal.value == ""){       
        // jika tanpa tanggal
        $.ajax({
            type: "GET",
            url: `admin/table_jadwal/${tahun.value}/${bulan.value}`,
            success: function (ress) {
                $("#table_jadwal").html(ress)
            }
        });
    }else{
        // jika dengan tanggal
        $.ajax({
            type: "GET",
            url: `admin/table_jadwal/${tahun.value}/${bulan.value}/${tanggal.value}`,
            success: function (ress) {
                $("#table_jadwal").html(ress)
            }
        });
    }
}