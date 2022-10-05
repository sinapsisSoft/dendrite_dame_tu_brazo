<?php

namespace App\Models;

use CodeIgniter\Model;

class Activity_user extends Model
{

  protected $table = 'activity_user';
  protected $primaryKey = 'activity_user_id';
  protected $allowedFields = ['activity_user_id', 'activity_user_date', 'activity_user_detail', 'content_id', 'user_id'];

  function getActivity($user_id){
    $query = "CALL sp_activity_user(" . $user_id . ")";
    $result = $this->db->query($query)->getResult();
    return $result;
  }

  function setActivity($user_id, $content_id, $type){
    $query = "CALL sp_create_activity_user(" . $user_id . "," . $content_id ."," . $type .")";
    // echo "CALL sp_create_activity_user(" . $user_id . "," . $content_id ."," . $type .")";
    $result = $this->db->query($query)->getResult();
    return $result;
  }
}
