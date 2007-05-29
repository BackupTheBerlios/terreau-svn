<?php
/* Terreau, a set of various PHP libraries.
 Copyright (C) 2005-2006  Nayco.

 (Please read the COPYING file)

 This program is free software; you can redistribute it and/or
 modify it under the terms of the GNU General Public License
 as published by the Free Software Foundation; either version 2
 of the License, or (at your option) any later version.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program; if not, write to the Free Software
 Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA. */

  /**
  *  @file libPlugins.php
  *  @version 0-28.03.2006
  *
  *  Generic library to handle plugins.
  */

  // Includes
  include_once("libError.php");

  class PG_object {
    /* Protected vars */
    protected $objects_list;	//< This array stores references to the plugin objects.
    protected $dir;						//< This contains the path to the plugins to load.
    protected $eh;						//< This points to the error handler.

    /**
		*  Contructor
		*
		*  
		*  @param $dir The directory containing the plugins to load.
		*  @returns Nothing, but it should !!!
		*
    *  @todo Add return values !
		*/
    function __construct($dir) {
      // Setup the error handler
      $this->eh=ER_Handler::getInstance();

      // Load the plugins
      if(!isset($dir)){
	      $this->eh->logCrit("PG_object constructor", "Missing plugins directory name", "Instanciate this object with the good parameters !");
        return false;
      }
			if(!is_dir($dir)){
				$this->eh->logCrit("PG_object constructor", "Wrong plugins directory name", "Instanciate this object with the name of a directory that exists !");
        return false;
			}
      $this->dir=$dir;
      $handle=opendir($this->dir);
      if ($handle==false) {
        $this->eh->logCrit("PG_object constructor", "Unable to open the plugins directory", "Check that you have the read permissions on '$this->dir'");
				return false;
      }
      while(($candidate=readdir($handle))!=false){
        $candidate_dir=$dir."/".$candidate;
        if (!ereg('^\.', $candidate) && is_dir($candidate_dir)){
          $init_file=$candidate_dir."/init.php";
          if(file_exists($init_file)){
            // Include the plugin file. This one sets the '$PG_current_class'
	    			// to the name of the class to use to instanciate the plugin
				    // object.
            include($init_file);
            // Get the class name from '$PG_current_class', then
						// instanciate it. Store the object in the right namespace of
						// the '$object_list' array.
						// If the '$PG_current_class' variable is empty or unset,
				    // display an error, ignore the current plugin and jump to
				    // the next.
				    $plugin_name=$candidate;
				    if (empty($PG_current_class)){
				      $this->eh->logCrit("PG_object constructor", "\$PG_current_class not set in the '$candidate' plugin, it will be ignored.", "Blame this plugin's author !");
	    			  break;
				    }
				    // If the requested class does not exists, ignore the current
	    			// plugin, display an error and jump to the next
				    if (!class_exists($PG_current_class)){
	    			  $this->eh->logCrit("PG_object constructor", "The '$PG_current_class' class does not exists in the '$candidate' plugin, it will be ignored.", "Blame this plugin's author !");
	      		break;
				    }
            $this->objects_list[$plugin_name]=new $PG_current_class($plugin_name);
				    /* Never too cautious : */
				    unset ($PG_current_class);
          }
          else{
            $this->eh->logCrit("PG_object constructor", "'$init_file' not found, '$candidate' plugin ignored.", "Blame this plugin's author !");
				  }
        }
        else{
          $this->eh->logDebug("PG_object constructor", "Ignore '$candidate_dir'.", "This is not a plugin directory, no error here.");
        }
      }
    } // End of constructor
 
    function runAllPluginsFunc($function, $args=array()) {
      // Run the specified function of all plugins of this object.
      if (empty($function)){
				$this->eh->logCrit("runAllPluginFunc()", "Missing function to call", "Specify a function to call for all plugins");
        return false;
      }

      $return = '';

      if (is_array($this->objects_list)){
        foreach (array_keys($this->objects_list) as $plugin_name){
          $return.=$this->runPluginFunc($plugin_name, $function, $args);
        }
      }
      return $return;
    }

    function runPluginFunc($plugin, $function, $args=array()) {
      // Run the specified function of a given plugin.
      if (empty($plugin)||empty($function)){
				$this->eh->logCrit("runPluginFunc()", "Missing plugin or function", "Specify the plugin AND the function to call in it");
        return false;
      }
      $return = '';
      //$plugin_to_call=$this->objects_list["$plugin"];

      if (isset($this->objects_list["$plugin"]) && is_object($this->objects_list["$plugin"])){
        $plugin_to_call=$this->objects_list["$plugin"];
        if (method_exists ($plugin_to_call, $function)){
          $return = call_user_func_array(array($plugin_to_call,$function), $args);
        }
        else {
				  $this->eh->logCrit("runPluginFunc()", "Function '$function' not found in '$plugin'", "Specify a function that exists in the '$plugin' plugin");
	  			return false;
				}
      }
      else {
        $this->eh->logCrit("runPluginFunc()", "Plugin '$plugin' not found", "Specify a plugin that exists !");
				return false;
      }
    	return $return;
    }

    function listPlugins() {
      if (is_array($this->objects_list)){
        foreach (array_keys($this->objects_list) as $plugin_name){
          $return[]=$plugin_name;
        }
      return $return;
      }
    }
  } // class PG_object
