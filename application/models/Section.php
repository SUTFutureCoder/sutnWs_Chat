<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * 用于获取部门等信息
 * 
 * 
 *
 * @copyright  版权所有(C) 2014-2015 沈阳工业大学ACM实验室 沈阳工业大学网络管理中心 *Chen
 * @license    http://www.gnu.org/licenses/gpl-3.0.txt   GPL3.0 License
 * @version    
 * @link       https://github.com/SUTFutureCoder/
*/
class Section extends CI_Model{
    private $redisSectionList = 'nwsapp_section_list';


    public function __construct() {
        parent::__construct();
    }
    
    /**
     * 获取部门
     * 
     * @access public
     * @return array 部门列表
     */
    public function getSectionList(){
        $this->load->database();
        $this->load->library('myredis');
        $data = array();
        if (!$data = unserialize($this->myredis->get($this->redisSectionList))){
            $result = $this->db->get('section');
            foreach ($result->result_array() as $row){
                $data[] = $row;
            }
            $this->myredis->set($this->redisSectionList, serialize($data));
        }
        return $data;
    }
}