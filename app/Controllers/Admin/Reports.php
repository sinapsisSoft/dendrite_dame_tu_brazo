<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Content_info;
use App\Models\User_assessment;

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
    if (isset($userId)){    
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
    if(isset($userId)){      
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
    if(isset($userId)){      
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
    if(isset($userId)){      
      $user = $this->request->getVar('user_id');
      $module = $this->request->getVar('module_id');
      $result = $report->select_user_report($user, $module); //Ajustar para hacer sólo 1 consulta y que por javascript se organice la info
      echo json_encode($result);
    }
    else {
      return view('login/authentication-login', $data);
    }
  }

  public function chart2(){
    $report = new User_assessment();
    $data['title'] = TITLE;
    $data['css'] = view('template/css');
    $data['script'] = view('template/script');
    $data['header'] = view('template/header');    
    $userId = $this->session->get('user');    
    $dataQuestion = array();
    $dataResult = array();
    if(isset($userId)){      
      $result = $report->select_average_report(); 
      $questionId = $result[0]->question_id;    
      for($i = 0; $i < count($result); $i++){     
        if($questionId != $result[$i]->question_id){
          $questionId = $result[$i]->question_id;
          array_push($dataResult, $dataQuestion);
          unset($dataQuestion);
          $dataQuestion = array();
        }
        array_push($dataQuestion, $result[$i]->Average);
      } 
      array_push($dataResult, $dataQuestion);
      echo json_encode($dataResult);
    }
    else {
      return view('login/authentication-login', $data);
    }
  }
}
