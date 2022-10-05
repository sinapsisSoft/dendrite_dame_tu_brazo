<?php

namespace App\Models;

use CodeIgniter\Model;

class Login extends Model
{
  protected $table = 'login';
  protected $primaryKey = 'login_id';
  protected $allowedFields = ['login_id', 'login_email', 'login_password', 'user_id'];


function sp_login($user_email,$user_password) {


  $query = "CALL sp_login('". $user_email."','".$user_password."')";
      $result = $this->db->query($query)->getResult();
      return $result;
}
}
