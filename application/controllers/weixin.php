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
class Weixin extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->config->load('wechat');
        $options = $this->config->item('wechat');
        $options['logcallback'] = 'logdebug';
        $this->load->library('mywechat', $options);
    }
    
    public function api(){
        $this->mywechat->run();
    }
    
    public function menu(){
        $menus = $this->config->item('wechat_menu');
        $flag = $this->mywechat->createMenu($menus);
        echo !$flag ? 'FALSE' : json_encode($menus);
    }
    
    //其他逻辑
}

function logdebug($text){
    file_put_contents('./upload/log.txt', $text . PHP_EOL, FILE_APPEND);
}