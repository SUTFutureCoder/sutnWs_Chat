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
   	private $userInfo = array(
    		'user_id' => false,
    		'user_name' => false,
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
    		);

    public function index(){
    	//$this->load->model('section');
    	$userInfo = array(
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
    		);
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
   		$this->load->library('session');
   		$section_id = $this->input->get('session',TRUE);
   		$section = $this->session->userdata('interviewerSection');
   		$this->load->helper('url');
   		$this->load->model('section');
   		if(!$section) {
   			redirect('Index/index');
   		} else {
   			$sectionList = $this->section->getSectionList();
   			$this->load->view('interviewer', array(
   			    'sectionList' => $sectionList,
   			    'userInfo' => $this->userInfo,
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
   			case 'nwsyinyin' :
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
      if($this->session->userdata('interviewerSection')) {
           $this->load->model('user_model');
            $data['user_id'] = $this->input->post('user_id',TRUE);
            $data['section_id'] = $this->input->post('section_id',TRUE);
            $data['user_score'] = $this->input->post('user_score',TRUE);
           $result = $this->user_model->InterviewerScore($data);
           if($result) {
              
           } else {

           }
         }else {
            redirect('Index/index');
      }
      $this->session->unset_userdata('interviewerSection');
   }

}