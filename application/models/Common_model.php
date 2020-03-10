<?php
class Common_model extends CI_Model{

public function add_data($table,$data){
$this->db->insert($table, $data);
return true;
}

public function update_data($table,$data,$where){
$this->db->where($where);
$this->db->update($table,$data);
return true;
}

public function delete_data($table,$where){
$this->db->where($where);
$this->db->delete($table);
return true;
}

public function get_all_data($table){
$query = $this->db->get($table);
return $result = $query->result_array();
}

public function get_data_by_id($where,$table){
$query = $this->db->get_where($table, $where);
$result = $query->result_array();
return $result;
}

public function custom_fetch_data_with_where($table,$where,$ord_by){
          $this->db->where($where);
          $this->db->order_by($ord_by,'asc');
          $query = $this->db->get($table);
          $result  = $query->result_array();
          return $result;
}
}

?>