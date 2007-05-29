<html>
  <head>
    <title>Test de libError.php</title>
    <style>
      @import "../../style.css" screen;
    </style>
  </head>
  <body>
    <h1>Test de libError.php</h1>
<?php
  /* Script to test libError.php */
  include("../../libError.php");

  // Direct instanciation of the ER_Handler class : must fail !
  //$eh=new ER_Handler();
  
  // Instead, use the static getInstance() method to get an handler
  // to the current instance of the class
  $eh=ER_Handler::getInstance();
  
  $eh->logCrit("Test critique", "Une vraie fausse erreur critique est arrivée", "Barrez-vous, tout va péter !");
  $eh->logError("Test erreur", "Une vraie fausse erreur s'est produite", "Pleure un peu, ça fait du bien.");
  $eh->logInfo("Test info", "Ceci est une information peu importante", "Laisse quimper, on va écluser un gorgeon !");
  $eh->logDebug("Test debug", "Debug: Ton code est pourri", "Les utilisateurs ne verront rien, laisse dire.");
  
  // Ces tests doivent générer une erreur
  //$eh->log("critical", "Test appel direct fonction privée", "Cette erreur ne devrait jamais s'afficher", "Et ça a l'air raté..."); //gagné ;-) !
  //$eh->displayEventBlock("info", "les infos du matin"); //gagné ;-) !
  $eh->logError("Test mauvais nombre de paramètres", "");

  // Use of another pointer to the current instance of the class
  $aeh=ER_Handler::getInstance();
  $aeh->logInfo("getInstance() test", "On peut utiliser plusieurs pointeurs sur l'instance courante du gestionnaire d'erreurs", "Ca cartonne, merci Pierre-O");

  $eh->displayEvents();
?>
  </body>
</html>
