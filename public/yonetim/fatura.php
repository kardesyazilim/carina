<?php
require_once '../ez/shared/ez_sql_core.php';
require_once '../ez/mysql/ez_sql_mysql.php';
$db = new ezSQL_mysql('root','qweytr','dinamo_master','localhost','utf-8');

date_default_timezone_set('Europe/Istanbul');

include 'excel/Classes/PHPExcel/IOFactory.php';

$inputFileName = 'haziran_bizon.xls';

try {
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($inputFileName);
} catch (Exception $e) {
    die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) 
    . '": ' . $e->getMessage());
}
/*CREATE TABLE `invoice_config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_key` varchar(50) DEFAULT NULL,
  `invoice_value` varchar(50) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;*/
$sheet = $objPHPExcel->getSheet(0);
$highestRow = $sheet->getHighestRow();
$highestColumn = $sheet->getHighestColumn();
$data = array();
for ($row = 1; $row <= $highestRow; $row++) {
    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, 
    NULL, TRUE, FALSE);
    
    foreach($rowData[0] as $k=>$v)
        if($row !== 1){
                //echo "Row: ".$row."- Col: ".($k+1)." = ".$v."<br />";    
                
                //if(isset($v)){
                
                  $data[] = array('id' => $k+1 ,'value' => $v);
                  //geçici temp
                  if($k == '1'){
                    
                    $temp_data = explode("/", $v);
                    print_r($temp_data);
                    echo '------';
                  }
                  //
                //}isset($v)
                /*
                Row: 1- Col: 1 = Muhasebe hesap kodu ve adı 
                Row: 1- Col: 2 = Açıklama
                Row: 1- Col: 3 = Sorumluluk merkezi kodu ve adı
                Row: 1- Col: 4 = Borç
                Row: 1- Col: 5 = Alacak
                */
                
                //$configQuery = "insert into invoice_config (invoice_key,invoice_value,status) values('$v','$v','1')"; 
                //$db->query($configQuery);  
                //echo $configQuery;*/    
                $id = $k+1;
                $mikroTempQuery = "insert into temp_invoice_mikro (progsess_id,temp_value,temp_uniq_id) values ('$id','$v','1')";
                $db->query($mikroTempQuery);
                

        }//$row
        //progsess_id
        //temp_value
        //temp_uniq_id
}
print_r($data);

//$temp_data = ' Sat.fat : A-16390/30.06.2014//120.01.008/BİZON AĞAÇ SAN.TİC.AŞ. ';
//$temp_data = explode("/", $temp_data);
///print_r($temp_data);




?>