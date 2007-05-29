<?php
  /* test plugin number two */

  // WARNING: This name MUST be unique across all plugins !
  $PG_current_class="PluginTestTwo";

  /* Main class */
  class PluginTestTwo {
    /* Variables */

    /* Contructor */
    function PluginTestTwo() {
      echo "This is the constructor of ".get_class($this)."<br />\n";
    }

    function helloWorld() {
      echo "Hello, asshole, from ".get_class($this)."!<br />\n";
    }
  } // class PluginTestTwo
