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
class Index extends CI_Controller{
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        include __DIR__ . '/../libraries/LaneWeChat/wechat.php';
    }


    public function api(){
        include __DIR__ . '/../libraries/LaneWeChat/lanewechat.php';
        $menuList = LaneWeChat\Core\Menu::getMenu();
    }
}