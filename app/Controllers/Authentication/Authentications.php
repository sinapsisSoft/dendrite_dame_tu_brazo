<?php

namespace App\Controllers\Authentication;

use CodeIgniter\Controller;
use App\Models\Login;

class Authentications extends Controller
{
  public $dataResult;
  public $session;

  public function __construct()
  {
    $this->session = \Config\Services::session();
  }

  public function index()
  {
    $data['title'] = TITLE;
    $data['css'] = view('template/css');
    $data['script'] = view('template/script');
    $data['header'] = view('template/header');
    return view('login/authentication-login', $data);
  }

  public function login()
  {

    $login = new Login();

    $user = strval($this->request->getVar('login_email'));
    $pass = md5(strval($this->request->getVar('login_password')));
    $data['user']= $login->sp_login($user,$pass);
    $this->session->set($data);
    echo json_encode($data);
  }


  public function destroySession()
  {
    $this->session->destroy();
    return "login/view";
  }
}
