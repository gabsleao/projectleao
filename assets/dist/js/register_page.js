function register(data){
    if(data == 'undefined')
        return alert ("Whoops! Algo deu errado.");
    
    var username = data.username.value;
    var password = data.password.value;
    var password_confirm = data.password_confirm.value;
    var email = data.email.value;

    if(username == 'undefined' || !username)
        return alert("Por favor, insira um nome de usuário!");

    if(password == 'undefined' || !password)
        return alert("Por favor, insira uma senha!");

    if(password_confirm == 'undefined' || !password_confirm)
        return alert("Por favor, confirme a senha!");
    
    if(email == 'undefined' || !email)
        return alert("Por favor, insira um e-mail!");

    if(password !== password_confirm)
        return alert("Suas senhas não são iguais, tente novamente!");

    return alert("Usuário registrado com sucesso!");
    
}