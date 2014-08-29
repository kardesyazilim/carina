<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once '../ez/shared/ez_sql_core.php';
require_once '../ez/mysql/ez_sql_mysql.php';
$db = new ezSQL_mysql('root','qweytr','dinamo_master','localhost','utf-8');

date_default_timezone_set('Europe/Istanbul');

setlocale(LC_MONETARY, 'tr_TR');
  setlocale(LC_CTYPE, 'tr_TR.UTF8');



  $fix = "select * from temp_invoice_dinamo_check ";
  $fix = $db->get_results($fix);
 foreach($fix as $f){
 	
 	$updateQuery = "update sonokuma set durum='1' where etsokodu='$f->etsokodu'";
 	$db->query($updateQuery);
 	echo 'ok';
 }