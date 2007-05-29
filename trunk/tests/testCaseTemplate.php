<?php
if (!defined("ALLTESTS")) {
	require_once('../simpletest/unit_tester.php');
	require_once('../simpletest/reporter.php');
	require_once('../simpletest/show_passes.php');
	require_once('../../lib__TOTO__.php');
}
else{
	require_once('../lib__TOTO__.php');
}


class Test__TOTO__ extends UnitTestCase {

	
  function __construct() {
    $this->UnitTestCase("Testing lib__TOTO__.php");
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

	//...
	*/
}

if (!defined("ALLTESTS")) {
	$test = &new Test__TOTO__();
	$test->run(new showPasses());
	#$test->run(new htmlReporter());
}
?>
