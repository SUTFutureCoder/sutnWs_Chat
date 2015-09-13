<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * 导出名单
 * 
 * 
 *
 * @copyright  版权所有(C) 2014-2015 沈阳工业大学ACM实验室 沈阳工业大学网络管理中心 *Chen
 * @license    http://www.gnu.org/licenses/gpl-3.0.txt   GPL3.0 License
 * @version    
 * @link       https://github.com/SUTFutureCoder/
*/
class Dump_list extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * 显示导出名单界面
     * 
     * @access public
     * @param 
     * @return 
     */
    public function index(){
        $this->load->helper('url');
        $this->load->view('dump_list_login');
    }
    
    /**    
    *  检查密码
    *  
    * @access public
   */
   public function checkPwd() {
        $this->load->helper('url');
        $this->load->library('session');
        $dumpPwd = $this->input->post('dumpPwd', TRUE);
        if(!isset($dumpPwd) || $dumpPwd != 'nws' . date('Ydm')) {
                self::index();
        } else {
            echo true;
            $this->session->set_userdata('dumpAccess', 1);
        }
   }
    
    /**    
    *  导出列表
    *  
    * @access public
   */
   public function dumpFreshAll() {
        $this->load->library('session');
        $this->load->library('phpexcel');
        $this->load->model('section');
        $this->load->model('user_model'); 
        $this->load->model('fresh_model');
        if($this->session->userdata('dumpAccess')){
            $sectionList = $this->section->getSectionList();
            $freshList = $this->fresh_model->dumpFreshList();
            $objPHPExcel = new PHPExcel();
            $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);     

            $clean['file_name'] = (date('Y') - 2002) . '届网管中心招新名单.xls';


            $objPHPExcel->getProperties()->setCreator('SUTNWS')
                ->setTitle((date('Y') - 2002) . '届网管中心招新名单.xls');

            $objPHPExcel->createSheet(0);
            $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet()->setTitle('总览');

            $objPHPExcel->createSheet(1);
            $objPHPExcel->setActiveSheetIndex(1);
            $objPHPExcel->getActiveSheet()->setTitle('宣传部');
            
            
            $objPHPExcel->createSheet(2);
            $objPHPExcel->setActiveSheetIndex(2);
            $objPHPExcel->getActiveSheet()->setTitle('外联部');
            
            $objPHPExcel->createSheet(3);
            $objPHPExcel->setActiveSheetIndex(3);
            $objPHPExcel->getActiveSheet()->setTitle('采编部');
            
            $objPHPExcel->createSheet(4);
            $objPHPExcel->setActiveSheetIndex(4);
            $objPHPExcel->getActiveSheet()->setTitle('策划部');
            
            $objPHPExcel->createSheet(5);
            $objPHPExcel->setActiveSheetIndex(5);
            $objPHPExcel->getActiveSheet()->setTitle('影音部');
            
            $objPHPExcel->createSheet(6);
            $objPHPExcel->setActiveSheetIndex(6);
            $objPHPExcel->getActiveSheet()->setTitle('技术部');
            
            //部员计数器
            $sectionCounter['person'] = array(
                '1' => 0,
                '2' => 0,
                '3' => 0,
                '4' => 0,
                '5' => 0,
                '6' => 0,
            );
            
            //性别计数器
            $sectionCounter['sex'] = array(
                0 => 0,
                1 => 0,
            );
            
            foreach ($freshList as $freshListValue){
                //切换部门标签卡
                $objPHPExcel->setActiveSheetIndex($freshListValue['section_id']);
                if (empty($sectionCounter['person'][$freshListValue['section_id']])){
                    $sectionCounter['person'][$freshListValue['section_id']]++;
                } else {
                    $sectionCounter['person'][$freshListValue['section_id']] = 1;
                }
                
                $i = $sectionCounter['person'][$freshListValue['section_id']] + 1;
                
                //第一列
                $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $i - 1);

                //第二列
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $freshListValue['user_id']);

                //第三列
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $freshListValue['user_number']);

                //第四列
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $freshListValue['user_name']);

                //第五列
                $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $freshListValue['user_telephone']);

                //第六列
                $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $freshListValue['user_qq']);

                //第七列
                $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $freshListValue['user_major']);

                switch ($freshListValue['user_sex']){
                    case 0:
                        $sectionCounter['sex'][$freshListValue['user_sex']]++;
                        $freshListValue['user_sex'] = '男';
                        break;
                    case 1:
                        $sectionCounter['sex'][$freshListValue['user_sex']]++;
                        $freshListValue['user_sex'] = '女';
                        break;
                    case 2:
                        $freshListValue['user_sex'] = '其他';
                        break;
                    case 3:
                        $freshListValue['user_sex'] = '保密';
                        break;
                }
                //第八列
                $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $freshListValue['user_sex']);

                //第九列
                $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, $freshListValue['user_talent']);

                //设置高度
                $objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(30);

                //居中
                $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('B' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('C' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('D' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('E' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('F' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('G' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('H' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('I' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            }
                
            
            
            for ($i = 1; $i <= 6; $i++){
                $objPHPExcel->setActiveSheetIndex($i);
                $objPHPExcel->getActiveSheet()->setCellValue('A1', '#');
                $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->setCellValue('B1', '编号');
                $objPHPExcel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->setCellValue('C1', '学号');
                $objPHPExcel->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->setCellValue('D1', '姓名');
                $objPHPExcel->getActiveSheet()->getStyle('D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->setCellValue('E1', '手机');
                $objPHPExcel->getActiveSheet()->getStyle('E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->setCellValue('F1', 'QQ');
                $objPHPExcel->getActiveSheet()->getStyle('F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->setCellValue('G1', '专业');
                $objPHPExcel->getActiveSheet()->getStyle('G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->setCellValue('H1', '性别');
                $objPHPExcel->getActiveSheet()->getStyle('H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->setCellValue('I1', '特长');
                $objPHPExcel->getActiveSheet()->getStyle('I1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
                
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(5);
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
                $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(5);
                $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
            }

                $objPHPExcel->setActiveSheetIndex(0);            
                $objPHPExcel->getActiveSheet()->setCellValue('A1', '总人数');
                $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

                $objPHPExcel->getActiveSheet()->setCellValue('B1', array_sum($sectionCounter['person']));
                $objPHPExcel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $objPHPExcel->getActiveSheet()->setCellValue('A3', '宣传部');
                $objPHPExcel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);

                $objPHPExcel->getActiveSheet()->setCellValue('B3', $sectionCounter['person']['1']);
                $objPHPExcel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                
                $objPHPExcel->getActiveSheet()->setCellValue('A4', '外联部');
                $objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A4')->getFont()->setBold(true);

                $objPHPExcel->getActiveSheet()->setCellValue('B4', $sectionCounter['person']['2']);
                $objPHPExcel->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                
                $objPHPExcel->getActiveSheet()->setCellValue('A5', '采编部');
                $objPHPExcel->getActiveSheet()->getStyle('A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A5')->getFont()->setBold(true);

                $objPHPExcel->getActiveSheet()->setCellValue('B5', $sectionCounter['person']['3']);
                $objPHPExcel->getActiveSheet()->getStyle('B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                
                $objPHPExcel->getActiveSheet()->setCellValue('A6', '策划部');
                $objPHPExcel->getActiveSheet()->getStyle('A6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A6')->getFont()->setBold(true);

                $objPHPExcel->getActiveSheet()->setCellValue('B6', $sectionCounter['person']['4']);
                $objPHPExcel->getActiveSheet()->getStyle('B6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                
                $objPHPExcel->getActiveSheet()->setCellValue('A7', '影音部');
                $objPHPExcel->getActiveSheet()->getStyle('A7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A7')->getFont()->setBold(true);

                $objPHPExcel->getActiveSheet()->setCellValue('B7', $sectionCounter['person']['5']);
                $objPHPExcel->getActiveSheet()->getStyle('B7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                
                $objPHPExcel->getActiveSheet()->setCellValue('A8', '技术部');
                $objPHPExcel->getActiveSheet()->getStyle('A8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A8')->getFont()->setBold(true);

                $objPHPExcel->getActiveSheet()->setCellValue('B8', $sectionCounter['person']['6']);
                $objPHPExcel->getActiveSheet()->getStyle('B8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                
                $objPHPExcel->getActiveSheet()->setCellValue('A10', '男部员');
                $objPHPExcel->getActiveSheet()->getStyle('A10')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A10')->getFont()->setBold(true);

                $objPHPExcel->getActiveSheet()->setCellValue('B10', $sectionCounter['sex'][0]);
                $objPHPExcel->getActiveSheet()->getStyle('B10')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                
                $objPHPExcel->getActiveSheet()->setCellValue('A11', '女部员');
                $objPHPExcel->getActiveSheet()->getStyle('A11')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A11')->getFont()->setBold(true);

                $objPHPExcel->getActiveSheet()->setCellValue('B11', $sectionCounter['sex'][1]);
                $objPHPExcel->getActiveSheet()->getStyle('B11')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $objPHPExcel->getActiveSheet()->setCellValue('A13', '生成时间');
                $objPHPExcel->getActiveSheet()->getStyle('A13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A13')->getFont()->setBold(true);

                $objPHPExcel->getActiveSheet()->setCellValue('B13', date('Y-m-d H:i:s'));
                $objPHPExcel->getActiveSheet()->getStyle('B13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);

                header("Content-Type: application/force-download");  
                header("Content-Type: application/octet-stream");  
                header("Content-Type: application/download");  
                header('Content-Disposition:inline;filename="' . $clean['file_name'] . '"');  
                header("Content-Transfer-Encoding: binary");  
                header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");  
                header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");  
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");  
                header("Pragma: no-cache");  
                $objWriter->save('php://output');
            }
   }

}