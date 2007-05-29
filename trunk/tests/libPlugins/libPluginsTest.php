<?php
if (!defined("ALLTESTS")) {
	require_once('../simpletest/unit_tester.php');
	require_once('../simpletest/reporter.php');
	require_once('../simpletest/show_passes.php');
	require_once('../../libPlugins.php');
}
else{
	require_once('../libPlugins.php');
}


class TestLibPlugins extends UnitTestCase {

	
  function __construct() {
    $this->UnitTestCase("Testing libPlugins.php");
	}

	function setUp() {
  }

	function tearDown() {
	}

  /*
	// Testing the __TITI__() method
  function test__TITI__() {
	  $this->assertTrue();
	  $this->assertFalse();
    $this->assertError();
		$this->assertWantedPattern("/$rowPattern/", );
	}
	*/

	/*
  Public Member Functions
	__construct ($dir)
 	runAllPluginsFunc ($function, $args=array())
	runPluginFunc ($plugin, $function, $args=array())
	listPlugins ()

	Protected Attributes
 	$objects_list
 	$dir
 	$eh
	*/
}

if (!defined("ALLTESTS")) {
	$test = &new TestLibPlugins();
	$test->run(new showPasses());
	#$test->run(new htmlReporter());
}
?>
