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
class User_model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function get_user($user_number){
		$this->load->database();
		$result = $this->db->get_where('user', array('user_number' => $user_number));
		return $result->result_array();
	}

	public function save_user($data){
		$this->load->database();
		return $this->db->insert_id('user', $data);	
	}

}