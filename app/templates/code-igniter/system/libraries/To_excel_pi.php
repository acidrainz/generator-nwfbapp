<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class To_excel_pi {

	function to_excel($query, $filename='exceloutput')
	{
 		 $headers = '';  
		 $data = '';  
		 
		 //$obj =& get_instance();
		 
		 $fields = $query->field_data();
		 if ($query->num_rows() == 0) {
			  echo '<p>The table appears to have no data.</p>';
		 } else {
			  foreach ($fields as $field) {
				 $headers .= $field->name . "\t";
			  }
		 
			  foreach ($query->result() as $row) {
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
			  echo "$headers\n$data";  
		 }
	}
}
?>