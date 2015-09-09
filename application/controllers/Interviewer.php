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
    		'user_namber' => false,
    		'user_qq' => false,
    		'user_major' => false,
    		'user_sex' => false,
    		'user_telephone' => false,
    		'user_telephone' => false,
    		'user_telephone' => false,
    		'first_section' => false,
    		'second_section' => false,
    		'third_section' => false,
    		'user_talent' => false
    		);

    public function index(){
    	//$this->load->model('section');
    	$userInfo = array(
    		'user_id' => $this->input->get('user_id',TRUE),
    		'user_name' => $this->input->get('user_name',TRUE),
    		'user_namber' => $this->input->get('user_number',TRUE),
    		'user_qq' => $this->input->get('user_qq',TRUE),
    		'user_major' => $this->input->get('user_major',TRUE),
    		'user_sex' => $this->input->get('user_sex',TRUE),
    		'first_section' => $this->input->get('first_section',TRUE),
    		'second_section' => $this->input->get('second_section',TRUE),
    		'third_section' => $this->input->get('third_section',TRUE),
    		'user_talent' => $this->input->get('user_talent',TRUE)
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
   private function showInterviewer($section) {
   	/*	$this->load->helper('url');
   		$this->load->model('section');
   		$sectionList = $this->section->getSectionList();
   		$this->load->view('interviewer', array(
   		    'sectionList' => $sectionList,
   		    'userInfo' => $this->userInfo(),
   		    'section' => $section,
   		));*/
   }

   /**    
    *  面试官密码验证
    *  
    * @access public
   */
   public function checkPwd() {
   		$interviewerPwd = $this->input->post('interviewerPwd',TRUE);
   		if(!isset($interviewerPwd)) {
   			self::index();
   		}
   		switch ($interviewerPwd) {
   			case 'nwsxuanchuan':
   				self::showInterviewer('1');
   				break;	
   			case 'nwswailian' :
   				self::showInterviewer('2');
   				break;
   			case 'nwscaibian' :
   				self::showInterviewer('3');
   				break;	
   			case 'nwscehua' :
   				self::showInterviewer('4');
   				break;
   			case 'nwsyinyin' :
   				self::showInterviewer('5');
   				break;
   			case 'nwsjishu':
   				self::showInterviewer('6');
   				break;	
   			default:
   				echo false;
   				break;
   		}

   }

}