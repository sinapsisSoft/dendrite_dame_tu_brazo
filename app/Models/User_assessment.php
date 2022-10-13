<?php

namespace App\Models;

use CodeIgniter\Model;

class User_assessment extends Model
{

  protected $table = 'user_assessment';
  protected $primaryKey = 'user_assessment_id';
  protected $allowedFields = ['user_assessment_id', 'question_answer_id', 'user_assessment_detail', 'content_id', 'user_id'];

  function select_average_report(){
    $query = "CALL sp_report_average()";
    $result = $this->db->query($query)->getResult();
    return $result;
  }
}
