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
$config['wechat'] = array(
    'token'=>'sutnws', //填写你设定的key
    'appid'=>'wx10ed9fdae2987dd0', //填写高级调用功能的app id
    'appsecret'=>'0ddbd5bb920d17e16a4c5601317ba2c9', //
 
    'partnerid'=>'88888888', //财付通商户身份标识
    'partnerkey'=>'', //财付通商户权限密钥Key
    'paysignkey'=>'', //商户签名密钥Key
    'debug'=>true
);

$config['wechat_menu'] = array(
    'button' => array(
        array(
            'type'  => 'pic_photo_or_album',
            'name'  => '我卖',
            'key'   => 'upload_pics',
        ),
        
        array(
            'type'  => 'view',
            'name'  => '逛逛',
            'url'   => 'www.baidu.com',
        ),
        
        array(
            'name'  => '我的',
            'sub_button' => array(
                array(
                    'type'  => 'view',
                    'name'  => '正在出售',
                    'url'   => 'www.baidu.com',
                ),
                array(
                    'type'  => 'view',
                    'name'  =>'个人中心',
                    'url'   => 'www.baidu.com',
                ),
                array(
                    'type'  => 'view',
                    'name'  => '帮助',
                    'url'   => 'www.baidu.com',
                ),
            ),
        ),
    ),
);