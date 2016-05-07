<?php

define('IN_ECS', true);
define('INIT_NO_SMARTY', true);
define('CODEROOT_PATH', str_replace('code.php', '', str_replace('\\', '/', __FILE__)));
require(CODEROOT_PATH . 'cls_captcha.php');

$img = new captcha(CODEROOT_PATH . 'code/', "60", "20");
@ob_end_clean(); //清除之前出现的多余输入
$img->generate_image();
?>