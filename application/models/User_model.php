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
	 	$result = $this->db->where(array('user_number'=>$user_number))->get('user');
	 	if($result->num_rows())
	 		return $result->row()->user_id;
	 	return 0;
	}

	public function user_sign_up($user, $section){
		$this->load->database();
		$result = $this->db->insert('user', $user);
		
		if($result){
			$a = $this->db->where(array('user_number'=>$user['user_number']))->get('user')->result_array();
			$user_id = $a[0]['user_id'];
                        
                        //插入角色——用户表
                        $this->db->insert('re_user_role', array(
                            'user_id' => $user_id,
                            'role_id' => -1,
                        ));
                        
			foreach($section as $v):
				if($v != 0){
					$re_user_section = array(
						"user_id" => $user_id,
						"section_id" => $v,
						"valid" => 0
					);
					$this->db->insert('re_user_section', $re_user_section);
				}
			endforeach;
			if ($user_id)
				return $user_id;
			else
				return false;
		}	
	}
}