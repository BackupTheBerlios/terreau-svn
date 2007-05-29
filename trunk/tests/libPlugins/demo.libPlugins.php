<?php
  /* Testing libPlugins.php */

  include_once("../../libPlugins.php");
  include_once("../../libError.php");

  $eh=ER_Handler::getInstance();
?>
<html>
  <head>
    <style>
      @import "../../style.css" screen;
    </style>
  </head>
  <body>  
<?php  
  $testsPlugins=new PG_object("plugins/Tests");
  echo "<hr />\n";
  echo implode(",",$testsPlugins->listPlugins());
  echo "<hr />\n";
  echo $testsPlugins->runAllPluginsFunc("helloWorld");
  echo "<hr />\n";
  echo $testsPlugins->runAllPluginsFunc("nonExistentFunc");
  echo "<hr />\n";
  echo $testsPlugins->runPluginFunc("nonExistantPlugin", "helloWorld");
  echo $testsPlugins->runPluginFunc("nonExistantPlugin", "nonExistentFunc");
  echo $testsPlugins->runPluginFunc("Test1", "nonExistentFunc");

  $eh->displayEvents();
?>
  </body>
</html>
