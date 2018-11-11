<?php
if ($argv && $argv[0] && realpath($argv[0]) === __FILE__) {

    function __autoload($DavidIniParser)
    {
        require_once "DavidIniParser.php";
    }

    class DavidCLI
    {
        public function ActiveInterface()
        {
            $obj = new DavidIniParser;

            while (true) {
                echo "Hello, please select an option:\n1: Read .ini file.\n2: Write associative array to file\n3: Append to existing file\n0: Exit\n";

                $choice = readline("Choose: ");
                switch ($choice) {
                    case "0":
                        exit();
                    case "1":
                        $fname = readline("Give file path/name with extension:\n");
                        $array = ($obj->IniToArray($fname));
                        # Could change print_r to return to work with output array easier.
                        print_r($array);
                        break;
                    case "2":
                        $data = $obj->GetSectionKeysValues();
                        print_r($obj->ArrayToIni($data[0][0], $data[1][0], $data[2][0]));
                        continue;
                    case "3":
                        $filename = trim(readline("Give file name (with extension):\n"));
                        $data = $obj->GetSectionKeysValues();
                        print_r($obj->ArrayToIni($data[0][0], $data[1][0], $data[2][0], $filename));
                        continue;
                }
            }
        }

    }

    $interface = new DavidCLI();
    $interface->ActiveInterface();
}