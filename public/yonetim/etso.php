<?php


error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once '../ez/shared/ez_sql_core.php';
require_once '../ez/mysql/ez_sql_mysql.php';
$db = new ezSQL_mysql('root','qweytr','dinamo_master','localhost','utf-8');

date_default_timezone_set('Europe/Istanbul');

setlocale(LC_MONETARY, 'tr_TR');
setlocale(LC_CTYPE, 'tr_TR.UTF8');

$query = "select etsokodu from temp_invoice_dinamo_check";
$result = $db->get_results($query);
$etsocodes = array();
foreach($result as $item) {
  $etsocodes[] = $item->etsokodu;
}
echo implode("\n", $etsocodes);