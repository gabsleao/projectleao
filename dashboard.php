<?php

//Header and CSS settings
require_once __DIR__.'/config/head.php';
require_once __DIR__.'/config/loaders.php';

?>
<html lang="en">
  <body class="text-center"> 
    <main class="form-login">

      <div class="form-floating">
        <button class="w-100 btn btn-lg btn-primary" onclick="logout()">Logout</button>
      </div >

      <p class="mt-5 mb-3 text-muted fixed-bottom">&copy; <?php echo date("Y"); ?></p>
    </main>
  </body>
</html>