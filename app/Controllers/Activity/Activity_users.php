<?php

namespace App\Controllers\Activity;

use CodeIgniter\Controller;
use App\Models\Activity_user;

class Activity_users extends Controller
{
  public $dataResult;

  public function index()
  {
    $data['title'] = TITLE;
    $data['css'] = view('template/css');
    $data['script'] = view('template/script');
    $data['header'] = view('template/header');
    $data['footer'] = view('template/footerMain');  
      return view('student/home/habeas_data', $data);  
  }

  public function create_habeas()
  {
    $activity = new Activity_user();
    $data = [
      'activity_user_id' => NULL,
      'activity_user_detail' => $this->request->getVar('activity_user_detail'),
      'content_id' => NULL,
      'user_id' => $this->request->getVar('user_id')
    ];
    $activity->insert($data);
    $data = [
      'activity_user_id' => $activity->getInsertID()
    ];
    echo json_encode($data);
  }
}
