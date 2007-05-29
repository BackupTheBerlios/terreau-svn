<?php
if (!defined("ALLTESTS")) {
	require_once('../simpletest/unit_tester.php');
	require_once('../simpletest/reporter.php');
	require_once('../simpletest/show_passes.php');
	require_once('../../libError.php');
}
else {
	require_once('../libError.php');
}

class testLibError extends UnitTestCase {

	// Store an error handler
	protected $eh;
	
  function __construct() {
    $this->UnitTestCase("Testing libError.php");
	}

	function setUp() {

		///// Ben non, puisque singleton !
		$this->eh=ER_Handler::getInstance();
  }

	function tearDown() {
		$this->eh=null;
	}

  // Testing the __TITI__() method
	/*
  function test__TITI__() {
	  $this->assertTrue();
	  $this->assertFalse();
    $this->assertError();
		$this->assertWantedPattern("/$rowPattern/", );
	}
	*/

	/**
  * Testing public methods
  * 
  */
 	
  // Testing getInstance ()
  function testGetInstance() {
    $this->assertIdentical($this->eh, ER_Handler::getInstance());
		$this->assertIsA(ER_Handler::getInstance(), "ER_Handler");
	}

 	// logCrit ($source, $message, $hint="")
	function testLogCrit() {
		$this->assertTrue($this->eh->logCrit("source", "message"));
		$this->assertTrue($this->eh->logCrit("source", "message", "hint"));
		$this->assertError($this->eh->logCrit());
		$this->assertError($this->eh->logCrit("source"));
		$this->assertError($this->eh->logCrit(array("source", "message", "hint")));
	}

 	// logError ($source, $message, $hint="")
	function testLogError() {
		$this->assertTrue($this->eh->logError("source", "message"));
		$this->assertTrue($this->eh->logError("source", "message", "hint"));
		$this->assertError($this->eh->logError());
		$this->assertError($this->eh->logError("source"));
		$this->assertError($this->eh->logError(array("source", "message", "hint")));
	}

 	// logInfo ($source, $message, $hint="")
	function testLogInfo() {
		$this->assertTrue($this->eh->logInfo("source", "message"));
		$this->assertTrue($this->eh->logInfo("source", "message", "hint"));
		$this->assertError($this->eh->logInfo());
		$this->assertError($this->eh->logInfo("source"));
		$this->assertError($this->eh->logInfo(array("source", "message", "hint")));
	}

 	// logDebug ($source, $message, $hint="")
	function testLogDebug() {
		$this->assertTrue($this->eh->logDebug("source", "message"));
		$this->assertTrue($this->eh->logDebug("source", "message", "hint"));
		$this->assertError($this->eh->logDebug());
		$this->assertError($this->eh->logDebug("source"));
		$this->assertError($this->eh->logDebug(array("source", "message", "hint")));
	}

 	// clearEvents ()
	function testClearEvents(){
		// Fill the message array with something...
		$this->eh->logDebug("source", "message");
		// And clear it, this should throw no error.
		$this->assertNoErrors($this->eh->clearEvents());
	}

 	// displayEvents ()
	function testDisplayEvents(){
		// Try to read the ouput when the message table is empty	
		$this->assertFalse($this->eh->displayEvents());
		// Fill the message array with something...
    $this->eh->logDebug("source1", "message1");
    $this->eh->logCrit("source2", "message2", "hint2");
		// Try to read the output again :
		$this->assertNoErrors($this->eh->displayEvents());
	}
	

  /**
  *  Cannot test protected methods...
  */
  // log ($severity, $source, $message, $hint="")
 	// displayEventBlock ($crit, $critTitle)
 	// __construct ()

  /**
	* Testing protected attributes is not possible too
	*/
 	// $errorsToDisplay

  /** 
  * Too cannot testing static protected attributes.
  */
  // static $instance
}

if (!defined("ALLTESTS")) {
	$test = &new testLibError();
	$test->run(new showPasses());
	#$test->run(new htmlReporter());
}
?>
