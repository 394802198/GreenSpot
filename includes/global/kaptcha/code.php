<?php

define('IN_ECS', true);
define('INIT_NO_SMARTY', true);
define('CODEROOT_PATH', str_replace('code.php', '', str_replace('\\', '/', __FILE__)));
require(CODEROOT_PATH . 'cls_captcha.php');

$img = new captcha(CODEROOT_PATH . 'code/', "60", "20");
@ob_end_clean(); //���֮ǰ���ֵĶ�������
$img->generate_image();
?>