<?php
  /* test plugin number five */

  // WARNING: This name MUST be unique across all plugins !
  $PG_current_class="";

  /* Main class */
  class PluginTestFive {
    /* Variables */

    /* Contructor */
    function PluginTestFive() {
      echo "This is the crappy constructor of ".get_class($this)."<br />\n";
    }

    function helloWorld() {
      echo "Hello, babe, from ".get_class($this)."!<br />\n";
    }
  } // class PluginTestFive
