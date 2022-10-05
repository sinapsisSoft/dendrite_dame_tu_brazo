<?php

namespace App\Models;

use CodeIgniter\Model;

class User_score extends Model
{

  protected $table = 'user_score';
  protected $primaryKey = 'user_score_id';
  protected $allowedFields = ['user_score_id', 'user_score_value', 'content_id', 'user_id'];

  function insert_score_quiz($content, $user, $score)
  {
    $query = "CALL sp_user_score(" . $content . "," . $user . ",'" . $score . "')";
    $result = $this->db->query($query)->getResult();
    return $result;
  }
}
