function login(data){
    if(data == 'undefined')
        return alert ("Whoops! Algo deu errado.");
    
    var username = data.username.value;
    var password = data.password.value;
    var keep_logged_in = 0;
    var operation = data.operation.value;

    if(data.keep_logged_in != 'undefined'){
        if(data.keep_logged_in.checked)
            keep_logged_in = 1;
    }

    if(username == 'undefined' || !username)
        return alert("Por favor, insira um nome de usuário!");
        
    if(password == 'undefined' || !password)
        return alert("Por favor, insira uma senha!");

    $.ajax({
        type : "POST",
        url  : "./controller/Controller.php",
        data : { username : username, password : password, keep_logged_in : keep_logged_in, operation : operation },
        success: function(response){
                console.log('Success!!:');
                var jsonResponse = JSON.parse(response).response;
                console.log(jsonResponse);

                if(jsonResponse.status == 200)
                    window.location.replace("./dashboard.php");
                if(jsonResponse.status == 500)
                    return alert("Por favor, verifique seu nome de usuário e senha.");
        },
        error: function(){
            alert("Whoops! Algo deu errado.");
        }
    });

}