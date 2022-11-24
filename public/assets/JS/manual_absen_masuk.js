// var belum_hadir = document.getElementById("belum_hadir")

// if(belum_hadir.textContent === "0 Orang"){
//     belum_hadir.textContent = "-"
// }

// function centang(any) {
//     if (any.checked) {
//         var checkbox = document.getElementsByName('checkbox')
//         for (r = 0; r < checkbox.length; r++) {
//             checkbox[r].setAttribute('checked', true)
//         }
//     } else {
//         var checkbox = document.getElementsByName('checkbox')
//         for (i = 0; i < checkbox.length; i++) {
//             checkbox[i].removeAttribute('checked')
//         }
//     }
// }

// function tes(any) {
//     document.getElementById(any).classList.toggle("active")
// }

// function save() {

//     // menangkap id siswa
//     var id_siswa = document.getElementsByName("id_siswa")

//     var id_siswas = []

//     // menangkap id siswa ke dalam array
//     for (i = 0; i < id_siswa.length; i++) {
//         id_siswas.push(id_siswa[i].value)
//         // console.log(id_siswas)
//     }


//     // menangkap jam masuk
//     var mulai = document.getElementsByName("jam_masuk")

//     var mulais = []

//     // menangkap jam mulai ke dalam array
//     for (j = 0; j < mulai.length; j++) {
//         mulais.push(mulai[j].textContent)
//         // console.log(mulais)
//     }


//     // meng set centang keterangan
//     var ket = document.getElementsByName("ket")

//     var centang_ket = "notSelected"

//     for (cent = 0; cent < ket.length; cent++) {

//         if (ket[cent].checked) {
//             centang_ket = ket[cent].value

//             // console.log(centang_ket)
//         }

//     }


//     // keterangan option dan checkbox
//     var keterangan = document.getElementsByName("keterangan") //keterangan 

//     var check = document.getElementsByName("checkbox") // checkbox

//     // console.log(check[0].value)

//     var checks = []

//     for (j = 0; j < check.length; j++) {

//         if (centang_ket == "notSelected") {

//             checks.push(keterangan[j].value)

//             if (checks[j] === "Hadir") {
//                 keterangan[j][1].setAttribute('selected', true)
//             }

//             if (checks[j] === "Alpha") {
//                 keterangan[j][2].setAttribute('selected', true)
//             }

//             if (checks[j] === "Terlambat") {
//                 keterangan[j][3].setAttribute('selected', true)
//             }

//             if (checks[j] === "Sakit") {
//                 keterangan[j][4].setAttribute('selected', true)
//             }

//             if (checks[j] === "Izin") {
//                 keterangan[j][5].setAttribute('selected', true)
//             }

//         } else if (check[j].checked) {

//             check[j].setAttribute("checked", true)
//             checks.push(centang_ket)

//             // console.log(checks)
//             if (checks[j] === "Alpha") {
//                 keterangan[j][2].setAttribute('selected', true)
//             }

//             if (checks[j] === "Hadir") {
//                 keterangan[j][1].setAttribute('selected', true)
//             }

//             if (checks[j] === "Terlambat") {
//                 keterangan[j][3].setAttribute('selected', true)
//             }

//             if (checks[j] === "Sakit") {
//                 keterangan[j][4].setAttribute('selected', true)
//             }

//             if (checks[j] === "Izin") {
//                 keterangan[j][5].setAttribute('selected', true)
//             }

//         } else {
//             checks.push(keterangan[j].value)
//         }
//         // console.log(checks)

//     }


//     // keseluruhan
//     var all = []

//     for (i = 0; i < id_siswa.length; i++) {

//         all.push({
//             id_siswa: id_siswas[i],
//             mulai: mulais[i],
//             check: checks[i]
//         })

//     }

//     // console.log(all)
//     kirim_request(all)


//     function kirim_request(allData) {
//         $.ajaxSetup({
//             headers: {
//                 'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
//             }
//         });

//         $.ajax({
//             url: "/absen_siswa/",
//             type: "POST",
//             data: {
//                 datas: allData
//             },
//             success: function(ress) {

//                 if(ress){
//                 }

//             }
//         });
//     }

// }