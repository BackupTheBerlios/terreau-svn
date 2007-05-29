<?php
  include_once("../../libAuth.php");
  include_once("../../libError.php");
  $auth=new AU_auth("plugins/Auth/Enabled");
?>
<html>
  <head>
    <title>Test de libAuth.php</title>
    <style>
      @import "../../style.css" screen;
    </style>
  </head>
  <body>
    <h1>Test de libAuth.php</h1>
    <?php
      echo $auth->showBox();
      $eh=ER_Handler::getInstance();
      $eh->displayEvents();
    ?>
  </body>
</html>
