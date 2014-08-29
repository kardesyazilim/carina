<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
date_default_timezone_set('Europe/Istanbul');
header ('Content-type: text/html; charset=utf-8');

session_start();
ob_start();

$betik_zd = date_default_timezone_get();
$q = isset($_GET ['q']) ? $_GET ['q'] : null;
$q = rtrim($q, '/');
$q = explode('/', $q);
define('DOMAIN','https://www.dinamoelektrik.com/');


if( !isset($_SESSION['website'])){
	//ilk açılış ise
	$_SESSION['website'] = 'bireysel';
	header("Location: ".DOMAIN.$q[0]);
}
else{
	if($q[0] == 'bireysel'){
    	$_SESSION['website'] = 'bireysel';
	}
	else if($q[0] == 'kurumsal'){
    	$_SESSION['website'] = 'kurumsal';
	}

}

require_once 'apps/core/shared/ez_sql_core.inc';
require_once 'apps/core/mysql/ez_sql_mysql.inc';

$db = new ezSQL_mysql('root','qweytr','dinamo_master','localhost','utf-8');
if($q[0] == 'yonetim'){
	//admininstrator page
	/*if($_SESSION){
		echo 'security';

	}
	else{*/
		//echo 'login page';
		echo file_get_contents('apps/admin/html/header.inc');
		echo file_get_contents('apps/admin/html/login.inc');
		echo file_get_contents('apps/admin/html/footer.inc');

	//}
}
else{
	require_once 'apps/frontend/dinamo/html/header.inc';
	require_once 'apps/frontend/dinamo/html/header-nav.inc';
	require_once 'apps/frontend/dinamo/html/nav.inc';
	if($q[0] =='kurumsal-hemen-basvur'){
		require_once 'apps/frontend/dinamo/html/kurumsal-hemen-basvur.inc';
	}
	else if($q[0] == 'bireysel-hemen-basvur'){
		require_once 'apps/frontend/dinamo/html/bireysel-hemen-basvur.inc';
	}
	else{
		require_once 'apps/frontend/dinamo/html/center.inc';
	}
	require_once 'apps/frontend/dinamo/html/footer.inc';

}

/*
function tckimlik($tckimlik){ 
    $olmaz=array('11111111110','22222222220','33333333330','44444444440','55555555550','66666666660','7777777770','88888888880','99999999990'); 
    if($tckimlik[0]==0 or !ctype_digit($tckimlik) or strlen($tckimlik)!=11){ return false;  } 
    else{ 
        for($a=0;$a<9;$a=$a+2){ $ilkt=$ilkt+$tckimlik[$a]; } 
        for($a=1;$a<9;$a=$a+2){ $sont=$sont+$tckimlik[$a]; } 
        for($a=0;$a<10;$a=$a+1){ $tumt=$tumt+$tckimlik[$a]; } 
        if(($ilkt*7-$sont)%10!=$tckimlik[9] or $tumt%10!=$tckimlik[10]){ return false; } 
        else{  
            foreach($olmaz as $olurmu){ if($tckimlik==$olurmu){ return false; } } 
            return true; 
        } 
    } 
} 
if(tckimlik('11111111110')){ echo 'Tc Kimlik Numarası doğru!'; } else { echo 'Lütfen geçerli bir Tc Kimlik Numarası giriniz...'; } 
*/