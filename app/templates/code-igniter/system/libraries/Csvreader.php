<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class CSVReader {

    var $fields;            /** columns names retrieved after parsing */ 
    var $separator  =   ';';    /** separator used to explode each line */
    var $enclosure  =   '"';    /** enclosure used to decorate each field */

    var $max_row_size   =   4096;    /** maximum row size to be used for decoding */

    function parse_file($p_Filepath) 
    {
        $tmpFile           =   fopen($p_Filepath, 'r');
        $this->fields   =   fgetcsv($tmpFile, $this->max_row_size, $this->separator, $this->enclosure);
        fclose($tmpFile);
        $keys_values    =   explode(',',$this->fields[0]);

        $content    =   array();
        $keys       =   $this->escape_string($keys_values);

        $file = fopen($p_Filepath, 'r');
        while(($row = fgetcsv($file, $this->max_row_size, $this->separator, $this->enclosure)) !==  false ) 
        {
            if( $row != null ) { // skip empty lines
                $values         = explode(',',$row[0]);
                if(count($keys) == count($values)){
                    $arr        = array();
                    $new_values = array();
                    $new_values = $this->escape_string($values);

                    for($j=0; $j < count($keys); $j++)
                    {
                        $arr[$j] = $new_values[$j];
                    }
                    $content[]    = $arr;
                }
            }
        }
        fclose($file);
        return $content;
    }

    function escape_string($data)
    {
        $result =   array();
        foreach($data as $row){
            $result[]   =   str_replace('"', '',$row);
        }
        return $result;
    }   
}
?>