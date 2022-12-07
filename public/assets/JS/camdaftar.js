console.log("bisa")
function cam(){
    // $.get("/absen_siswa/akses_cam_daftar",{}, async function (data, status) {
    //     console.log(status)
    //     console.log(data)
    
    // })
    $("#cam_daftar").html = "Mohon Tunggu"
    
    $.ajax({
        type: "get",
        url: "/absen_siswa/akses_cam_daftar",
        success: function (res) {
            document.getElementById("cam_daftar").src = ""+res+""
        }
    })
}