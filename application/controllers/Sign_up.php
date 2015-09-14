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
     *  AJAX报名动作    
     *  
     * @access public
    */
    public function submitUser(){
            $this->load->model('user_model');
            $this->load->library('session');
            $this->load->helper('url');
            $user_info = array(
                    'user_name' => $this->input->post('userName', TRUE),
                    'user_telephone' => $this->input->post('userTelephone', TRUE),
                    'user_qq' => $this->input->post('userQQ', TRUE),
                    'user_number' => $this->input->post('userNumber', TRUE),
                    'user_major' => $this->input->post('userMajor', TRUE),
                    'user_sex' => $this->input->post('userSex', TRUE),
                    'user_talent' => $this->input->post('user_talent', TRUE),
                    'user_reg_time' => date('Y-m-d H:i:s'),
                    'user_th' => date('Y') - 2002
                );
            if($this->input->post('validatecode', TRUE) == NULL){
                echo json_encode(array('code' => -1,  'message' => "验证码不能为空"));
                exit();
            }
             if(strtolower($this->input->post('validatecode', TRUE)) !=  strtolower($this->session->userdata('authnum_session'))){
                echo json_encode(array('code' => -2,  'message' => "验证码不正确"));
                exit();
            }
            if($user_info['user_name'] == NULL){
                echo json_encode(array('code' => -3,  'message' => "姓名不能为空"));
                exit();
            }
             if(10 < iconv_strlen($user_info['user_name'])){
                echo json_encode(array('code' => -4,  'message' => "姓名不能超过10个字符"));
                exit();
            }
            if(11 != strlen($user_info['user_telephone']) || !ctype_digit($user_info['user_telephone'])){
                echo json_encode(array('code' => -5,  'message' => "联系方式不合法,必须为11位数字"));
                exit();
            }
            if($user_info['user_qq'] == NULL){
                echo json_encode(array('code' => -6,  'message' => "qq不能为空"));
                exit();
            }
            if(16 < strlen($user_info['user_qq']) || !ctype_digit($user_info['user_qq'])){
                echo json_encode(array('code' => -7,  'message' => "qq号应为小于16位的纯数字组合"));
                exit();
            }
            if($user_info['user_number'] == NULL){
                echo json_encode(array('code' => -8, 'message' => '学号不能为空'));
                exit();
            }
            if(9 != strlen($user_info['user_number'])  || !ctype_digit($user_info['user_number'])){
                echo json_encode(array('code' => -9, 'message' => "学号应为9位纯数字组合"));
                exit();
            }
            if($this->user_model->get_user($user_info['user_number'])){
                echo json_encode(array('code' => -10, 'message' => "检测到学号重复"));
                exit();
            }
            if($user_info['user_major'] == NULL){
                echo json_encode(array('code' => -11, 'message' => '专业不能为空'));
                exit();
            }
            if(20 < iconv_strlen($user_info['user_major'])){
                echo json_encode(array('code' => -12, 'message' => '专业不能超过20个字符'));
                exit();
            }
            if($user_info['user_sex'] == NULL){
                echo json_encode(array('code' => -13, 'message' => '性别不能为空'));
                exit();
            }
            if(1 != strlen($user_info['user_sex']) || !ctype_digit($user_info['user_sex'])){
                echo json_encode(array('code' => -14, 'message' => '性别不合法'));
                exit();
            }
            if(398 < iconv_strlen($user_info['user_talent'])){
                echo json_encode(array('code' => -15, 'message' => '特长不能超过389个字符'));
                exit();
            }
            $user_sec_info = array(
                    'userFirstSection' => $this->input->post('userFirstSection', TRUE),
                    'userSecondSection' => $this->input->post('userSecondSection', TRUE),
                    'userThirdSection' => $this->input->post('userThirdSection', TRUE)
                    );
             if($user_sec_info['userFirstSection'] == NULL){
                echo json_encode(array('code' => -16, 'message' => '第一志愿不能为空'));
                exit();
            }
           $user_id = $this->user_model->user_sign_up($user_info, $user_sec_info);
             if($user_id ){
                $salt = 'sutnws';
                $filename = md5($salt.$user_id.$salt);
                $url = base_url().'pqcode/'.$filename.'.png';
                
                $text = site_url().'/interviewer/index?user_id='.$user_id.'&userName='.urlencode($user_info['user_name']).'&userTelephone='.$user_info['user_telephone'].'&userQQ='.$user_info['user_qq'].'&userNumber='.$user_info['user_number'].'&userMajor='.urlencode($user_info['user_major']).'&userSex='.$user_info['user_sex'].'&user_talent='.urlencode($user_info['user_talent']).'&userFirstSection='.$user_sec_info['userFirstSection'].'&userSecondSection='.$user_sec_info['userSecondSection'].'&userThirdSection='.$user_sec_info['userThirdSection'];

                $result = $this->create_QRCode($text, $filename);
                if($result){
                    $data = array(
                        'code' => 1,
                        'url' => $url,
                        'user_id' => $user_id,
                        'message' => '报名成功'
                    );
                    echo json_encode($data);
                }else
                    echo json_encode(array('code' => -17, 'user_id' => $user_id, 'message' => '二维码生成失败'));
            }else
                echo json_encode(array('code' => -18,  'message' => '报名添加失败'));
    }

    /**    
     *  生成二维码图片    
     *  
     * @access private
    */
    private function create_QRCode($text, $filename){
        require(BASEPATH.'libraries/Phpqrcode.php');
        $outfile = $filename.'.png';//是否输出二维码图片 文件
        $level = "M";//容错率
        $size = 4;//表示生成图片大小
        $margin = 4;//二维码周围边框空白区域间距值
        $saveandprint = false;//是否保存二维码并显示
        QRcode::png($text, $outfile, $level, $size, $margin, $saveandprint);
        $newfile = FCPATH.'pqcode/'.$outfile; 
        $result = rename($outfile,$newfile);
        if(file_exists($newfile)&&$result)
            return true;
        else
            return false;
    }

    /**    
     *  上传文件    
     *  
     * @access public
    */
    public function ajaxFileUpload(){
        $path = FCPATH.'file_upload/';
        $config = array(
            'upload_path' => $path,
            'allowed_types' => 'gif|jpg|png',
            'max_size' => 51200,
            'file_name' => $this->input->post('file_user_number')
            );
        $this->load->library('upload',$config);
        $arr = explode('.', $_FILES["file"]["name"]);
        $_file = end($arr);
        $aimurl = $path.$config['file_name'].'.'.$_file;
        if (file_exists($aimurl)) { 
                        unlink($aimurl);
        }
        $this->upload->do_upload('file');
        header('Content-Type:text/html;charset=utf-8');
        if(!file_exists($aimurl)){
            echo "<script>alert('文件上传失败');</script>";
        }else{
            echo "<script>alert('文件上传成功');</script>";
        }
    }
}