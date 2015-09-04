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
class Setting_model extends CI_Model{
    private static $redis_prefix = 'sutnws_token_';

    private $_ci;
    public function __construct() {
        parent::__construct();
        $this->_ci =& get_instance();
    }
    
    public function set($cacheName,array $array){
        $this->_ci->load->library('myredis');
        return $this->_ci->myredis->set(self::$redis_prefix . $cacheName, serialize($array), $array['expire_time']);
    }
    
    public function get($cacheName){
        $this->_ci->load->library('myredis');
        $result = $this->_ci->myredis->get(self::$redis_prefix . $cacheName);
        return unserialize($result);
    }
    
    public function remove($cacheName){
        $this->_ci->load->library('myredis');
        return $this->_ci->myredis->delete($cacheName);
    }
}