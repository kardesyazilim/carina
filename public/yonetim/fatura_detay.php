<?php
session_start();
ob_start();
//var_dump($_POST);
if($_POST){

require_once '../ez/shared/ez_sql_core.php';
require_once '../ez/mysql/ez_sql_mysql.php';
$db = new ezSQL_mysql('root','qweytr','dinamo_master','localhost','utf-8');

date_default_timezone_set('Europe/Istanbul');

$etsokodu = $_POST['etsokodu'];
$sayacid = $_POST['sayacid'];
$cityname = $_POST['cityname'];
$tuketimmiktari = $_POST['tuketimmiktari'];
$tarifename = $_POST['tarifename'];
$tarifedesc = $_POST['tarifedesc'];
$tarifedinamo = $_POST['tarifedinamo'];
$dinamoindirim = $_POST['dinamoindirim'];
$dinamosayac = $_POST['dinamosayac'];
$cariname = $_POST['cariname'];
$faturaemail = $_POST['faturaemail'];
$faturaadres = $_POST['faturaadres'];
$carikodu = $_POST['carikodu'];


$checkIvoice = "select * from temp_invoice_dinamo_check where etsokodu='$etsokodu'";
//burası ikinci seferde düzeltilecek
$checkIvoice = $db->get_row($checkIvoice);
if($checkIvoice){
echo 'no';
}
else{

$temp_invoice_dinamo_check = "insert into temp_invoice_dinamo_check (etsokodu,sayacid,cityname,tuketimmiktari,tarifename,tarifedesc,tarifedinamo,dinamoindirim,dinamosayac,cariname,faturaemail,faturaadres,carikodu) values ('$etsokodu','$sayacid','$cityname','$tuketimmiktari','$tarifename','$tarifedesc','$tarifedinamo','$dinamoindirim','$dinamosayac','$cariname','$faturaemail','$faturaadres','$carikodu')";
$db->query($temp_invoice_dinamo_check);
$update_query = "update temp_pmum_okuma set status='1' where etso_kodu='$etsokodu'";
$db->query($update_query);
$_SESSION['etsokodu'] = $etsokodu;
echo 'ok';	
}

}