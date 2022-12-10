function configure(){
    Webcam.set({
        width: 520,
        height: 380,
        image_format: 'jpeg',
        jpeg_quality: 90,
        // force_flash: true,
    })

    Webcam.attach("#mycam")
}

function saveSnap() {
    Webcam.snap(function (data_uri) {
        document.getElementById("results").innerHTML = '<img id ="webcam" src = " '+ data_uri +' ">'
    })
    
    Webcam.reset()

    // var csrf = document.getElementsByName("csrf-token")
    
    var base64image = document.getElementById("webcam").src
    Webcam.upload(base64image, '/data_siswa/simpan', function (code, text){
        // Noticme.any({
        // text: "Wajah Berhasil Disimpan",
        // type: "success",
        // timer: 3000,
        // })
        console.log(text)
        alert(code)
    })
}