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
    	$user_number = $this->input->post('number');
    	$data = $this->user_model->get_user($user_number);
    	if(empty($data))
    		echo true;
    	else
    		echo false;
    }

    /**    
     *  AJAX验证验证码 
     *  
     * @access public
    */
    public function checkValidatecode(){
        $this->load->library('session');
        $validatecode = $this->input->post('validatecode');
        if(strtolower($validatecode) !=  strtolower($this->session->userdata('authnum_session')))
            echo false;
       else
            echo true;
    }

    /**    
     *  AJAX报名动作    
     *  
     * @access public
    */
    public function submitUser(){
            $this->load->model('user_model');
            $user_info = array(
                    'user_name' => mysql_real_escape_string($this->input->post('userName')),
                    'user_telephone' => mysql_real_escape_string($this->input->post('userTelephone')),
                    'userQQ' => mysql_real_escape_string($this->input->post('userQQ')),
                    'user_number' => mysql_real_escape_string($this->input->post('userNumber')),
                    'user_marjor' => mysql_real_escape_string($this->input->post('userMarjor')),
                    'user_sex' => mysql_real_escape_string($this->input->post('userSex'))
                    );
            $user_sec_info = array(
                    'userFirstSection' => mysql_real_escape_string($this->input->post('userFirstSection')),
                    'userSecondSection' => mysql_real_escape_string($this->input->post('userSecondSection')),
                    'userThirdSection' => mysql_real_escape_string($this->input->post('userThirdSection'))
                    );

            $user_id = $this->user_model->user_sigin_up($user_info, $user_sec_info);
            if($result){
                $url = base_url().'/qpcode/'.$user_id.'png';
                $text = site_url().'/interviemer/index?user_id='.$user_id.'?user_name='.$user_info['user_name'].'?user_telephone='.$user_info['user_telephone'].'?userQQ='.$user_info['userQQ'].'?user_number='.$user_info['user_number'].'?user_marjor='.$user_info['user_marjor'].'?user_sex='.$user_info['user_sex'];
                $this->create_QRCode($text, $user_id);
                $data = array(
                    'url' => $url,
                    'user_id' => $user_id
                    );
                echo json_encode($data);
            }else
                echo fasle;      
    }

    /**    
     *  生成二维码图片    
     *  
     * @access private
    */
    private function create_QRCode($text, $filename){
        require_once(BASEPATH.'libraries/Phpqrcode.php');
        $outfile = 'qpcode/'.$filename.'png';//是否输出二维码图片 文件
        $level = "M";//容错率
        $size = 4;//表示生成图片大小    
        $margin = 4;//二维码周围边框空白区域间距值
        $saveandprint = fasle;//是否保存二维码并显示
        QRcode::png($text, $outfile, $level, $size, $margin, $saveandprint);
        if(file_exists($outfile))
            return true;
        else
            return fasle;
    }
}