function register(data){
    if(data == 'undefined')
        return alert ("Whoops! Algo deu errado.");
    
    var username = data.username.value;
    var password = data.password.value;
    var password_confirm = data.password_confirm.value;
    var email = data.email.value;
    var operation = data.operation.value;

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

    $.ajax({
        type : "POST",
        url  : "./controller/mapping.php",
        data : { username : username, password : password, password_confirm : password_confirm, email : email, operation : operation },
        success: function(response){
                var jsonResponse = JSON.parse(response).response;
                console.log(jsonResponse);
                alert(jsonResponse.message);

                if(jsonResponse.status == 200)
                    window.location.replace("./index.php");
                
                if(jsonResponse.status == 500)
                    return alert("Por favor, verifique seu nome de usuário e senha.");
        },
        error: function(response){
            var jsonResponse = JSON.parse(response).response;
            console.log(jsonResponse);
            
            alert(jsonRespons.message);
        }
    });
    
}