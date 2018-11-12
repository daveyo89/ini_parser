<?php
if ($argv && $argv[0] && realpath($argv[0]) === __FILE__) {

    function __autoload($DavidIniParser)
    {
        require_once "DavidIniParser.php";
    }

    class DavidArrayHandler
    {
        public function ArrayHandler()
        {
            $obj = new DavidIniParser;

            $testArray = [
                "Section" => [
                    "key" => "value",
                    "key2" => "value2",
                    "key3" => "value3",
                    "NestedSection" => [
                        "nestedKey1" => "nestedValue1",
                        "nestedKey2" => "nestedValue2",
                        "NestedSection2" => [
                            "nestedKey3" => "nestedValue1",
                            "nestedKey4" => "nestedValue2",
                            "NestedSection3" => [
                                "deepNestedKey1" => "deepNestedValue1",
                                "deepNestedKey2" => "deepNestedValue2",
                            ],
                        ],
                    ],
                ],
                "Section2" => [
                    "S2key" => "s2value",
                    "S2key2" => "s2value2",
                    "S2key3" => "s2value3",
                ],
            ];
            $testArray2 = [
                "SectionA" => [
                    "S2key" => "s2value",
                    "S2key2" => "s2value2",
                    "S2key3" => "s2value3",
                ],
                "SectionB" => [
                    "S2key" => "s2value4",
                    "S2key2" => "s2value5",
                    "S2key3" => "s2value6",
                ],
            ];
            $obj->AssocArrayToIni($testArray2, "test3");
            $obj->AssocArrayToIni($testArray, "test4");
        }
    }

    $test = new DavidArrayHandler();
    $test->ArrayHandler();
}
