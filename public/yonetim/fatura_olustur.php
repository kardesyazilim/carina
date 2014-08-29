<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Fatura Kontrol Ekranı</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="//cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.css">
</head>
<body>
<!--<div id="faturaonaybody">
<div class="container">
<div class="row">
<div class="col-lg-12">
<div class="table-responsive">
  <table class="table">
   <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Müşteri (Sayaç)</th>
          <th>ETSO Kodu</th>
          <th>Sayaç No</th>
          <th>Fatura No</th>
          <th>Durum</th>
          <th>Çekiş Mwh</th>
          <th>İndirim Oranı</th>
          <th>Okunma Tarihi</th>
          <th>Son Ödeme Tarihi</th>
          <th>İşlem</th>

        </tr>
      </thead>
      <tbody>
        <tr class="active">
          <td>1</td>
          <td>Column content</td>
          <td>Column content</td>
          <td>Column content</td>
          <td>Column content</td>
          <td>Column content</td>
          <td>1</td>
          <td>Column content</td>
          <td>Column content</td>
          <td>Column content</td>
          <td>Column content</td>

        </tr>
      </tbody>
    </table>
  </table>
</div>
</div>
</div>
</div>
</div>-->
<?php

require_once '../ez/shared/ez_sql_core.php';
require_once '../ez/mysql/ez_sql_mysql.php';
$db = new ezSQL_mysql('root','qweytr','dinamo_master','localhost','utf-8');

date_default_timezone_set('Europe/Istanbul');

//include 'excel/Classes/PHPExcel/IOFactory.php';

/*$inputFileName = 'sayac_okumalari.xlsx';

try {
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($inputFileName);
} catch (Exception $e) {
    die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) 
    . '": ' . $e->getMessage());
}*/
/*CREATE TABLE `invoice_config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_key` varchar(50) DEFAULT NULL,
  `invoice_value` varchar(50) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;*/

/*
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
                

        }//$row
        //progsess_id
        //temp_value
        //temp_uniq_id
}

*/



//epdk auto 

//Görevli Tedarik Şirketinden Enerji Alan İletim Sistemi Kullanıcısı Tüketiciler 

//Sanayi

//Çift Terimli Sanayi

//Tek Terimli Sanayi

//Orta Gerilim 

//Alçak Gerilim
//Ticarethane

//Mesken
//Şehit Aileleri ve Muharip Malul Gaziler





//
//
//

//Tek Terimli Sanayi
//Perakende Tek Zamanlı Enerji Bedeli



//var_dump($tarife[0]['sanayi']);













//


$toplamTuketim = 348536.9;
$indirimOrani = 5;


function hesapla($tip,$toplamTuketim,$indirimOrani,$sayacTip){
	$tarife = array();
	$tarife[] = array(
	'sanayi' => array(
	'birimFiyat' => 17.5666,//Perakende Tek Zamanlı Enerji Bedeli
	'kkFiyat' => 0.23253,//K/K Bedeli
	'psbhFiyat' => 0.6075,//Perakende Satış Hizmet Bedeli
	'iltFiyat' => 0.8945,//İletim Bedeli
	'dagitimFiyat' => 1.4424,//Dağıtım Bedeli
	),
  'ticaratane' => array(
  'birimFiyat' => 20.7927,//Perakende Tek Zamanlı Enerji Bedeli
  'kkFiyat' => 3.5582,//K/K Bedeli
  'psbhFiyat' => 0.6075,//Perakende Satış Hizmet Bedeli
  'iltFiyat' => 0.8945,//İletim Bedeli
  'dagitimFiyat' => 2.8061,//Dağıtım Bedeli
  ),
	'mesken' => array(
	'birimFiyat' => 20.7728,//Perakende Tek Zamanlı Enerji Bedeli
	'kkFiyat' => 3.3251,//K/K Bedeli
	'psbhFiyat' => 0.6075,//Perakende Satış Hizmet Bedeli
	'iltFiyat' => 0.8945,//İletim Bedeli
	'dagitimFiyat' => 2.8861,//Dağıtım Bedeli
	),
);

	//global
	$TRT = 0.2;
	$sayacOG = 5.4480;
	$sayacAG = 0.5448;
	$elektrikTuketimVergisi = 0.05;
	$enerjiFonu = 0.01;


	$sayacTip = $sayacAG;
	$stepOne = $tarife[0][$tip];

	$birimFiyat = $stepOne['birimFiyat'];
	$kkFiyat = $stepOne['kkFiyat'];
	$psbhFiyat = $stepOne['psbhFiyat'];
	$iltFiyat = $stepOne['iltFiyat'];
	$dagitimFiyat = $stepOne['dagitimFiyat'];

	//Tüketim Bedeli
	$tuketimBedeli = (($birimFiyat*$toplamTuketim)*(100-$indirimOrani))/10000;
	$kayipKacakBedeli = ($toplamTuketim*$kkFiyat)/100 ;
	$psbhTutar = ($toplamTuketim*$psbhFiyat)/100;
	$dagitimTutar = ($toplamTuketim*$dagitimFiyat)/100;
	$iletimTutar = ($toplamTuketim*$iltFiyat)/100;
	$sayacTutar = $sayacTip;
	$trtTutar = (($tuketimBedeli+$kayipKacakBedeli)*0.02);
	$elektrikTuketimVergisiTutar = ($tuketimBedeli+$kayipKacakBedeli)*$elektrikTuketimVergisi;
	$enerjiFonuTutar =  ($tuketimBedeli+$kayipKacakBedeli)*$enerjiFonu;
	$genelToplam = 	$tuketimBedeli + $kayipKacakBedeli + $psbhTutar + $dagitimTutar + $iletimTutar + $sayacTutar + $trtTutar + $elektrikTuketimVergisiTutar + $enerjiFonuTutar ; 
	$genelToplamKdv = $genelToplam*0.18;
	$genelKdvDahilToplam = $genelToplam*1.18;


	echo '<div id="detay">
<div class="container">
<div class="row">
<div class="col-lg-8">
<!--<div class="table-responsive">
   <table id="deneme">
      <thead>
        <tr>

         
          
          <th>Tüketim Bedeli</th>
          <th>Kayıp Kaçak Bedeli</th>
          <th>Tüketim Bedeli</th>
          <th>Kayıp Kaçak Bedeli</th>
          <th>psbhTutar</th>
          <th>dagitimTutar</th>
          <th>iletimTutar</th>
          <th>sayacTutar</th>
          <th>trtTutar</th>
          <th>elektrikTuketimVergisiTutar</th>
          <th>elektrikTuketimVergisiTutar</th>
          <th>genelToplam</th>
          <th>KDV</th>
          <th>genelKdvDahilToplam</th>
        </tr>
      </thead>
      <tbody>-->';
        echo 'Tüketim Bedeli :'.$tuketimBedeli.'</br>';
        echo 'Kayıp Kaçak Bedeli :'.$kayipKacakBedeli.'</br>';
        echo 'Psbh Tutar :'.$psbhTutar.'</br>';
        echo 'Dağıtım Tutar :'.$dagitimTutar.'</br>';
        echo 'İletim Tutar :'.$iletimTutar.'</br>';
        echo 'Sayaç Tutar :'.$sayacTutar.'</br>';
        echo 'TRT Tutar :'.$trtTutar.'</br>';
        echo 'Elektrik Tüketim :'.$elektrikTuketimVergisiTutar .'</br>';
        echo 'Enerji Fonu :'.$enerjiFonuTutar.'</br>';
        echo 'Genel Toplam :'.$genelToplam.'</br>';
        echo 'Genel Toplam KDV :'.$genelToplamKdv.'</br>';
    
        echo 'TRT Tutar :'.$genelToplamKdv.'</br>';
        echo 'TRT Tutar :'.$genelKdvDahilToplam.'</br>';
        /*echo '<tr class="active">
         
          
          <td>'.$tuketimBedeli.'</td>
          <td>'.$kayipKacakBedeli.'</td>
          <td>'.$psbhTutar.'</td>
          <td>'.$dagitimTutar.'</td>
          <td>'.$iletimTutar.' a</td>
          <td>'.$sayacTutar.'</td>
          <td>'.$trtTutar.'</td>
          <td>'.$elektrikTuketimVergisiTutar .'</td>
          <td>'.$enerjiFonuTutar.'</td>
          <td>'.$genelToplam.'</td>
          <td>'.$genelToplamKdv.'</td>
          <td>'.$genelToplam.'</td>
          <td>'.$genelToplamKdv.'</td>
          <td>'.$genelKdvDahilToplam.'</td>

        </tr>';*/
      echo '<!--</tbody>
    </table>--->
 
</div>
</div>
</div>
</div>
</div>';

}



//hesapla('sanayi',$toplamTuketim,$indirimOrani,'');
//$toplanTuketimTutari = ($toplamTuketim);



//tek zamanlı için
//


//cift zamanlı için
//


//tarife seç
//birim fiyatlar
//
//
//ektrik tüketim 
/*
$toplamKdvsiz = (($tekZamanli*$toplamTuketim)*(100-$indirimOrani))/10000;
$kayipKacak = ($toplamTuketim*$kkBedeli)/100;
$PSHBtutar = ($toplamTuketim*$PSHB)/100;
$dagitimTutar = ($toplamTuketim*$dagitim)/100;
$iletimTutar = ($toplamTuketim*$ILT)/100;
$sayacOkuma = ($toplamTuketim*$sayacOG)/100;
$trtTutar = (($toplamKdvsiz+$kayipKacak)*0.02);

echo '<b>Tüketim Bedeli : </b>'.$toplamKdvsiz; //kdvsiz elektrik tüketim fiyatı
echo '</br>';

//echo '<b>Tüketim Bedeli KDV: </b>'.($toplamKdvsiz*0.18); //kdvsiz elektrik tüketim fiyatı
echo '</br>';
echo '<b>Kayıp Kaçak Bedeli : </b>'.$kayipKacak;
echo '</br>';

//echo '<b>Kayıp Kaçak Bedeli KDV : </b>'.($kayipKacak*0.18);
echo '</br>';
echo '<b>kayıp kaçak kdvsiz toplam bedeli : </b>'. ($toplamKdvsiz+ $kayipKacak)	;//parakende satis

echo '</br>';
echo '<b>Perakende Satış Hizmet Bedeli : </b>'. $PSHBtutar	;//parakende satis
echo '</br>';

//echo '<b>Perakende Satış Hizmet KDV : </b>'. ($PSHBtutar*0.18)	;//parakende satis
echo '</br>';
echo '<b>Dağıtım Bedeli : </b>'. $dagitimTutar	;//parakende satis
echo '</br>';

//echo '<b>Dağıtım Bedeli KDV: </b>'. ($dagitimTutar*0.18)	;//parakende satis
echo '</br>';
echo '<b>İletim  Bedeli: </b>'. $iletimTutar	;//parakende satis


echo '</br>';
//echo '<b>İletim  Bedeli KDV: </b>'. ($iletimTutar*0.18)	;//parakende satis



echo '</br>';
echo '<b>TRT Katkı payı: </b>'. ($trtTutar)	;//parakende satis

echo '</br>';
echo '<b>Sayaç  Okuma: </b>'. ($sayac)	;//parakende satis
$elektrikTuketimVergisi = ($toplamKdvsiz+$kayipKacak)*0.01;


echo '</br>';
echo '<b>Elektrik tüketim vergisi: </b>'. ($elektrikTuketimVergisi)	;//parakende satis


echo '</br>';
echo '<b>Enerji Fonu: </b>'. ($elektrikTuketimVergisi)	;//parakende satis

echo '</br>';

$toplam = $toplamKdvsiz+ $kayipKacak + $dagitimTutar + $iletimTutar + $PSHBtutar + $sayac + $elektrikTuketimVergisi + $elektrikTuketimVergisi + $trtTutar;


echo '</br>';
echo '<b>Genel Toplam</b>'.$toplam; 
echo '</br>';
echo '<b>KDV </b>'.$toplam*0.18; 
echo '</br>';
echo '<b>Toplam KDVli </b>'.$toplam*1.18; 
*/
//toplam KDVsiz
//toplam kdvli

// 
//
// 
// 
// 
// 

function controlFatura($db){
  echo '<div id="detay" style="margin:20px auto;">';
  echo '<div class="container">';
  echo '<div class="row">';
  echo '<div class="col-lg-12">';
  echo '<div id="controlCenter">';
  echo '<table id="pmumTable" class="table table-striped table-bordered dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%;">';
  echo '<thead>';
  echo '<tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column ascending" style="width: 135px;">ID</th>';
  echo '<th>Şehir</th>';
  echo '<th>Sayaç Adı</th>';
  echo '<th>Etso Kodu</th>';
  echo '<th>Durum</th>';
  echo '<th>Kayıplı Çekis</th>';
  echo '<th>İşlem</th>';
  
  echo '</tr>';
  echo '</thead>';
    echo '<tfoot>';
  echo '<tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column ascending" style="width: 135px;">ID</th>';
  echo '<th>Şehir</th>';
  echo '<th>Sayaç Adı</th>';
  echo '<th>Etso Kodu</th>';
  echo '<th>Durum</th>';
  echo '<th>Kayıplı Çekis</th>';
  echo '<th>İşlem</th>';
  
  echo '</tr>';
  echo '</tfoot>';



  echo '<tbody>';
  
  $pmumQuery = "select * from temp_pmum_okuma where durum = 'OKUNDU' and status='0'";
  $pmums = $db->get_results($pmumQuery);
  //$db->debug();
  if($pmums){
  foreach($pmums as $pmum){

  echo '<tr role="row" class="odd">';
  echo '<td class="sorting_1">'.$pmum->id.'</td>';
  echo '<td>'.$pmum->sayac_sehir.'</td>';
  echo '<td>'.$pmum->sayac.'</td>';
  echo '<td>'.$pmum->etso_kodu.'</td>';
  echo '<td>'.$pmum->durum.'</td>';
  echo '<td>'.$pmum->kayipli_cekis_mwh.'</td>';
  echo '<td><a href="fatura_duzenle.php?id='.$pmum->id.'">Düzenle</a></td>';
  echo '</tr>';
  


  }
}
  echo '</tbody>';
  echo '</table>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
}
controlFatura($db);
?>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<script type="text/javascript" class="init">

$(document).ready(function() {
  $('#pmumTable').dataTable();
} );

  </script>

</body>
</html>


