<?php

//Header and CSS settings
require_once __DIR__.'/config/head.php';

?>

<body class="text-center">
  <main class="form-login">

    <form onsubmit="register(this)">
    <a href="./index.php"><img href="./index.php" class="mb-4" src="./assets/brand/logo.svg"></a>
      <h1 class="h3 mb-3 fw-normal">Registre-se</h1>

      <div class="form-floating">
        <input type="text" class="form-control" id="username" placeholder="Usuário">
        <label for="username">Usuário</label>
      </div>

      <div class="form-floating">
        <input type="password" class="form-control" id="password" placeholder="Senha">
        <label for="password">Senha</label>
      </div>
      
      <div class="form-floating">
        <input type="password" class="form-control" id="password_confirm" placeholder="Confirmar senha">
        <label for="password_confirm">Confirmar senha</label>
      </div>

      <div class="form-floating">
        <input type="text" class="form-control" id="email" placeholder="E-mail">
        <label for="email">E-mail</label>
      </div>

      <button class="w-100 btn btn-lg btn-primary" type="submit">Registrar</button>

    </form>

    <a href="./index.php" class="icon-link">
        Já possui uma conta? Faça login
    </a>

    <p class="mt-5 mb-3 text-muted fixed-bottom">&copy; <?php echo date("Y"); ?></p>

  </main>
</body>