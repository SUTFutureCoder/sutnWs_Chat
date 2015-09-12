<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 * 
 * 
 * 
 *
 * @copyright  版权所有(C) 2014-2015 沈阳工业大学ACM实验室 沈阳工业大学网络管理中心 cwen_yin
 * @license    http://www.gnu.org/licenses/gpl-3.0.txt   GPL3.0 License
 * @version    
 * @link       https://github.com/SUTFutureCoder/
*/

class Interviewer extends CI_Controller{
    public function __construct() {
        parent::__construct();
    }

    /**    
     *  扫描二维码
     *  
     * @access public
    */
   	/*private $userInfo = array(
    		'user_id' => false,
    		'user_name' => 'yin',
    		'user_number' => false,
    		'user_qq' => false,
    		'user_major' => false,
    		'user_sex' => false,
    		'user_telephone' => false,
    		'first_section' => false,
    		'second_section' => false,
    		'third_section' => false,
    		'user_talent' => false,
    		'img_address' => false
    		);*/

    public function index(){
      //http://localhost/sutnWs_Chat/index.php/Interviewer/index?user_id=130405212&user_name=nijjj&user_number=130405212&user_qq=123666&user_major=kkkkk&user_sex=男&first_section=1&second_section=&third_section=
    	//$this->load->model('section');
    /*	$userInfo = array(
    		'user_id' => $this->input->get('user_id',TRUE),
    		'user_name' => $this->input->get('user_name',TRUE),
    		'user_number' => $this->input->get('user_number',TRUE),
    		'user_qq' => $this->input->get('user_qq',TRUE),
    		'user_major' => $this->input->get('user_major',TRUE),
    		'user_sex' => $this->input->get('user_sex',TRUE),
    		'first_section' => $this->input->get('first_section',TRUE),
    		'second_section' => $this->input->get('second_section',TRUE),
    		'third_section' => $this->input->get('third_section',TRUE),
    		'user_talent' => $this->input->get('user_talent',TRUE),
    		'img_address' => $this->input->get('img_address',TRUE)
    		);*/
    	$this->load->helper('url');
    	$this->load->view('interviewer_login');
       	//self::showInterviewer();
    }

    /**    
     *  显示招新面试面页面
     *  
     * @access public
    */
   public function showInterviewer() {
    $userInfo = array(
            'user_id' => false,
            'user_name' => false,
            'user_number' =>false,
            'user_telephone' =>false,
            'user_qq' => false,
            'user_major' => false,
            'user_sex' =>false,
            'first_section' => false,
            'second_section' => false,
            'third_section' => false,
            'user_talent' => false
      );
    $userInfo = array(
            'user_id' => $this->input->get('user_id',TRUE),
            'user_name' => urldecode($this->input->get('userName',TRUE)),
            'user_number' => $this->input->get('userNumber',TRUE),
            'user_qq' => $this->input->get('userQQ',TRUE),
            'user_telephone' =>$this->input->get('userTelephone',TRUE),
            'user_major' => urldecode($this->input->get('userMajor',TRUE)),
            'user_sex' => urldecode($this->input->get('userSex',TRUE)),
            'first_section' => $this->input->get('userFirstSection',TRUE),
            'second_section' => $this->input->get('userSecondSection',TRUE),
            'third_section' => $this->input->get('userThirdSection',TRUE),
            'user_talent' => urldecode($this->input->get('user_talent',TRUE))
      );
      $this->load->model('section');
      //$sectionList = $sectionList = $this->section->getSectionList();
      $userInfo['first_section'] = $this->section->getSection($userInfo['first_section'])[0]['section_name'];
      if($userInfo['second_section'] != 0) {
        $userInfo['second_section'] = $this->section->getSection($userInfo['second_section'])[0]['section_name'];
      } else {
        $userInfo['second_section'] = null;
      }
      if($userInfo['third_section'] != 0) {
        $userInfo['third_section'] = $this->section->getSection($userInfo['third_section'])[0]['section_name']; 
      } else {
         $userInfo['third_section'] = null;
      }
      //$sexList = array('男','女','其他','保密');
      //$userInfo['user_sex'] = $sexList[$userInfo['user_sex']];
      switch ($userInfo['user_sex']) {
        case '0' : 
          $userInfo['user_sex'] = "男";
          break;
        case '1' :
          $userInfo['user_sex'] = "女";
          break;
        case '2' :
          $userInfo['user_sex'] = "其他";
          break;
        case '3' :
          $userInfo['user_sex'] = "保密";
          break;
        default :
          $userInfo['user_sex'] = "性别选择错误";
          break;
      };
   		$this->load->library('session');
   		$section_id = $this->input->get('section',TRUE);
   		$section = $this->session->userdata('interviewerSection');
   		$this->load->helper('url');
   		$this->load->model('section');
   		if(!$section) {
   			redirect('Index/index');
   		} else {
   			$sectionList = $this->section->getSectionList();
   			$this->load->view('interviewer', array(
   			    'sectionList' => $sectionList,
   			    'userInfo' => $userInfo,
   			    'section_id' => $section_id,
   			    'section' => $section
   			)); 
   		}
   }

   /**    
    *  面试官密码验证
    *  
    * @access public
   */
   public function checkPwd() {
   		$this->load->helper('url');
   		$this->load->library('session');
   		$interviewerPwd = $this->input->post('interviewerPwd',TRUE);
   		if(!isset($interviewerPwd)) {
   			self::index();
   		}
   		//echo $interviewerPwd;
   		switch ($interviewerPwd) {
   			case 'nwsxuanchuan':
   				$this->session->set_userdata('interviewerSection', '采编部');
   				echo '1';
   				break;	
   			case 'nwswailian' :
   				$this->session->set_userdata('interviewerSection', '外联部');
   				echo '2';
   				break;
   			case 'nwscaibian' :
   				$this->session->set_userdata('interviewerSection', '采编部');
   				echo '3';
   				break;	
   			case 'nwscehua' :
   				$this->session->set_userdata('interviewerSection', '策划部');
   				echo '4';
   				break;
   			case 'nwsyingyin' :
   				$this->session->set_userdata('interviewerSection', '影音部');
   				echo '5';
   				break;
   			case 'nwsjishu':
   				$this->session->set_userdata('interviewerSection', '技术部');
   				echo '6';
   				break;	
   			default:
   				$this->session->unset_userdata('interviewerSection');
   				echo false;
   				break;
   		}
   }

   /**    
    *  面试官打分
    *  
    * @access public
   */
   public function userScore() {
      $this->load->helper('url');
      $this->load->library('session');
      if($this->session->userdata('interviewerSection')) {
           $this->load->model('user_model');
            $data['user_id'] = $this->input->post('user_id',TRUE);
            $data['section_id'] = $this->input->post('section_id',TRUE);
            $data['user_score'] = $this->input->post('user_score',TRUE);
            if(!ctype_digit($data['user_score'])) {
              echo json_encode(array('code' => -1, 'message' => '分数不合法'));
              return;
            }
           $result = $this->user_model->InterviewerScore($data);
           //$result = true;
           //echo $data['user_score'];
           if($result > 0) {
              echo json_encode(array('code' => 1, 'message' => '打分成功'));
           } else {
              echo json_encode(array('code' => -1, 'message' => '该同学分数已打或是没有填写本部门'));
           }
           //echo $data['section_id'];
         }else {
            echo json_encode(array('code' => -1, 'message' => '请先登录'));
      }
      $this->session->unset_userdata('interviewerSection');
   }

}