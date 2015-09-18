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
class Fresh_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    
    /**    
    *  @Purpose:    
    * 面试官打分
    *     
    *  @Method Name:
    *  getRule
    *  @Parameter: 
    * 
    *  @Return: 
    *  
   */
    public function InterviewerScore($data) {
            $this->load->database();
            //$this->db->query("update re_user_section set score='$data[user_score]' where user_id='$data[user_id]' and section_id = '$data[section_id]' ");
            $this->db->where('user_id',$data['user_id']);
            $this->db->where('section_id',$data['section_id']);
            $this->db->from('re_user_section');
            $countRows = $this->db->count_all_results();
            if (1 != $countRows){
                if (0 == $countRows){
                    return 0;
                } else {
                    //删除多余志愿
                    $this->db->where('user_id', $data['user_id']);
                    $this->db->where('section_id', $data['section_id']);
                    $this->db->delete('re_user_section'); 

                    $this->db->insert('re_user_section', array(
                        'user_id' => $data['user_id'],
                        'section_id' => $data['section_id'],
                        'score'=>$data['user_score'],
                    ));
                    return $this->db->affected_rows();
                }
            } else {
                $this->db->where('user_id',$data['user_id']);
                $this->db->where('section_id',$data['section_id']);
                $this->db->update('re_user_section',array('score'=>$data['user_score']));
                return $this->db->affected_rows();
            }
    }

    /**    
     *  @Purpose:    
     *  导出新生名单列表
     *     
     *  @Method Name:
     *  getRule
     *  @Parameter: 
     * 
     *  @Return: 
     *  
    */
    public function dumpFreshList() {
        $this->load->database();
        $this->db->select('user.user_id, user.user_number, user.user_name, user.user_telephone, '
                . 'user.user_qq, user.user_major, user.user_sex, user.user_talent, re_user_section.section_id');
        $this->db->where('re_user_role.role_id = -1');
        $this->db->where('re_user_section.valid = 1');
        $this->db->where('re_user_section.user_id = re_user_role.user_id');
        $this->db->where('user.user_id = re_user_section.user_id');
        $this->db->from('re_user_role, re_user_section, user');
        return $this->db->get()->result_array();
    }
    
    /**
     * 获取部门录取总数
     * 
     * @access public
     * @param int $sectionId The id of section
     * @return int Sum of section accepted
     */
    public function getAcceptedSum($sectionId = 0){
        $this->load->database();
        $this->db->select('re_user_section.user_id');
        $this->db->where('re_user_role.role_id = -1');
        $this->db->where('re_user_section.valid = 1');
        $this->db->where('re_user_section.user_id = re_user_role.user_id');
        if ($sectionId != 0){
            $this->db->where('re_user_section.section_id', $sectionId);
        }
        $this->db->from('re_user_role, re_user_section');
        return $this->db->count_all_results();
    }
    
    /**
     * 获取待录取名单
     * 
     * @access public
     * @param int $sectionId The id of section
     * @return array List of fresh student to be accepted
     */
    public function getFreshAcceptList($sectionId = 0){
        $this->load->database();
        $this->db->select('re_user_section.user_id, re_user_section.valid, re_user_section.score, user.user_number, user.user_name, user.user_telephone, '
                . 'user.user_major, user.user_sex, user.user_talent');
        $this->db->where('re_user_role.role_id = -1');
        $this->db->where('user.user_th', date('Y') - 2002);
        $this->db->where('re_user_section.user_id = re_user_role.user_id');
        $this->db->where('re_user_section.user_id = user.user_id');
        $this->db->order_by('re_user_section.score', 'desc');
        $this->db->order_by('re_user_section.valid', 'esc');
        if ($sectionId != 0){
            $this->db->where('re_user_section.section_id', $sectionId);
        }
        return $this->db->get('re_user_role, re_user_section, user')->result_array();
    }
    
    /**
     * 切换录取状态
     * 
     * 
     * @access public
     * @param int $userId The id of user to toggle valid flag
     * @param int $sectionId The id of section with user
     * @param bool $toggle Accept or failed
     * @return bool Success of not
     */
    public function toggleValid($userId, $sectionId, $toggle){
        $this->load->database();
        $this->db->where('user_id', $userId);
        $this->db->where('section_id', $sectionId);
        $this->db->update('re_user_section', array(
            'valid' => $toggle,
        ));
        return $this->db->affected_rows();
    }
    
    
    /**
     * 选择部门
     * 
     * 
     * @access public
     * @param int $userId The id of user to choose section
     * @param int $sectionId The id of section with user
     * @return bool Success of not
     */
    public function chooseSection($userId, $sectionId){
        $this->load->database();
        $this->db->where('user_id', $userId);
        $this->db->where('section_id', $sectionId);
        $result = $this->db->get('re_user_section')->result_array();
        if (!count($result)){
            return 0;
        }
        $this->db->delete('re_user_section', array(
            'user_id' => $userId,
        ));
        
        $this->db->insert('re_user_section', array(
            'user_id' => $userId,
            'section_id' => $sectionId,
            'score' => $result[0]['score'],
            'valid' => 1,
        ));
        return $this->db->affected_rows();
    }
    
    /**
     * 获取各部门人数
     * 
     * 
     * @access public
     * @return array Fresh Sum of sections
     */
    public function getSectionFreshSum(){
        $this->load->database();
        $result = $this->db->query('SELECT section_id, count(*) as sum from re_user_section '
                . ' WHERE valid = 1 AND user_id IN'
                . '(SELECT user_id FROM re_user_role WHERE role_id = -1)  GROUP BY section_id');
        return $result->result_array();
    }
    
    /**
     * 获取需抢人的名单
     * 
     * 
     * @access public
     * @return array List of fresh to be battled
     */
    public function getFreshBattleUserInfoList(){
        $this->load->database();
        
        $result = $this->db->query('SELECT user_id, user_name, user_telephone, user_qq, user_major, user_talent, user_sex FROM user WHERE user_id IN (    SELECT `re_user_section`.`user_id` FROM `re_user_section`, `re_user_role` '
                . 'WHERE `re_user_role`.`role_id` = -1 AND `re_user_section`.`valid` = 1 AND `re_user_section`.`user_id` = `re_user_role`.`user_id` '
                . 'GROUP BY `re_user_section`.`user_id` HAVING count("re_user_section.user_id") > 1)');
//        $this->db->select('re_user_section.user_id');
//        $this->db->where('re_user_role.role_id', -1);
//        $this->db->where('re_user_section.valid', 1);
//        $this->db->where('re_user_section.user_id=re_user_role.user_id');
//        $this->db->group_by('re_user_section.user_id');
//        $this->db->having('count("re_user_section.user_id") > 1');
//        $this->db->from('re_user_section, re_user_role');
        return $result->result_array();
    }
    
    /**
     * 获取需抢人的部门
     * 
     * 
     * @access public
     * @param array $userList List of fresh to be battled
     * @return array List of section to be battled
     */
    public function getSectionBattleList($userList){
        $this->load->database();
        $this->db->where_in('user_id', $userList);
        return $this->db->get('re_user_section')->result_array();
    }
}