<?php 
namespace App\Models;

use CodeIgniter\Model;

class Content_info extends Model{

    protected $table ='content_info';
    protected $primaryKey='content_info_id';
    protected $allowedFields=['content_info_id','content_info_title','content_info_img','content_info_element',
    'content_id'];

  function select_content_module_main($module_id, $type) {
		$query = "CALL sp_content_info_content(" . $module_id . "," . $type .")";
    $result = $this->db->query($query)->getResult();
    return $result;
	}

  function select_content_info_quiz($module_id, $type){
    $query = "CALL sp_content_info_quiz(" . $module_id . "," . $type .")";
    $result = $this->db->query($query)->getResult();
    return $result;
  }
}