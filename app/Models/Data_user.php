<?php

namespace App\Models;

use CodeIgniter\Model;

class Data_user extends Model
{

  protected $table = 'data_user';
  protected $primaryKey = 'data_user_id';
  protected $allowedFields = ['data_user_id', 'data_user_treatment', 'data_user_transfer', 'user_id'];

  public function acceptData($user, $type)
  {
    $query = "CALL sp_data_user_insert_update(" . $user . "," . $type . ")";
    $result = $this->db->query($query)->getResult();
    return $result;
  }
}
