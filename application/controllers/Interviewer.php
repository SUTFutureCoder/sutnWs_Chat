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
     *  扫面二维码
     *  
     * @access public
    */
    public function index(){
    	$pwd = false;
    	header('Content-Type:text/html;charset=utf-8');
    	echo "<script type='text/javascript'>".$pwd. "=" ."
    	prompt('请输入密码');  
    	</script>";

    	$userInfo = array(
    		'user_id' => $this->input->get('user_id',TRUE),
    		'user_name' => $this->input->get('user_name',TRUE),
    		'user_namber' => $this->input->get('user_number',TRUE),
    		'user_qq' => $this->input->get('user_qq',TRUE),
    		'user_major' => $this->input->get('user_major',TRUE),
    		'user_sex' => $this->input->get('user_sex',TRUE),
    		'user_telephone' => $this->input->get('user_telephone',TRUE),
    		'user_telephone' => $this->input->get('user_telephone',TRUE),
    		'user_telephone' => $this->input->get('user_telephone',TRUE),
    		'first_section' => $this->input->get('first_section',TRUE),
    		'second_section' => $this->input->get('second_section',TRUE),
    		'third_section' => $this->input->get('third_section',TRUE)
    		);
       	//self::showInterviewer();
    }

    /**    
     *  显示招新面试面页面
     *  
     * @access public
    */
   private function showInterviewer() {
   		$this->load->helper('url');
   		$this->load->model('section');
   		$sectionList = $this->section->getSectionList();
   		$this->load->view('interviewer', array(
   		    'sectionList' => $sectionList,
   		));
   }

}