<?php

class DavidIniParser

# TODO ArgParser, hogy optionnel is lehessen egyből inditani.
{

    public function IniToArray($filename)
    {
        try {
            if (file_exists("./files/" . $filename)) {
                $ini_array = parse_ini_file("./files/" . $filename, true);
                return $ini_array;
            } else {
                return "\e[0;31mCan't find file: $filename\n###########\e[0m\n";
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
                $file = fopen("./files/" . trim($filename), 'a');
            }
            $keys_array = explode(',', $keys);
            $values_array = explode(',', $values);

            if (strlen($section) <= 2) $section = "";
            $assoc_array = array();
            if (sizeof($keys_array) == sizeof($values_array)) {
                if (!empty($section)) fwrite($file, "$section\n");
                for ($i = 0; $i < sizeof($keys_array); $i++)
                    $assoc_array[trim($keys_array[$i])] = trim($values_array[$i]);
                foreach ($assoc_array as $key => $value) {
                    fwrite($file, $key . "=" . $value . "\n");
                }

                if (pathinfo($file["extension"]) != ".ini" && $status != "created")
                    echo "\e[1;33mIncorrect file extension, please change manually\n###########\e[0m\n";
                fclose($file);
                return "\e[0;32m\nFile \"$filename\" $status!\e[0m\n";
            } else {
                return "\e[0;31mIncorrect array sizes!\n###########\e[0m\n";
            }
        } catch (Exception $e) {
            return "Caught exception: " . $e->getMessage();
        }
    }

    public function AssocArrayToIni(array $assocArray) {
        $file = fopen("./files/" . "test" . ".ini", 'w');
        $result = $this->array_flatten($assocArray);
        foreach ($result as $item=>$value){
            if (strlen($value)>1) {
                fwrite($file, $item . "=" . $value . "\n");
            } else {
                fwrite($file, $item . "\n");
            }
        }
        //print_r($assocArray);
    }

    private function FileNameGenerator()
    {
        return hash("crc32", rand(100, 999));
    }

    public function GetSectionKeysValues()
    {
        $section = trim(readline("Give section name: \n"));
        $keys = readline("Keys separated by commas: key1, key2, key3 ...\n");
        $values = readline("Values separated by commas: value1, value2, value3 ...\n");
        $output = [["[" . $section . "]"], [$keys], [$values]];
        return $output;
    }

    public function array_flatten($array) {
        $return = array();
        foreach ($array as $key => $value) {
            if (is_array($value)) { $return["[$key]"] = "";}
            if (is_array($value)) { $return = array_merge($return, $this->array_flatten($value));}
            else {$return[$key] = $value;}
        }
        print_r($return);

        return $return;

    }
}

