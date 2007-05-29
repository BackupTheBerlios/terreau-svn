<?
class ShowPasses extends HtmlReporter {
    
    function ShowPasses() {
        $this->HtmlReporter();
    }
    
    function paintPass($message) {
        parent::paintPass($message);
        print "<span class=\"pass\">Pass</span>: ";
        $breadcrumb = $this->getTestList();
        array_shift($breadcrumb);
        print implode("-&gt;", $breadcrumb);
        print "->".htmlentities($message)."<br />\n";
    }
    
    function _getCss() {
        return parent::_getCss() . ' .pass { color: green; }';
    }
}
?>
