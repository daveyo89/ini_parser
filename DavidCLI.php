<?php
if ($argv && $argv[0] && realpath($argv[0]) === __FILE__) {

    function __autoload($DavidIniParser)
    {
        require_once "DavidIniParser.php";
    }

    $obj = new DavidIniParser;
    while (true) {
        echo "Hello, please select an option:\n1: Read .ini file.\n2: Write associative array to file\n3: Append to existing file\n0: Exit\n";

        $choice = readline("Choose: ");
        switch ($choice) {
            case "0":
                exit();
                break;
            case "1":
                $fname = readline("Give file path/name without extension:\n");
                $obj->IniToArray($fname . ".ini");
                continue;
            case "2":
                $data = $obj->GetSectionKeysValues();
                $obj->ArrayToIni($data[0][0], $data[1][0], $data[2][0]);
                continue;
            case "3":
                $filename = trim(readline("Give file name (without extension):\n"));
                $data = $obj->GetSectionKeysValues();
                $obj->ArrayToIni($data[0][0], $data[1][0], $data[2][0], $filename);
                continue;
        }
    }
}