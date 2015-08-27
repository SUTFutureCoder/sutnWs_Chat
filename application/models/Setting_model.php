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

    public function __construct() {
        parent::__construct();
    }
    
    public function set($cacheName,array $array){
        $this->load->driver('cache');
        $this->cache->redis->save(self::$redis_prefix . $cacheName, $array, $array['expire_time']);
    }
    
    public function get($cacheName){
        $this->load->driver('cache');
        $this->cache->redis->get(self::$redis_prefix . $cacheName);
    }
    
    public function remove($cacheName){
        $this->load->driver('cache');
        $this->cache->redis->delete(self::$redis_prefix . $cacheName);
    }
}