function validate(message){
    Noticme.any({
        text: message,
        type: "danger",
        timer:5000,
        button: true
    })
}
function openfc(any='child', display='block'){
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




// absensi

