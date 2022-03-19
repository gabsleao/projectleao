function recoverPass(data){
    if(data == 'undefined')
        return alert ("Whoops! Algo deu errado.");
    
    var email = data.email.value;

    if(email == 'undefined' || !email)
        return alert("Por favor, insira um e-mail!");
        
    alert("Email enviado com sucesso!");
    window.location.href = "./login_page.php";

}

function logout(){

    $.ajax({
        type : "POST",
        url  : "./controller/Controller.php",
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