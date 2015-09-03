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
class Myredis{
    private static $redis;
    
    public function __construct() {
        $redis = new Redis();
        self::$redis = $redis->connect('127.0.0.1', 6379);
    }
    
    public function getInstance(){
        if (!isset(self::$redis)){
            $redis = new Redis();
            self::$redis = $redis->connect('127.0.0.1', 6379);
        }
        return self::$redis;
    }
    
    public function set($key, $value, $expired = 0){
        if (!isset(self::$redis)){
            $this->getInstance();
        }
        if ($expired){
            return self::$redis->setex($key, $expired, $value);
        } else {
            return self::$redis->set($key, $value);
        }
    }
    
    
    public function get($key){
        if (!isset(self::$redis)){
            self::$redis = $this->getInstance();
        }
        return self::$redis->get($key);
    }
    
    public function delete($key){
        if (!isset(self::$redis)){
            $this->getInstance();
        }
        return self::$redis->delete($key);
    }
}