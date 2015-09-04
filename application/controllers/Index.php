<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * 
 * 
 * 
 *
 * @copyright  版权所有(C) 2014-2015 沈阳工业大学ACM实验室 沈阳工业大学网络管理中心 *Chen
 * @license    http://www.gnu.org/licenses/gpl-3.0.txt   GPL3.0 License
 * @version    
 * @link       https://github.com/SUTFutureCoder/
*/
class Index extends CI_Controller{
    public function __construct() {
        parent::__construct();
    }
    
    /**    
     *  显示招新报名界面    
     *  
     * @access public
    */
    public function index(){
        $this->load->helper('url');
        $this->load->model('section');
        $sectionList = $this->section->getSectionList();
        $this->load->view('sign_up_view', array(
            'sectionList' => $sectionList,
        ));
    }
    
    /**    
     *  显示验证码  
     * 
     * @access public  
     *  
    */
    public function getAgnomen(){
        $this->load->library('session');
        $this->load->library('ValidateCode');
        $_vc = new ValidateCode();            
        $_vc->doimg();
        $this->session->set_userdata('authnum_session', $_vc->getCode());
    }
}