<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Navigation_groups_model extends Base_module_model {
	
	public $required = array('name');

	function __construct()
	{
		$CI =& get_instance();
		$tables = $CI->config->item('tables', 'fuel');
		parent::__construct($tables['navigation_groups']);
	}
	
	function list_items($limit = NULL, $offset = NULL, $col = 'location', $order = 'asc')
	{
		$this->db->select('id, name, published');
		$data = parent::list_items($limit, $offset, $col, $order);
		return $data;
	}
}

class Navigation_group_model extends Base_module_record {
}
