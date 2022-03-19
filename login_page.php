<?php

//Header and CSS settings
require_once __DIR__.'/config/head.php';
require_once __DIR__.'/config/loaders.php';

Log::doLog('login page accessed!!', 'accessLogs', 1);

?>
<html lang="en">
  <body class="text-center"> 
    <main class="form-login">

      <form onsubmit="login(this);">
        <a href="./index.php"><img href="./index.php" class="mb-4" src="./assets/brand/logo.svg"></a>
        <input type="hidden" id="operation" value="login_user">

        <div class="form-floating">
          <input type="text" class="form-control" id="username" placeholder="Usuário">
          <label for="username">Usuário</label>
          
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" id="password" placeholder="Senha">
          <label for="password">Senha</label>
        </div>
        
        <input class="checkbox mb-3" type="checkbox" value="0" id="keep_logged_in"> Permanecer logado.

        <button class="w-100 btn btn-lg btn-primary" type="submit">Entrar</button>

      </form>

      <div class="form-floating">
        <a href="./register_page.php" class="icon-link">
            Novo por aqui? Registre-se
        </a>
        <a href="./recover_password.php" class="icon-link">
            Esqueceu a senha? Recuperar
        </a>

       <?php $FooterClass = !Utils::isMobile() ? 'class="mt-5 mb-3 text-muted fixed-bottom"' : 'class="mt-5 mb-3 text-muted"'; ?>
      <p <?php echo $FooterClass; ?>>&copy; <?php echo date("Y"); ?></p>
      </div >

    </main>
  </body>
</html>