<?php
	define("ALLTESTS", "We are running all tests!");
		
  require_once('./simpletest/unit_tester.php');
  require_once('./simpletest/reporter.php');
		
  $test = &new GroupTest('Testing all libraries');
  //require_once('libTables/libTableTest.php');
  //require_once('libError/libErrorTest.php');
  //$test->addTestCase(new TestLibTable);
  //$test->addTestCase(new testLibError);
	
  $test->addTestFile("libTable/libTableTest.php");
	$test->addTestFile("libError/libErrorTest.php");

	// On affiche que les erreurs
  $test->run(new HtmlReporter());

	//...Ou tous les messages :	
  //require_once('simpletest/show_passes.php');
  //$test->run(new showPasses());
?>
