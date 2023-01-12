function validate(message){
    Noticme.any({
        text: message,
        type: "danger",
        timer:5000,
        button: true
    })
}