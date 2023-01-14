showTableJadwal()

function showTableJadwal(){
    $.ajax({
        type: "GET",
        url: `absensi/table_jadwal`,
        success: function (ress) {
            $("#table_jadwal").html(ress)
        }
    });
}

function search(){
    var tahun = document.getElementById("tahun")
    var bulan = document.getElementById("bulan")
    var tanggal = document.getElementById("tgl")

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
        }
    });

    if(tanggal.value == ""){       
        // jika tanpa tanggal
        $.ajax({
            type: "GET",
            url: `absensi/${tahun.value}/${bulan.value}`,
            success: function (ress) {
                $("#table_jadwal").html(ress)
            }
        });
    }else{
        // jika dengan tanggal
        $.ajax({
            type: "GET",
            url: `absensi/${tahun.value}/${bulan.value}/${tanggal.value}`,
            success: function (ress) {
                $("#table_jadwal").html(ress)
            }
        });
    }



}