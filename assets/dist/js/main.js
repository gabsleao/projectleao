function recoverPass(data){
    if(data == 'undefined')
        return alert ("Whoops! Algo deu errado.");
    
    var email = data.email.value;

    if(email == 'undefined' || !email)
        return alert("Por favor, insira um e-mail!");
        
    alert("Email enviado com sucesso!");
    window.location.href = "./login_page.php";

}