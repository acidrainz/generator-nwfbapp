<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mysql_Queries extends CI_Model {
	 
 	public function __construct()
	{
		parent::__construct(); 
	}
		
	############################### Clean Array  ###############################
	
	function get_clean_array($table, $primary_key) {
		$levels = $this->mysql_queries->get_data(array('table' 	=> $table));
		$level_arr = array();
		foreach($levels as $k => $v) {
			$level_arr[$v[$primary_key]] = $v;
		}
		return $level_arr;
	} 
	
	############################### Clean Array  ###############################
	
	
	
	
	################################## Helpers #################################
	/* 
	
	$params = array("table"		=> '',
					"fields"	=> '',
					"where"		=> '',
					"order"		=> '',
					"group"		=> '',
					"offset"	=> '',
					"limit"		=> '');
	
	*/
	function get_data($params) {
		$table = isset($params['table']) ? $params['table'] : "";
		$fields = isset($params['fields']) ? $params['fields'] : "*";
		$join 	= isset($params['join']) ?  $params['join'] : "";
		$where 	= isset($params['where']) ? "AND " . $params['where'] : "";
		$order 	= isset($params['order']) ? "ORDER BY " . $params['order'] : "";
		$group 	= isset($params['group']) ? "GROUP BY " . $params['group'] : "";
		$limit 	= (isset($params['offset']) && isset($params['limit'])) ? "LIMIT  " . $params['offset'] . ", " . $params['limit'] : "";
		$res = $this->db->query("SELECT " . $fields .
								" FROM " . $table . 
								" " . $join .
								" WHERE 1 " . $where .
								" " . $group . 
								" " . $order . 
								" " . $limit);
		return $res->result_array();
		
	}
	
	function insert_data($params) {
		$query = "INSERT INTO " . $params['table'] . " SET ";
		foreach($params['post'] as $k => $v) {
			$query .= $k . " = '" . mysql_real_escape_string($v) . "', ";
		}
		$query = substr($query, 0, strlen($query) - 2);
		$this->db->query($query);
		return $this->db->insert_id();
	}
	
	
	/* 
	
	$params = array("table"		=> '',
					"field"		=> '',
					"value"		=> '');
	
	*/
	function delete_data($params) {
		$this->db->query("DELETE FROM " . $params['table'] . " WHERE " . $params['field'] . " = " . $params['value']);
	}
	
	function update_data($params) {
		$query = "UPDATE  " . $params['table'] . " SET ";
		foreach($params['post'] as $k => $v) {
			$query .= $k . " = '" . mysql_real_escape_string($v) . "', ";
		}
		$query = substr($query, 0, strlen($query) - 2);
		$query .= " WHERE " . $params['where'];
		$this->db->query($query);	
	}
	################################## Helpers #################################
}