function login(data){
    if(data == 'undefined')
        return alert ("Whoops! Algo deu errado.");
    
    var username = data.username.value;
    var password = data.password.value;
    console.log(username);
    console.log(password);

    if(username == 'undefined' || !username)
        return alert("Por favor, insira um nome de usuário!");
        
    if(password == 'undefined' || !password)
        return alert("Por favor, insira uma senha!");

   
    if(username === "admin" && password === "admin")
        return alert("Login autenticado com sucesso!");
    else
        return alert("Por favor, verifique seu nome de usuário e senha.");

}