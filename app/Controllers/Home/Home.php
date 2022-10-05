<?php

namespace App\Controllers\Home;

use CodeIgniter\Controller;
use App\Models\Data_user;

class Home extends Controller
{
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
    return view('home/preload', $data); 
  }

  public function validateView(){
    $data['title'] = TITLE;
    $data['css'] = view('template/css');
    $data['script'] = view('template/script');
    $data['header'] = view('template/header');    
    $dataUser = [
      'user_id' => $this->request->getVar('user_id'),
      'role_id' => $this->request->getVar('role_id')
    ]; 
    if($dataUser['role_id'] == 1){
      echo "admin/dashboard";
    }
    else if($dataUser['role_id'] == 2){
      $user = new Data_user();
      $result = $user->where('user_id',$dataUser['user_id'])->first();
      if(!empty($result)){
        if($result['data_user_treatment'] == true && $result['data_user_transfer'] == true){
          echo "2,student/dashboard";
        }
        else {
          echo "1,home/habeas_data";  
        }
      }      
      else {
        echo "1,home/habeas_data";  
      }         
    }  
  }

  public function acceptData(){
    $user = new Data_user();
    $dataUser = [
      'user_id' => $this->request->getVar('user_id'),
      'type_id' => $this->request->getVar('type_id')
    ]; 
    $result = $user->acceptData($dataUser['user_id'],$dataUser['type_id']);
    echo json_encode($result);
  }

  public function habeas(){
    $data['title'] = TITLE;
    $data['css'] = view('template/css');
    $data['script'] = view('template/script');
    $data['header'] = view('template/header');    
   
    $userId = $this->session->get('user');  
    if($userId != null){
      return view('student/home/habeas_data', $data); 
    }
    else {
      return view('home/login', $data); 
    }
  }
}
