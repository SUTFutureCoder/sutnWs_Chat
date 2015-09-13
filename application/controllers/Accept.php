<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * 录取
 * 
 * 
 *
 * @copyright  版权所有(C) 2014-2015 沈阳工业大学ACM实验室 沈阳工业大学网络管理中心 *Chen
 * @license    http://www.gnu.org/licenses/gpl-3.0.txt   GPL3.0 License
 * @version    
 * @link       https://github.com/SUTFutureCoder/
*/
class Accept extends CI_Controller{
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * 显示导出名单界面
     * 
     * @access public
     * @param 
     * @return 
     */
    public function index(){
        $this->load->helper('url');
        $this->load->view('accept_login');
    }
    
    /**    
    *  检查密码
    *  
    * @access public
   */
    public function checkPwd() {
   		$this->load->helper('url');
   		$this->load->library('session');
   		$acceptAccess = $this->input->post('acceptAccess',TRUE);
   		if(!isset($acceptAccess)) {
   			self::index();
   		}
   		//echo $interviewerPwd;
   		switch ($acceptAccess) {
                        case 'nwsxc' . date('dm'):
   				$this->session->set_userdata('acceptAccess', '宣传部');
   				echo '1';
   				break;	
   			case 'nwswl' . date('dm') :
   				$this->session->set_userdata('acceptAccess', '外联部');
   				echo '2';
   				break;
   			case 'nwscb' . date('dm') :
   				$this->session->set_userdata('acceptAccess', '采编部');
   				echo '3';
   				break;	
   			case 'nwsch' . date('dm'):
   				$this->session->set_userdata('acceptAccess', '策划部');
   				echo '4';
   				break;
   			case 'nwsyy' . date('dm') :
   				$this->session->set_userdata('acceptAccess', '影音部');
   				echo '5';
   				break;
   			case 'nwsjs' . date('dm'):
   				$this->session->set_userdata('acceptAccess', '技术部');
   				echo '6';
   				break;	
   			default:
   				$this->session->unset_userdata('acceptAccess');
   				echo false;
   				break;
   		}
   }
   
   public function acceptFresh(){
       $this->load->model('section');
       $sectionList = $this->section->getSectionList();
       $sectionArray = array();
       foreach ($sectionList as $sectionListValue){
           $sectionArray[$sectionListValue['section_id']] = $sectionListValue['section_name'];
       }
       
       $this->load->model('fresh_model');
       echo $userAcceptedSum = $this->fresh_model->getAcceptedSum();
       
       
       $this->load->library('session');
       if (!in_array($this->session->userdata('acceptAccess'), $sectionArray)){
           return 0;
       }
       
       
   }
}