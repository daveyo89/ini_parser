<?php
if ($argv && $argv[0] && realpath($argv[0]) === __FILE__) {

    function __autoload($DavidIniParser)
    {
        require_once "DavidIniParser.php";
    }

    class DavidFileToArray
    {
        public function FileToArray($filename)
        {
            $obj = new DavidIniParser;
            return $obj->IniToArray($filename);
        }
    }
    $test = new DavidFileToArray();
    $testArray = $test->FileToArray(($i = getopt("f:")["f"]) ? $i : "test4.ini");
    print_r($testArray);

}
