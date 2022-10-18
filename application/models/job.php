<?php 
set_time_limit(0);
ini_set('max_execution_time', 0);
ini_set("memory_limit",-1);

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class job extends CI_Model {

    
    public function getUserList($id = ""){
        $wc = "";
        if ($id) $wc = "WHERE id = '$id'";

        $product_list = $this->db->query("SELECT * FROM users $wc GROUP BY name")->result_array();
        return $product_list;
    }
}


