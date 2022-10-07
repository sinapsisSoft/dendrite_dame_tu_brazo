<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Content_info;

class Reports extends Controller
{
  public $session;

  public function __construct()
  {
    $this->session = \Config\Services::session();
  }

  public function index(){
    $data['title'] = TITLE;
    $data['css'] = view('template/css');
    $data['script'] = view('template/script');
    $data['header'] = view('template/header');    
    $userId = $this->session->get('user');
    if($userId[0]->user_id != null){      
      return view('admin/dashboard', $data);    
    }
    else {
      return view('login/authentication-login', $data);
    }
  }

  public function chart1(){
    $report = new Content_info();
    $data['title'] = TITLE;
    $data['css'] = view('template/css');
    $data['script'] = view('template/script');
    $data['header'] = view('template/header');    
    $userId = $this->session->get('user');
    $finDate = $this->request->getVar('finDate');
    if($userId != null){      
      $result = $report->select_module_report($finDate);
      echo json_encode($result);
    }
    else {
      return view('login/authentication-login', $data);
    }
  }

  public function table(){
    $report = new Content_info();
    $data['title'] = TITLE;
    $data['css'] = view('template/css');
    $data['script'] = view('template/script');
    $data['header'] = view('template/header');    
    $userId = $this->session->get('user');
    $finDate = $this->request->getVar('finDate');
    if($userId != null){      
      $result = $report->select_table_report($finDate);
      echo json_encode($result);
    }
    else {
      return view('login/authentication-login', $data);
    }
  }

  public function user(){
    $report = new Content_info();
    $data['title'] = TITLE;
    $data['css'] = view('template/css');
    $data['script'] = view('template/script');
    $data['header'] = view('template/header');    
    $userId = $this->session->get('user');    
    if($userId != null){      
      $user = $this->request->getVar('user_id');
      $module = $this->request->getVar('module_id');
      $result = $report->select_user_report($user, $module);
      echo json_encode($result);
    }
    else {
      return view('login/authentication-login', $data);
    }
  }
}
