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
class Sign_up extends CI_Controller{
    public function __construct() {
        parent::__construct();
    }

    /**    
     *  AJAX验证学号    
     *  
     * @access public
    */
    public function checkNumber(){
    	$this->load->model('user_model');
    	$user_number = $this->input->post('user_number');
    	$data = $this->user_model->get_user($user_number);
    	if(empty($data))
    		echo true;
    	else
    		echo false;
    }

    /**    
     *  AJAX报名动作    
     *  
     * @access public
    */
    public function submitUser(){
            $this->load->model('user_model');
            $data = array();
            $data = (
                    'userName' => mysql_real_escape_string($this->input->post('userName')),
                    'userTelephone' => mysql_real_escape_string($this->input->post('userTelephone')),
                    'userQQ' => mysql_real_escape_string($this->input->post('userQQ')),
                    'userNumber' => mysql_real_escape_string($this->input->post('userNumber')),
                    'userMarjor' => mysql_real_escape_string($this->input->post('userMarjor')),
                    'userSex' => mysql_real_escape_string($this->input->post('userSex'))
                    );
            $user_id = $this->user_model->save_user($data);
            
            
            
    }
}