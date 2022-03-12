<?php

//Header and CSS settings
require_once __DIR__.'/config/head.php';

?>
<html lang="en">
  <body class="text-center"> 
    <main class="form-login">

    <form onsubmit="recoverPass(this);">
        <img class="mb-4" src="./assets/brand/logo.svg" >
        
        Digite seu endereço de e-mail, enviaremos instruções para resetar a senha!
        <div class="form-floating">
          <input type="text" class="form-control" id="email" placeholder="E-mail">
          <label for="email">E-mail</label>

        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Enviar</button>

    </form>

    <a href="./login_page.php" class="icon-link">
        Voltar
    </a>

      <p class="mt-5 mb-3 text-muted fixed-bottom">&copy; <?php echo date("Y"); ?></p>
    </main>
  </body>
</html>