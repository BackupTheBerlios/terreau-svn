<?php
if (!defined("ALLTESTS")) {
	require_once('../simpletest/unit_tester.php');
	require_once('../simpletest/reporter.php');
	require_once('../simpletest/show_passes.php');
	require_once('../../libTables.php');
}
else {
	require_once('../libTables.php');
}



class TestLibTable extends UnitTestCase {

  protected $table;
	
  function __construct() {
    $this->UnitTestCase("libTable : Testing functions' input validation");
	}

	function setUp() {
	  $this->table = new TBL_table();
  }

	function tearDown() {
		$this->table=null;
	}

  // Testing the setColumns() method
  function testSetColumns() {
	  $this->assertTrue($this->table->setColumns(array("colonne 1", "column two")));
	  $this->assertFalse($this->table->setColumns("coucou"));
	  $this->assertFalse($this->table->setColumns(""));
    $this->assertError($this->table->setColumns());
  }

  // Testing the setCaption() method
  function testSetCaption() {
    $this->assertTrue($this->table->setCaption("A nice table"));
	  $this->assertFalse($this->table->setCaption(1));
    $this->assertFalse($this->table->setCaption(""));
    $this->assertError($this->table->setCaption());
  }

  // Testing the addRow() method
  function testAddRow() {
		$this->assertTrue($this->table->addRow(array("field 1", "champ deux")));
    $this->assertFalse($this->table->addRow("coucou"));
    $this->assertFalse($this->table->addRow(""));
    $this->assertError($this->table->addRow());
  }
	
	// Testing the displayRow() method
  function testDisplayRow() {
		// Fill the table with a single row
		$this->table->addRow(array("field 1", "champ deux"));
		
		// These should succeed and return the result in a string like
		// <tr><td>field1</td><td>filed2</td></tr>
		$rowPattern="^\s*<tr>\s*(<td>.+<\/td>\s*){2}<\/tr>\s*$";
		$this->assertWantedPattern("/$rowPattern/", $this->table->displayRow(0));
		$this->assertWantedPattern("/$rowPattern/", $this->table->displayRow(0,0));

		// Direct echoing should succeed too 
		echo "<p>direct echoing<br />\n";
		echo "<table border=1>\n";
		$this->assertTrue($this->table->displayRow(0,1));
		echo "</table></p>\n";

		// Passing wrong arguments should fail
    $this->assertFalse($this->table->displayRow("coucou"));
    $this->assertFalse($this->table->displayRow(array("0","0")));
		$this->assertFalse($this->table->displayRow(1));
    $this->assertError($this->table->displayRow());

		// Using strings instead of integers works, but should I
		// prevent this ? Those with good arguments :
    $this->assertTrue($this->table->displayRow("0"));
    $this->assertTrue($this->table->displayRow("0", "0"));
		echo "<p>direct echoing<br />\n";
		echo "<table border=1>\n";
		$this->assertTrue($this->table->displayRow("0", "1"));
		echo "</table></p>\n";

		// Still strings, but bad arguments
    $this->assertFalse($this->table->displayRow("1"));
    $this->assertFalse($this->table->displayRow("1", "0"));		
  }

	// Testing the displayHeaders() method
	function testDisplayHeaders() {
		//Setup the table with 2 columns
		$this->table->setColumns(array("col 1", "col 2"));

    // These should succeed and return the result in a string like
    // <tr><th>col 1</th><th>col 2</th></tr>
		$headerPattern="/^\s+<tr>\s*(<th>.+<\/th>\s*){2}<\/tr>\s+$/";
    $this->assertWantedPattern($headerPattern, $this->table->displayHeaders());
    $this->assertWantedPattern($headerPattern, $this->table->displayHeaders(0));

		// Direct echoing should work too
		echo "<p>direct echoing<br />\n";
    echo "<table border=1>\n";
    $this->assertTrue($this->table->displayHeaders(1));
		echo "</table></p>\n";

		// Wrong params : These should fail
    $this->assertFalse($this->table->displayHeaders(array(0,1,3)));
    $this->assertFalse($this->table->displayHeaders("booooooo !"));
	}

	// Testing the displayTable() method
	//($headerRepeat=0, $print=0)
	function testDisplayTable() {
		// Setup a table
		$this->table->setColumns(array("col 1", "col 2"));
		$this->table->addRow(array("row 1 field 1", "row 1 field 2"));
		$this->table->addRow(array("row 2 field 1", "row 2 field 2"));
		
		// These should succeed and return the result in a string like :
		// <table>
    // <tr><th>col 1</th><th>col 2</th></tr>
		// <tr><td>field1</td><td>filed2</td></tr>
		// <tr><td>field1</td><td>filed2</td></tr>
		// </table>
		$headerPattern="<tr>\s*(<th>.+<\/th>\s*){2}<\/tr>\s*";
		$rowPattern="<tr>\s*(<td>.+<\/td>\s*){2}<\/tr>\s*";
		$captionPattern="<caption>.*<\/caption>\s*";
		$beginPattern="<!-- Begin table -->\s*<table[^>]+>\s*";
		$endPattern="<\/table>\s*<!-- End table -->\s*";
		$pattern="/^$beginPattern$captionPattern$headerPattern$rowPattern$rowPattern$endPattern$/";
		$this->assertWantedPattern($pattern, $this->table->displayTable(0));
		$this->assertTrue($this->table->displayTable(0, true));

		// Wrong arguments, should fail !
		$this->assertFalse($this->table->displayTable("string", "string"));
		$this->assertFalse($this->table->displayTable(array("string", "string")));
	}

	
}

if (!defined("ALLTESTS")) {
	$test = &new TestLibTable();
	$test->run(new showPasses());
	#$test->run(new htmlReporter());
}
?>
