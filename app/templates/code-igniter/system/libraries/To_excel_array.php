<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/* 
	recoded by JAY RAMIREZ 
	nuworks interactive labs inc.
	05-24-2012
	
	original from to_exel_pi 
*/
 
class To_excel_array {

	function to_excel($rows, $filename='exceloutput')
	{
 		 $headers = '';  
		 $data = '';  
		 
		 //$obj =& get_instance();
		 
		 
		 if (sizeof($rows) == 0) {
			  echo '<p>The table appears to have no data.</p>';
		 } else {
			  foreach ($rows[0] as $key => $v) {
				 $headers .= $key . "\t";
			  }
		 
			  foreach ($rows as $row) {
				   $line = '';
				   foreach($row as $value) {                                            
						if ((!isset($value)) OR ($value == "")) {
							 $value = "\t";
						} else {
							 $value = str_replace('"', '""', $value);
							 $value = '"' . $value . '"' . "\t";
						}
						$line .= $value;
				   }
				   $data .= trim($line)."\n";
			  }
			  
			  $data = str_replace("\r","",$data);
							 
			  header("Content-type: application/x-msdownload");
			  header("Content-Disposition: attachment; filename=$filename.xls");
			  echo "$data";  
		 }
	}
}
?>