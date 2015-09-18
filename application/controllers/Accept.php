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
        $this->load->library('session');
        if ($this->session->userdata('acceptAccess') && 0 < $this->session->userdata('acceptAccess') && 7 > $this->session->userdata('acceptAccess')){
            $this->acceptFresh();
        } else {
            $this->load->view('accept');
        }
        
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
                        case 'nwsxc' . date('dm') . 't9aybz':
   				$this->session->set_userdata('acceptAccess', 1);
   				echo '1';
   				break;	
                        case 'nwswl' . date('dm') . 'z2vht0':
   				$this->session->set_userdata('acceptAccess', 2);
   				echo '2';
   				break;
                        case 'nwscb' . date('dm') . 'mkx7xv':
   				$this->session->set_userdata('acceptAccess', 3);
   				echo '3';
   				break;	
                        case 'nwsch' . date('dm') . 'nuntcr':
   				$this->session->set_userdata('acceptAccess', 4);
   				echo '4';
   				break;
                        case 'nwsyy' . date('dm') . 'reycwu' :
   				$this->session->set_userdata('acceptAccess', 5);
   				echo '5';
   				break;
                        case 'nwsjs' . date('dm') . 'bjsfho':
   				$this->session->set_userdata('acceptAccess', 6);
   				echo '6';
   				break;	
   			default:
   				$this->session->unset_userdata('acceptAccess');
   				echo false;
   				break;
   		}
   }
   
   /**
    * 显示录取界面
    * 
    * @access public
    * @param
    * @return 
    */
   public function acceptFresh(){
       $this->load->helper('url');
       $this->load->model('section');
       $sectionList = $this->section->getSectionList();
       $sectionArray = array();
       foreach ($sectionList as $sectionListValue){
           $sectionArray[$sectionListValue['section_id']] = $sectionListValue['section_name'];
       }
       $this->load->model('fresh_model');
       $this->load->library('session');
       if (!isset($sectionArray[$this->session->userdata('acceptAccess')]) || !is_numeric($this->session->userdata('acceptAccess'))){
           echo '错误的密码';
           return 0;
       }
       
       $userAcceptedSum = $this->fresh_model->getAcceptedSum($this->session->userdata('acceptAccess'));
       
       $freshUserList = array();
       $freshUserList = $this->fresh_model->getFreshAcceptList($this->session->userdata('acceptAccess'));
       
       
       $this->load->view('accept', array(
           'userAcceptSum' => $userAcceptedSum,
           'freshUserList' => $freshUserList,
       ));
   }
   
   /**
    * 切换录取状态
    * 
    * 
    * @access public
    * @return 
    */
   public function acceptToggle(){
       $this->load->library('session');
       if (!is_numeric($this->session->userdata('acceptAccess')) || 0 >= $this->session->userdata('acceptAccess') || 6 < $this->session->userdata('acceptAccess')){
           echo json_encode(array('code' => -1, 'status' => '认证错误'));
           return 0;
       }
       
       $userId = $this->input->post('user_id', true);
       $sectionId = $this->input->post('section_id', true);
       $toggle = $this->input->post('toggle', true);
       
       if (empty($userId) || !is_numeric($userId) || 0 > $userId){
           echo json_encode(array('code' => -3, 'status' => '用户id有误'));
           return 0;
       }
       
       if (!isset($toggle) || ($toggle != 1 && $toggle != 0)){
           echo json_encode(array('code' => -2, 'status' => '切换量错误'));
           return 0;
       }
       
       
       if (empty($sectionId) || $this->session->userdata('acceptAccess') != $sectionId){
           echo json_encode(array('code' => -3, 'status' => '部门id错误'));
           return 0;
       }
       
       $this->load->model('fresh_model');
       $result = $this->fresh_model->toggleValid($userId, $sectionId, $toggle);
       if ($result){
           if ($toggle){
               $toggle = 0;
           } else {
               $toggle = 1;
           }
           echo json_encode(array('code' => 1, 'status' => 'ok', 'toggle' => $toggle));
       } else {
           echo json_encode(array('code' => 0, 'status' => '更新失败'));
       }
   }
   
   /**
    * 抢人登录
    * 
    * 
    * @access public
    * @return 
    */
    public function acceptBattleLogin(){
        $this->load->helper('url');
        $this->load->library('session');
        if ($this->session->userdata('acceptBattle')){
            $this->acceptBattle();
        } else {
            $this->load->view('accept_battle');
        }
    }
   
   /**
    * 抢人
    * 
    * 
    * @access public
    * @return 
    */
    public function acceptBattle(){
        $this->load->helper('url');
        $this->load->library('session');
        if (!$this->session->userdata('acceptBattle')){
            echo '未通过认证的请求';
            return 0;
        }
        
        $this->load->model('fresh_model');
//        $sectionSum = array_fill(0, 7, 0);
//        $sectionSumTemp = $this->fresh_model->getSectionFreshSum();
//        
//        foreach ($sectionSumTemp as $sectionSumTempValue){
//            $sectionSum[$sectionSumTempValue['section_id']] = $sectionSumTempValue['sum'];
//        }
        $freshBattleUserInfoList = $this->fresh_model->getFreshBattleUserInfoList();
        if (!count($freshBattleUserInfoList)){
            echo '<h1 style="color:red">招新已完成，各位辛苦了～！</h1><br/><h1 style="color:blue"> 【FROM：*Chen @北京】</h1><br/><h2>请进入http://wx.sutapp.com/index.php/dump_list导出名单</h2>';
            exit();
        }
        
        
        $userList = array();
        $userInfo = array();
        foreach ($freshBattleUserInfoList as $key => $freshBattleUserInfoListValue){
            $userList[$freshBattleUserInfoListValue['user_id']] = $key;
            $userInfo[$freshBattleUserInfoListValue['user_id']] = $freshBattleUserInfoListValue;
        }
        $freshBattleSectionList = array();
        if (count($userList)){
            $userList = array_flip($userList);
            $freshBattleSectionList = $this->fresh_model->getSectionBattleList($userList);
            $userList = array_flip($userList);
            foreach ($freshBattleSectionList as $freshBattleSectionListValue){
                if (!isset($userList[$freshBattleSectionListValue['user_id']]['section'])){
                    $userList[$freshBattleSectionListValue['user_id']] = array();
                }
                $userList[$freshBattleSectionListValue['user_id']]['section'][] = $freshBattleSectionListValue;
            }
        }
        
        $this->load->model('section');
        $sectionList = $this->section->getSectionList();
        $sectionArray = array();
        foreach ($sectionList as $sectionListValue){
            $sectionArray[$sectionListValue['section_id']] = $sectionListValue['section_name'];
        }
        $this->load->view('accept_battle', array(
            'userInfo' => $userInfo,
            'userList' => $userList,
            'sectionList' => $sectionArray,
//            'sectionSum' => $sectionSum,
        ));
    }
    
    
    /**    
    *  检查抢人密码
    *  
    * @access public
   */
    public function checkBattlePwd() {
        $this->load->helper('url');
        $this->load->library('session');
        $acceptBattleAccess = $this->input->post('acceptBattleAccess',TRUE);
        if(!isset($acceptBattleAccess)) {
            self::index();
        }
        
        if ($acceptBattleAccess == 'nwssutacm' . date('md')){
            $this->session->set_userdata('acceptBattle', 1);
            echo '1';
        } else {
            $this->session->unset_userdata('acceptBattle');
            echo false;
        }
    }
    
    /**    
    *  进行抢人
    *  
    * @access public
   */
    public function acceptBattleChoose(){
        $this->load->library('session');
        if (!$this->session->userdata('acceptBattle')){
            echo json_encode(array('code'=> -1, 'status' => '未通过认证的请求'));
            return 0;
        }
        
        $userId = $this->input->post('userId', true);
        $chooseSection = $this->input->post('chooseSection', true);
        if (empty($userId) || !is_numeric($chooseSection)){
            echo json_encode(array('code' => -2, 'status' => '错误的用户id'));
            return 0;
        }
        
        if (empty($chooseSection) || 0 >= $chooseSection || 6 < $chooseSection){
            echo json_encode(array('code' => -3, 'status' => '错误的部门选择'));
            return 0;
        }
        
        $this->load->model('fresh_model');
        if (!$this->fresh_model->chooseSection($userId, $chooseSection)){
            echo json_encode(array('code' => 0, 'status' => '选择失败，查无此人或数据库异常'));
            return 0;
        } else {
            echo json_encode(array('code' => 1, 'status' => '抢人成功'));
            return 0;
        }
    }
}