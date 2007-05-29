<?php
  /* test plugin number six */

  // WARNING: This name MUST be unique across all plugins !
  $PG_current_class="PluginTestNONEXISTENT";

  /* Main class */
  class PluginTestSix {
    /* Variables */

    /* Contructor */
    function PluginTestSix() {
      echo "This is the constructor of ".get_class($this)."<br />\n";
    }

    function helloWorld() {
      echo "Hello, world, from ".get_class($this)."!<br />\n";
    }
  } // class PluginTestSix
