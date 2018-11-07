<?php

class DavidIniParser
{
    public function IniToArray($filename)
    {
        try {
            if (file_exists("./files/" . $filename)) {
                $ini_array = parse_ini_file($filename, true);
                print_r($ini_array);
                return 0;
            } else {
                echo "\e[0;31mCan't find file: $filename\n###########\e[0m\n";
                return 1;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return 1;
    }

    public function ArrayToIni($section, $keys, $values, $filename = "")
    {
        try {
            if (!file_exists("./files")) {
                mkdir("./files", 0777, true);
            }
            $file = "";
            if ($filename == "") {
                $filename = $this->FileNameGenerator();
                $status = "created";
                $file = fopen("./files/" . $filename . ".ini", 'w');
            } elseif (strlen($filename) > 0) {
                $status = "updated";
                $file = fopen("./files/" . trim($filename) . ".ini", 'a');
            }
            $keys_array = explode(',', $keys);
            $values_array = explode(',', $values);


            $assoc_array = array();
            if (sizeof($keys_array) == sizeof($values_array)) {
                fwrite($file, "[$section]\n");
                for ($i = 0; $i < sizeof($keys_array); $i++)
                    $assoc_array[trim($keys_array[$i])] = trim($values_array[$i]);
                foreach ($assoc_array as $key => $value) {
                    fwrite($file, $key . "=" . $value . "\n");
                }
                echo "\e[0;32mFile \"$filename\" $status!\e[0m\n";
            } else {
                echo "\e[0;31mIncorrect array sizes!\n###########\e[0m\n";
            }
        } catch (Exception $e) {
            echo "Caught exception: " . $e->getMessage();
        }
    }

    private function FileNameGenerator()
    {
        return hash("crc32", rand(100, 999));
    }

    public function GetSectionKeysValues()
    {
        $section = trim(readline("Give section name: \n"));
        $keys = readline("Keys separated by commas: key1, key2, key3\n");
        $values = readline("Values separated by commas: value1, value2, value3\n");
        $output = [[$section], [$keys], [$values]];
        return $output;
    }
}

