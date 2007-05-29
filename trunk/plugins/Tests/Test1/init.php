<?php
  /* test plugin number one */

  // WARNING: This name MUST be unique across all plugins !
  $PG_current_class="PluginTestOne";

  /* Main class */
  class PluginTestOne {
    /* Variables */

    /* Contructor */
    function PluginTestOne() {
      echo "This is the constructor of ".get_class($this)."<br />\n";
    }

    function helloWorld() {
      echo "Hello, world, from ".get_class($this)."!<br />\n";
    }
  } // class PluginTestOne
