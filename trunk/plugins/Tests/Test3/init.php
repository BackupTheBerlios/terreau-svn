<?php
  /* test plugin number three */

  // WARNING: This name MUST be unique across all plugins !
  $PG_current_class="PluginTestThree";

  /* Main class */
  class PluginTestThree {
    /* Variables */

    /* Contructor */
    function PluginTestThree() {
      echo "This is the crappy constructor of ".get_class($this)."<br />\n";
    }

    function helloWorld() {
      echo "Hello, babe, from ".get_class($this)."!<br />\n";
    }
  } // class PluginTestThree
