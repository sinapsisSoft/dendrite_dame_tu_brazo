<?php

namespace App\Controllers\Content;

use App\Models\Activity_user;
use CodeIgniter\Controller;
use App\Models\Content_info;
use App\Models\User_score;
use App\Models\User_assessment;

class Content_infos extends Controller
{
  public $session;

  public function __construct()
  {
    $this->session = \Config\Services::session();
  }

  public function index()
  {
    $activity_user = new Activity_user();
    $data['title'] = TITLE; 
    $data['css'] = view('template/css');
    $data['script'] = view('template/script');
    $data['header'] = view('template/header'); 
       
    $userId = $this->session->get('user');

    if($userId != null){
      $data['footer'] = view('template/footer_index');
      $data['activity'] = $activity_user->getActivity($userId[0]->user_id);
      return view('student/home/dashboard', $data);
      
      
    }
    else {
    return view('login/authentication-login', $data);
 
      
    }
    
    
  }

  public function module()
  {    
    $dataModule = [
      'module_id' => $this->request->getVar('module_id')
    ];       
    $this->session->set($dataModule);
    echo "student/module";
  }

  public function showModule(){
    $content_info = new Content_info();
    $activity_user = new Activity_user();
    $data['title'] = TITLE;
    $data['css'] = view('template/css');
    $data['script'] = view('template/script');
    $data['header'] = view('template/header');
    $moduleId = $this->session->get('module_id');
     
    $userId = $this->session->get('user');  
    if ($userId != null){
      $data['module_info'] = $content_info->select_content_module_main($moduleId, 1);  
      $data['activity'] = $activity_user->getActivity($userId[0]->user_id);
      $data['module_id'] = $moduleId;
      $data['footer'] = view('template/footer_main');
      return view('student/module/module', $data);
    }
    else {


      return view('login/view', $data); 

    }
  }

  public function content(){    
    $dataContent = [
      'type_content_id' => $this->request->getVar('type_content_id')
    ];       
    $this->session->set($dataContent);
    switch ($dataContent['type_content_id']){
      case 2: 
        echo "student/infographic";
        break;
      case 3:
        echo "student/video";
        break;
      case 4:
        echo "student/podcast";
        break;
      case 5:
        echo "student/quiz";
        break;
      case 6:
        echo "student/assessment";
        break;
      case 7:
        echo "student/webinar";
        break;
      default:
        echo "student/module";
        break;
    }
  }

  public function showContent(){
    $content_info = new Content_info();
    $activity_user = new Activity_user();
    $data['title'] = TITLE;
    $data['css'] = view('template/css');
    $data['script'] = view('template/script');
    $data['header'] = view('template/header'); 
    $moduleId = $this->session->get('module_id');
    $typeId = $this->session->get('type_content_id');    
    $userId = $this->session->get('user');   

     
    if($moduleId != null && $typeId != null){
      $data['content_info'] = $content_info->select_content_module_main($moduleId, $typeId);  
      $contenId = $data['content_info'][0]->content_id;
      $data['module_id'] = $moduleId;
      $activity_user->setActivity($userId[0]->user_id, $contenId, $typeId);
      switch($typeId){
        case 2: 
          $data['footer'] = view('template/footer');
          return view('student/module/infographic', $data);
          break;
        case 3:
          $data['footer'] = view('template/footer');
          return view('student/module/video', $data);
          break;
        case 4:
          $data['footer'] = view('template/footer');
          return view('student/module/podcast', $data);
          break;
        case 7:
          $data['footer'] = view('template/footer');
          return view('student/module/webinar', $data);
          break;
        default:
          $data['footer'] = view('template/footer_main');
          return view('student/module/module', $data);
          break;
      }   
    }      
    else {
      return view('login/view', $data);
    }
     
  }

  public function showQuiz(){
    $content_info = new Content_info();    
    $data['title'] = TITLE;
    $data['css'] = view('template/css');
    $data['script'] = view('template/script');
    $data['header'] = view('template/header');  
    $moduleId = $this->session->get('module_id');
    $typeId = $this->session->get('type_content_id');
    $userId = $this->session->get('user_id');  
    if($moduleId != null && $typeId != null){
      $data['content_questions'] = $content_info->select_content_info_quiz($moduleId, $typeId); 
      $contenId = $data['content_questions'][0]->content_id; 
      $this->session->set("content_id", $contenId);   
      $data['module_id'] = $moduleId;
      $data['footer'] = view('template/footer');
      switch($typeId) {
        case 5:
          return view('student/module/quiz', $data);
          break;
        case 6:
          $user_assesssment = new User_assessment();
          $result = $user_assesssment->where('content_id', $contenId)
                                      ->where('user_id', $userId)
                                      ->first();
          $data['disabled'] = (isset($result)) ? "disabled" : "";  
          return view('student/module/assessment', $data);
          break;
      }            
    }    
    else {
      return view('login/view', $data);
    }
  }

 
    public function createQuiz()
  {
    $user_score = new User_score();
    $activity_user = new Activity_user();
    $score = $this->request->getVar('user_score_value'); 
  
    $contentId = $this->session->get('content_id');
    $userId = $this->session->get('user');

    if($score >= 3){
      $activity_user->setActivity($userId[0]->user_id, $contentId, 5);
    }    
    echo json_encode($user_score->insert_score_quiz($contentId, $userId[0]->user_id, $score));
  }

 
 public function createAssessment(){
    $user_assesssment = new User_assessment();
    $activity_user = new Activity_user();
    $answers = $this->request->getVar('answers');   

    $contentId = $this->session->get('content_id');
    $userId = $this->session->get('user');

    foreach($answers as $item){
      $data = [
        'user_assessment_id'=> NULL,
        'question_answer_id'=> $item->question_answer_id,
        'user_assessment_detail'=> NULL,
        'content_id'=> $contentId,
        'user_id'=> $userId[0]->user_id
      ];
      $user_assesssment->insert($data);      
    }
    $activity_user->setActivity($userId[0]->user_id, $contentId, 6);
    echo json_encode($data);
  }

  public function createLastQuestion(){
    $user_assesssment = new User_assessment();
    $activity_user = new Activity_user();
    $answer = $this->request->getVar('question_answer_id');   
    $detail = $this->request->getVar('user_assessment_detail');   
    $contentId = $this->session->get('content_id');
    $userId = $this->session->get('user');
    $data = [
        'user_assessment_id'=> NULL,
        'question_answer_id'=> $answer,
        'user_assessment_detail'=> $detail,
        'content_id'=> $contentId,
        'user_id'=> $userId[0]->user_id
      ];
    $user_assesssment->insert($data);   
    echo json_encode($data);
  }

  public function dashboardAdmin()
  {
    try{
      $data['title'] = TITLE;
      $data['css'] = view('template/css');
      $data['script'] = view('template/script');
      $data['header'] = view('template/header');
      return view('admin/dashboard', $data);
    }catch(\CodeIgniter\UnknownFileException $e){
      exit($e->getMessage());
    }
    
  }

  public function preload()
  {
    $data['title'] = TITLE;
    $data['css'] = view('template/css');
    $data['script'] = view('template/script');
    return view('home/preload', $data);
  }
}
