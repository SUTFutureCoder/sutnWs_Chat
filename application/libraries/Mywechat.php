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
include APPPATH . 'libraries/Wechatex.php';
class Mywechat extends WechatEx{
    private $_ci;
    public function __construct($options) {
        parent::__construct($options);
        if (function_exists('get_instance')){
            $this->_ci =& get_instance();
        }
        $this->onVoice();
    }
    
    protected function onSubscribe() {
        $this->text('终于等到你。感谢你关注....')->reply();
    }
    
    protected function onUnsubscribe() {
        $this->text('悄悄地我走了，正如我悄悄地来。')->reply();
    }
    
    protected function onText() {
        parent::onText();
    }
    
    protected function onLocation() {
        $info = $this->getRevGeo();
        $this->text("收到了位置消息：({$info['x']},{$info['y']})")->reply();
    }
    
    protected function onLink() {
        $info = $this->getRevLink();
        $url = $info['url'];
        $this->text("收到链接消息：({$info['url']},{$info['title']},{$info['description']})")->reply();
    }
    
    protected function onVoice() {
        $this->_ci->load->library('session');
        $this->_ci->session->set_userdata('test', 'testtest');
        echo $this->_ci->session->userdata('test');
        $info = $this->getRevVoice();
        $this->text("收到链接消息：({$info['mediaid']},{$info['format']})")->reply();
    }
    
    protected function onUnknown() {
        $this->text('收到未知消息')->reply();
    }
    
    //以下是cache的保存，按照具体情况保存cache，因为微信服务器规定token的获取次数是有限制的，不要请求太多次数。
    protected function setCache($cachename, $value, $expired) {
        $this->_ci->load->model('setting_model', 'setting');
        $this->_ci->setting->set($cachename, array(
            'value' => $value,
            'expire_time' => time() + $expired,
        ));
    }
    
    protected function getCache($cachename) {
        $this->_ci->load->model('setting_model', 'setting');
        $data = $this->_ci->setting->get($cachename);
        if (empty($data) || time() > $data['expire_time']){
            return false;
        }
        return $data['value'];
    }
    
    protected function removeCache($cachename) {
        $this->_ci->load->model('setting_model', 'setting');
        $this->_ci->setting->remove($cachename);
    }
    
    //微信具体逻辑写到此处
}