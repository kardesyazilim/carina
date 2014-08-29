<?php


error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once '../ez/shared/ez_sql_core.php';
require_once '../ez/mysql/ez_sql_mysql.php';
$db = new ezSQL_mysql('root','qweytr','dinamo_master','localhost','utf-8');

date_default_timezone_set('Europe/Istanbul');

setlocale(LC_MONETARY, 'tr_TR');
  setlocale(LC_CTYPE, 'tr_TR.UTF8');
/*if($_GET){
  if($_GET['etso']){
    $etso = $_GET['etso'];
    $hesapQuery = "select * from temp_invoice_dinamo_check where etsokodu='$etso'";
    $hesap = $db->get_row($hesapQuery);
    $toplamTuketim = $hesap->tuketimmiktari;
    $indirimOrani = $hesap->dinamoindirim;
    $tip = $hesap->carikodu;
    //echo $tip;
    $sayacTip = $hesap->dinamosayac ;
  }
}
else{
$toplamTuketim = 400;
$indirimOrani = 10;
$tip = 'sanayi';
$sayacTip = 1 ;
} 
*/


function hesapla($tip,$toplamTuketim,$indirimOrani,$sayacTip,$hesap,$db,$etso,$param =false){
	$tarife = array();
	$tarife[] = array(
	'sanayi' => array(
	'birimFiyat' => 17.5666,//Perakende Tek Zamanlı Enerji Bedeli
	'kkFiyat' => 0.23253,//K/K Bedeli
	'psbhFiyat' => 0.6075,//Perakende Satış Hizmet Bedeli
	'iltFiyat' => 0.8945,//İletim Bedeli
	'dagitimFiyat' => 1.4424,//Dağıtım Bedeli
	'text' => 'SANAYİ',
  ),
  'sanayi_spec' => array(
  'birimFiyat' => 17.5666,//Perakende Tek Zamanlı Enerji Bedeli
  'kkFiyat' => 0.23253,//K/K Bedeli
  'psbhFiyat' => 0,//Perakende Satış Hizmet Bedeli
  'iltFiyat' => 0.8945,//İletim Bedeli
  'dagitimFiyat' => 1.4424,//Dağıtım Bedeli
  'text' => 'SANAYİ',
  ),
  'sanayi_ag' => array(
  'birimFiyat' => 17.5666,//Perakende Tek Zamanlı Enerji Bedeli
  'kkFiyat' => 0.34549,//K/K Bedeli
  'psbhFiyat' => 0.6075,//Perakende Satış Hizmet Bedeli
  'iltFiyat' => 0.8945,//İletim Bedeli
  'dagitimFiyat' => 2.2533,//Dağıtım Bedeli
  'text' => 'SANAYİ',
  ),
  'sanayiciftterimli' => array(
  'birimFiyat' => 17.5666,//Perakende Tek Zamanlı Enerji Bedeli
  'kkFiyat' => 0.22064,//K/K Bedeli
  'psbhFiyat' => 0,//Perakende Satış Hizmet Bedeli //sacede aycan için
  'iltFiyat' => 0.8945,//İletim Bedeli
  'dagitimFiyat' => 1.0663,//Dağıtım Bedeli
  'text' => 'SANAYİ ÇİFT TERİMLİ',
  ),
  'ticarethane' => array(
  'birimFiyat' => 20.7927,//Perakende Tek Zamanlı Enerji Bedeli
  'kkFiyat' => 3.5582,//K/K Bedeli
  'psbhFiyat' => 0.6075,//Perakende Satış Hizmet Bedeli
  'iltFiyat' => 0.8945,//İletim Bedeli
  'dagitimFiyat' => 2.8061,//Dağıtım Bedeli
  'text' => 'TİCARETHANE',
  ),
  
  'organize' => array(
  'birimFiyat' => 17.5666,//Perakende Tek Zamanlı Enerji Bedeli
  'kkFiyat' => 0,//K/K Bedeli
  'psbhFiyat' => 0,//Perakende Satış Hizmet Bedeli
  'iltFiyat' => 1.2,//İletim Bedeli
  'dagitimFiyat' => 1.47,//Dağıtım Bedeli
  'text' => 'ORGANİZE SANAYİ',
  ),
	'mesken' => array(
	'birimFiyat' => 20.7728,//Perakende Tek Zamanlı Enerji Bedeli
	'kkFiyat' => 3.3251,//K/K Bedeli
	'psbhFiyat' => 0.6075,//Perakende Satış Hizmet Bedeli
	'iltFiyat' => 0.8945,//İletim Bedeli
	'dagitimFiyat' => 2.8861,//Dağıtım Bedeli
  'text' => 'MESKEN',
	),
  'organizeanadolu' => array(
  'birimFiyat' => 17.5666,//Perakende Tek Zamanlı Enerji Bedeli
  'kkFiyat' => 0,//K/K Bedeli
  'psbhFiyat' => 0,//Perakende Satış Hizmet Bedeli
  'iltFiyat' => 0,//İletim Bedeli
  'dagitimFiyat' => 0,//Dağıtım Bedeli
  'text' => 'ORGANİZE SANAYİ',
  ),

);

  $sayacOG = 5.4480;
  $sayacAG = 0.5448;
  //mesken ticarethane ag ticaret mesken yüzde 5 sanayi 1
	//global
	$TRT = 0.2;
  //burayı kontrol 
  if($sayacTip == 1){
    $carpan = 10;
    $sayacTip = $sayacOG;//40Z000001032738N
    $elektrikTuketimVergisi = 0.01;//40Z000001032738N
    $kesmeAcma = '19,1';
  }
  else if($sayacTip == 3){
    $carpan = 10;
    $sayacTip = 0;//40Z000001032738N
    $elektrikTuketimVergisi = 0.01;//40Z000001032738N
    $kesmeAcma = '19,1';
  }
  else if($sayacTip == 4){
    $carpan = 10;
    $sayacTip = $sayacAG;
    $elektrikTuketimVergisi = 0.01;//40Z000001032738N
    $kesmeAcma = '97';
  }
  else if($sayacTip == 5){

    $carpan = 10;
    $sayacTip = 0;//40Z000001032738N
    $elektrikTuketimVergisi = 0.01;//40Z000001032738N
    $kesmeAcma = '19,1';
  }
  else{
    $carpan = 100;
    $sayacTip = $sayacAG;
    $elektrikTuketimVergisi = 0.05;//40Z000001032738N
    $kesmeAcma = '97';
  }
	
	$enerjiFonu = 0.01;

//40Z000000329477K kk  elektrik tüketim vergisi 01
	$stepOne = $tarife[0][$tip];

	$birimFiyat = $stepOne['birimFiyat'];
	$kkFiyat = $stepOne['kkFiyat'];
	$psbhFiyat = $stepOne['psbhFiyat'];
	$iltFiyat = $stepOne['iltFiyat'];
	$dagitimFiyat = $stepOne['dagitimFiyat'];
  $GRUP = $stepOne['text'] ;
  //echo $GRUP;

	//Tüketim Bedeli
	$tuketimBedeli = (($birimFiyat*$toplamTuketim)*(100-$indirimOrani))/10000;
  //echo 'tüketim bedeli ' .$tuketimBedeli.'</br>';
	$kayipKacakBedeli = ($toplamTuketim*$kkFiyat)/$carpan;
  //echo 'kayıp kaçak '.$kayipKacakBedeli.'</br>';
	$psbhTutar = ($toplamTuketim*$psbhFiyat)/100;
  //echo 'pbsh tutar'.$psbhTutar.'</br>';
	$dagitimTutar = ($toplamTuketim*$dagitimFiyat)/100;
  //echo 'Dağıtım tutar'.$dagitimTutar.'</br>';
	$iletimTutar = ($toplamTuketim*$iltFiyat)/100;
  //echo 'İletişim Tutar '.$iletimTutar.'</br>';
	$sayacTutar = $sayacTip;
	$trtTutar = (($tuketimBedeli+$kayipKacakBedeli)*0.02);
	$elektrikTuketimVergisiTutar = ($tuketimBedeli+$kayipKacakBedeli)*$elektrikTuketimVergisi;
	$enerjiFonuTutar =  ($tuketimBedeli+$kayipKacakBedeli)*$enerjiFonu;
	$genelToplam = 	$tuketimBedeli + $kayipKacakBedeli + $psbhTutar + $dagitimTutar + $iletimTutar + $sayacTutar + $trtTutar + $elektrikTuketimVergisiTutar + $enerjiFonuTutar ; 
	$genelToplamKdv = $genelToplam*0.18;
	$genelKdvDahilToplam = $genelToplam*1.18;
  //echo 'Genel toplam: '.$genelKdvDahilToplam;


  $ADSOYAD= $hesap->cariname;//ADSOYAD
  $FATURAADRESI= $hesap->faturaadres;//FATURAADRESI
  $SIRANO= $hesap->sayacid;//SIRANO
  $FATURATARIHI= '8 TEMMUZ';//FATURATARIHI
  $ABONENO= $hesap->etsokodu;//ABONENO
  $ABONEGRUBU= $GRUP;//ABONEGRUBU
  $HESAPDONEMI= 'TEMMUZ 2014';//HESAPDONEMI
  $TOPLAMTUTAR= $genelKdvDahilToplam ;//TOPLAMTUTAR
  $SONODEME= '15 TEMMUZ';//SONODEME
  $AYLIKKAZANCINIZ=round($genelKdvDahilToplam*0.1,2);//AYLIKKAZANCINIZ
  $SAYACNO = $hesap->sayacid;

  $PSHORAN= $psbhFiyat ;
  $PSHTUTAR= round($psbhTutar, 2) ;


  $TUKETIMMIKTARI=  round($hesap->tuketimmiktari, 2);//TUKETIMMIKTARI
  $TUTKETIMBIRIMFIYAT= $birimFiyat;//TUTKETIMBIRIMFIYAT
 
  $HESAPDONEMI= 'TEMMUZ 2014';//HESAPDONEMI
  $ABONEGRUBU= $GRUP;//ABONEGRUBU

  $tuketimGunduz= '---';//tuketimGunduz
  $tuketimPuant= '---';//tuketimPuant
  $tuketimGece= '---';//tuketimGece
  $tuketimBirimGunduz= '---';//tuketimBirimGunduz
  $tuketimBirimPuant= '---';//tuketimBirimPuant
  $tuketimBirimGece= '---';//tuketimBirimGece
  $tuketimBirimGunduzIndOrn= '---';//tuketimBirimGunduzIndOrn
  $tuketimBirimPuantIndOrn= '---';//tuketimBirimPuantIndOrn
  $tuketimBirimGeceIndOrn= '---';//tuketimBirimGeceIndOrn
  $tuketimBirimGunduzInd= '---';//tuketimBirimGunduzInd
  $tuketimBirimPuantInd= '---';//tuketimBirimPuantInd
  $tuketimBirimGeceInd= '---';//tuketimBirimGeceInd
  $tuketimGunduzTutar= '---';//tuketimGunduzTutar
  $tuketimPuantTutar= '---';//tuketimPuantTutar
  $tuketimGeceTutar= '---';//tuketimGeceTutar
  $KAYIPKACAKORAN= $kkFiyat;//KAYIPKACAKORAN
  $KAYIPKACAKTUTAR= round($kayipKacakBedeli , 2);//KAYIPKACAKTUTAR
  $SPECORAN= $psbhFiyat;//SPECORAN
  $SPECTUTAR= round($psbhTutar, 2);//SPECTUTAR
  $DAGITIMBEDELIORAN= $dagitimFiyat;//DAGITIMBEDELIORAN
  $DAGITIMBEDELITUTAR= round($dagitimTutar, 2);//DAGITIMBEDELITUTAR
  $ILETIMBEDELIORAN= $iltFiyat;//ILETIMBEDELIORAN
  $ILETIMBEDELITUTAR= round($iletimTutar, 2);//ILETIMBEDELITUTAR
  $ENERJIFONUTUTAR= round($enerjiFonuTutar, 2);//ENERJIFONUTUTAR
  $ENERJIFONUORAN= $enerjiFonu;//ENERJIFONUORAN
  $TRTPAYIORAN= '2';//TRTPAYIORAN
  $TRTPAYITUTAR= round($trtTutar , 2);//TRTPAYITUTAR
  $ELEKTRIKTUKETIMVERORAN= $elektrikTuketimVergisi;//ELEKTRIKTUKETIMVERORAN
  $ELEKTRIKTUKETIMVERTUTAR= round($elektrikTuketimVergisiTutar, 2);//ELEKTRIKTUKETIMVERTUTAR
  $KESMEBAGLAMAORAN= '---';//EKESMEBAGLAMAORAN
  $KESMEBAGLAMATUTAR= '---';//EKESMEBAGLAMATUTAR
  $GECIKMEFAIZIORAN= '---';//GECIKMEFAIZIORAN
  $GECIKMEFAIZITUTAR= '---';//GECIKMEFAIZITUTAR
  $KDVORAN= '18';//KDVORAN
  $KDVTUTAR= round($genelToplamKdv, 2);//KDVTUTAR



  
  //echo money_format('%.2n', $number) . "\n";

  $TOPLAMTUTAR = str_replace("L",'' , money_format('%.2n', $TOPLAMTUTAR));
  
  if($hesap->hesaplama_ok == 1){
    $sonodeme = '15 AĞUSTOS 2014';
  }
  else if($hesap->hesaplama_ok == 2){
    $sonodeme = '22 AĞUSTOS 2014';
  }
  else{
    $sonodeme = '01 EYLUL 2014';
  }
  echo $sonodeme.','.$hesap->aboneno.','.$hesap->fatura_seri_no_tip.','.$hesap->fatura_seri_no.','.$hesap->cariname.','.$TOPLAMTUTAR.'</br>';
}




    $hesapQuery = "select * from temp_invoice_dinamo_check";
    $hesaps = $db->get_results($hesapQuery);
    if($hesaps){
        foreach($hesaps as $hesap){
              $toplamTuketim = $hesap->tuketimmiktari;
              $indirimOrani = $hesap->dinamoindirim;
              $tip = $hesap->carikodu;
    //echo $tip;
              $etso = $hesap->etsokodu;
              $sayacTip = $hesap->dinamosayac ;
              hesapla($tip,$toplamTuketim,$indirimOrani,$sayacTip,$hesap,$db,$etso);
        }
    }

?>

