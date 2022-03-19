function recoverPass(data){
    if(data == 'undefined')
        return alert ("Whoops! Algo deu errado.");

    var email = data.email.value;
    var operation = data.operation.value;

    if(email == 'undefined' || !email)
        return alert("Por favor, insira um e-mail válido!");

    $.ajax({
        type : "POST",
        url  : "./controller/mapping.php",
        data : { email : email, operation : operation },
        success: function(response){
                var jsonResponse = JSON.parse(response).response;
                console.log(jsonResponse);

                if(jsonResponse.status == 200)
                    window.location.replace("./index.php");
                if(jsonResponse.status == 500)
                    return alert("Por favor, verifique seu e-mail inserido.");
        },
        error: function(){
            alert("Whoops! Algo deu errado.");
        }
    });

}

function logout(){

    $.ajax({
        type : "POST",
        url  : "./controller/mapping.php",
        data : { operation : 'logout' },
        success: function(response){
                console.log(response);
                var jsonResponse = JSON.parse(response).response;
                console.log(jsonResponse);

                if(jsonResponse.status == 200)
                    alert(jsonResponse.message);

                window.location.replace("./index.php");
        },
        error: function(){
            window.location.replace("./index.php");
        }
    });

}