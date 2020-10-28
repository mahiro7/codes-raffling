function codeGen(len){
    let code = ''

    do{
        code += Math.random().toString(36).substring(2);
    }while(code.length =! len)

    return code.toUpperCase()
}

document.cookie=`codeGen=${codeGen()}`
