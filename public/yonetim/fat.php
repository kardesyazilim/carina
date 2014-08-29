<?php


error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once '../ez/shared/ez_sql_core.php';
require_once '../ez/mysql/ez_sql_mysql.php';
$db = new ezSQL_mysql('root','qweytr','dinamo_master','localhost','utf-8');

date_default_timezone_set('Europe/Istanbul');

setlocale(LC_MONETARY, 'tr_TR');
  setlocale(LC_CTYPE, 'tr_TR.UTF8');
if($_GET){
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

  $fatura= file_get_contents('./fatura/fatura.html', FILE_USE_INCLUDE_PATH);
  
  $fatura = str_replace("{@ADSOYAD@}", $ADSOYAD, $fatura);
  $fatura = str_replace("{@FATURAADRESI@}", $FATURAADRESI, $fatura);
  $fatura = str_replace("{@TOPLAMTUTAR@}", $TOPLAMTUTAR, $fatura);
  $fatura = str_replace("{@SONODEME@}", $SONODEME, $fatura);


  $fatura = str_replace("{@SIRANO@}", $SIRANO, $fatura);
  $fatura = str_replace("{@FATURATARIHI@}", $FATURATARIHI , $fatura);
  $fatura = str_replace("{@ABONENO@}", $ABONENO, $fatura);
  $fatura = str_replace("{@TUKETIMMIKTARI@}", $TUKETIMMIKTARI, $fatura);
  $fatura = str_replace("{@TUTKETIMBIRIMFIYAT@}", $TUTKETIMBIRIMFIYAT, $fatura);
  $fatura = str_replace("{@ABONEGRUBU@}", $GRUP, $fatura);
  $fatura = str_replace("{@HESAPDONEMI@}", $HESAPDONEMI, $fatura);
  $fatura = str_replace("{@SAYACNO@}", $SAYACNO, $fatura);
  $fatura = str_replace("{@tuketimGunduz@}", $tuketimGunduz, $fatura);
  $fatura = str_replace("{@tuketimPuant@}", $tuketimPuant, $fatura);
  $fatura = str_replace("{@tuketimGece@}", $tuketimGece, $fatura);
  $fatura = str_replace("{@tuketimBirimGunduz@}", $tuketimBirimGunduz, $fatura);
  $fatura = str_replace("{@tuketimBirimPuant@}", $tuketimBirimPuant, $fatura);
  $fatura = str_replace("{@tuketimBirimGece@}", $tuketimBirimGece, $fatura);
  $fatura = str_replace("{@tuketimBirimGunduzIndOrn@}", $tuketimBirimGunduzIndOrn, $fatura);
  $fatura = str_replace("{@tuketimBirimPuantIndOrn@}", $tuketimBirimPuantIndOrn, $fatura);
  $fatura = str_replace("{@tuketimBirimGeceIndOrn@}", $tuketimBirimGeceIndOrn, $fatura);
  $fatura = str_replace("{@tuketimBirimGunduzInd@}", $tuketimBirimGunduzInd, $fatura);
  $fatura = str_replace("{@tuketimBirimPuantInd@}", $tuketimBirimPuantInd, $fatura);
  $fatura = str_replace("{@tuketimBirimGeceInd@}", $tuketimBirimGeceInd, $fatura);
  $fatura = str_replace("{@tuketimGunduzTutar@}", $tuketimGunduzTutar, $fatura);
  $fatura = str_replace("{@tuketimPuantTutar@}", $tuketimPuantTutar, $fatura);
  $fatura = str_replace("{@tuketimGeceTutar@}", $tuketimGeceTutar, $fatura);
  $fatura = str_replace("{@tuketimGeceTutar@}", $tuketimGeceTutar, $fatura);

  $fatura = str_replace("{@KAYIPKACAKORAN@}", $KAYIPKACAKORAN, $fatura);
  $fatura = str_replace("{@KAYIPKACAKTUTAR@}", $KAYIPKACAKTUTAR, $fatura);
  $fatura = str_replace("{@SPECORAN@}", $SPECORAN, $fatura);
  $fatura = str_replace("{@SPECTUTAR@}", $SPECTUTAR, $fatura);
  $fatura = str_replace("{@DAGITIMBEDELIORAN@}", $DAGITIMBEDELIORAN, $fatura);
  $fatura = str_replace("{@DAGITIMBEDELITUTAR@}", $DAGITIMBEDELITUTAR, $fatura);
  $fatura = str_replace("{@ILETIMBEDELIORAN@}", $ILETIMBEDELIORAN, $fatura);
  $fatura = str_replace("{@ILETIMBEDELITUTAR@}", $ILETIMBEDELITUTAR, $fatura);
  $fatura = str_replace("{@ENERJIFONUTUTAR@}", $ENERJIFONUTUTAR, $fatura);
  $fatura = str_replace("{@ENERJIFONUORAN@}", $ENERJIFONUORAN, $fatura);
  $fatura = str_replace("{@TRTPAYIORAN@}", $TRTPAYIORAN, $fatura);
  $fatura = str_replace("{@TRTPAYITUTAR@}", $TRTPAYITUTAR, $fatura);

  $fatura = str_replace("{@ELEKTRIKTUKETIMVERORAN@}", $ELEKTRIKTUKETIMVERORAN, $fatura);
  $fatura = str_replace("{@ELEKTRIKTUKETIMVERTUTAR@}", $ELEKTRIKTUKETIMVERTUTAR, $fatura);
  $fatura = str_replace("{@KESMEBAGLAMAORAN@}", $KESMEBAGLAMAORAN, $fatura);
  $fatura = str_replace("{@KESMEBAGLAMATUTAR@}", $KESMEBAGLAMATUTAR, $fatura);
  $fatura = str_replace("{@GECIKMEFAIZIORAN@}", $GECIKMEFAIZIORAN, $fatura);
  $fatura = str_replace("{@GECIKMEFAIZITUTAR@}", $GECIKMEFAIZITUTAR, $fatura);
  $fatura = str_replace("{@KDVORAN@}", $KDVORAN, $fatura);
  $fatura = str_replace("{@KDVTUTAR@}", $KDVTUTAR, $fatura);
  $fatura = str_replace("{@PSHORAN@}", $PSHORAN, $fatura);
  $fatura = str_replace("{@PSHTUTAR@}", $PSHTUTAR, $fatura);
  $fatura = str_replace("{@AYLIKKAZANCINIZ@}", $AYLIKKAZANCINIZ, $fatura);


  

  if($param){
  if($param == 'key'){
  $ADSOYAD= $hesap->cariname;//ADSOYAD
  $FATURAADRESI= $hesap->faturaadres;//FATURAADRESI
  $SIRANO= $hesap->sayacid;//SIRANO
  $FATURATARIHI= '31 TEMMUZ';//FATURATARIHI
  $ABONENO= isset($hesap->aboneno) ? $hesap->aboneno : 'YOK ';//ABONENO
  $ABONEGRUBU= $GRUP;//ABONEGRUBU
  $HESAPDONEMI= 'TEMMUZ 2014';//HESAPDONEMI
  setlocale(LC_CTYPE, 'tr_TR.UTF8');
  $faizHesabi = "select sum(tutar) as faiz from temp_invoice_dinamo_spec_value where etsokodu='$hesap->etsokodu' and durumtip='2'";

  $faiz = $db->get_row($faizHesabi);
  //$db->debug();
  if($faiz){
    $faiztutar = $faiz->faiz;
    $faizHesaplanan = $faiz->faiz*0.04;
    $faizinKdvsi = $faiz->faiz*0.18;
    //echo $faizinKdvsi.'</br>';

  }




 // $TOPLAMTUTAR= isset($faiztutar) ? '1' : $genelKdvDahilToplam ;//TOPLAMTUTAR
  $SONODEME= '15 AĞUSTOS 2014';//SONODEME
   



  //echo money_format('%.2n', $number) . "\n";

  //$TOPLAMTUTAR = str_replace("L",'' , money_format('%.2n', $genelKdvDahilToplam));
  $AYLIKKAZANCINIZ=round($genelKdvDahilToplam*0.1,2);//AYLIKKAZANCINIZ
  $SAYACNO = $hesap->sayacid;

  $PSHORAN= $psbhFiyat ;
  $PSHTUTAR= round($psbhTutar, 2) ;


  $TUKETIMMIKTARI=  round($hesap->tuketimmiktari, 2);//TUKETIMMIKTARI
  $TUTKETIMBIRIMFIYAT= $birimFiyat;//TUTKETIMBIRIMFIYAT
 
  $HESAPDONEMI= 'TEMMUZ 2014';//HESAPDONEMI
  //$ABONEGRUBU= $hesap->carikodu;//ABONEGRUBU

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
  $KAYIPKACAKORAN= $kkFiyat/100;//KAYIPKACAKORAN
  $KAYIPKACAKTUTAR= round($kayipKacakBedeli , 2);//KAYIPKACAKTUTAR
  $SPECORAN= $psbhFiyat/100;//SPECORAN
  $SPECTUTAR= round($psbhTutar, 2);//SPECTUTAR
  $DAGITIMBEDELIORAN= $dagitimFiyat/100;//DAGITIMBEDELIORAN
  $DAGITIMBEDELITUTAR= round($dagitimTutar, 2);//DAGITIMBEDELITUTAR
  $ILETIMBEDELIORAN= $iltFiyat/100;//ILETIMBEDELIORAN
  $ILETIMBEDELITUTAR= round($iletimTutar, 2);//ILETIMBEDELITUTAR
  $ENERJIFONUTUTAR= round($enerjiFonuTutar, 2);//ENERJIFONUTUTAR
  $ENERJIFONUORAN= '1';//ENERJIFONUORAN
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


   //$rapor = "select * from temp_invoice_dinamo_check_line_chart where etsokodu='40Z0000004216883'";
  //$rapor = $db->get_results($rapor);
  //var_dump($rapor); 

//print_r($grafik);
  
  if($hesap->hesaplama_ok == 1){
    $sonodeme = '15 AĞUSTOS 2014';
  }
  else if($hesap->hesaplama_ok == 2){
    $sonodeme = '22 AĞUSTOS 2014';
  }
  else{
    $sonodeme = '01 EYLUL 2014';
  }
  $data = array(
    
  'ADSOYAD' => $hesap->cariname,//ADSOYAD
  'FATURAADRESI' => $hesap->faturaadres,//FATURAADRESI
  'SIRANO' => $hesap->sayacid,//SIRANO
  'PROPERKODU' => $hesap->proper_kodu,
  'FATURATARIHI' => '31 TEMMUZ 2014',//FATURATARIHI
  'ABONENO' => isset($hesap->aboneno) ? $hesap->aboneno : 'YOK',//ABONENO
  'ABONEGRUBU' =>$GRUP,//ABONEGRUBU
  'HESAPDONEMI' => '2014 / 07',//HESAPDONEMI
  'TOPLAMTUTAR' => isset($faiztutar) ?   round((($genelToplam+$faizHesaplanan)*1.18), 2 ) : round( $TOPLAMTUTAR, 2 ) ,//TOPLAMTUTAR

  'SONODEME' => $sonodeme ,//SONODEME
  //'AYLIKKAZANCINIZ' =>round($genelKdvDahilToplam*0.1,2),//AYLIKKAZANCINIZ
  'SAYACNO' => isset($hesap->sayacno) ? $hesap->sayacno : 'YOK',
  'CITYNAME' => '',
  'PSHORAN' => '---' ,
  'PSHTUTAR' => round($psbhTutar, 2) ,
  'INDIRIMORANI' => doubleval($indirimOrani),
  'INIRIMBIRIM' => ($birimFiyat*((100 - $indirimOrani)/100))/100,
  'ELEKTRIKTUKETIMVERGISIORANI' =>$elektrikTuketimVergisi*100,

  'TUKETIMMIKTARI' =>  round($hesap->tuketimmiktari, 2),//TUKETIMMIKTARI
  'TUKETIM' =>  round($hesap->tuketimmiktari, 2),//TUKETIMMIKTARI
  'TUTKETIMBIRIMFIYAT' => $birimFiyat/100,//TUTKETIMBIRIMFIYAT
  'TUKETIMTUTARI' => $tuketimBedeli,
  'ABONEGRUBU' => $GRUP,//ABONEGRUBU

  'tuketimGunduz' => '---',//tuketimGunduz
  'tuketimPuant' => '---',//tuketimPuant
  'tuketimGece' => '---',//tuketimGece
  'tuketimBirimGunduz' => '---',//tuketimBirimGunduz
  'tuketimBirimPuant' => '---',//tuketimBirimPuant
  'tuketimBirimGece' => '---',//tuketimBirimGece
  'tuketimBirimGunduzIndOrn' => '---',//tuketimBirimGunduzIndOrn
  'tuketimBirimPuantIndOrn' => '---',//tuketimBirimPuantIndOrn
  'tuketimBirimGeceIndOrn' => '---',//tuketimBirimGeceIndOrn
  'tuketimBirimGunduzInd' => '---',//tuketimBirimGunduzInd
  'tuketimBirimPuantInd' => '---',//tuketimBirimPuantInd
  'tuketimBirimGeceInd' => '---',//tuketimBirimGeceInd
  'tuketimGunduzTutar' => '---',//tuketimGunduzTutar
  'tuketimPuantTutar' => '---',//tuketimPuantTutar
  'tuketimGeceTutar' => '---',//tuketimGeceTutar
  'KAYIPKACAKORAN' => $kkFiyat/100,//KAYIPKACAKORAN
  'KAYIPKACAKTUTAR' => round($kayipKacakBedeli , 2),//KAYIPKACAKTUTAR
  'SPECORAN' => $psbhFiyat/100,//SPECORAN
  'SPECTUTAR' => round($psbhTutar, 2),//SPECTUTAR
  'DAGITIMBEDELIORAN' => $dagitimFiyat/100,//DAGITIMBEDELIORAN
  'DAGITIMBEDELITUTAR' => round($dagitimTutar, 2),//DAGITIMBEDELITUTAR
  'ILETIMBEDELIORAN' => $iltFiyat/100,//ILETIMBEDELIORAN
  'ILETIMBEDELITUTAR' => round($iletimTutar, 2),//ILETIMBEDELITUTAR
  'ENERJIFONUTUTAR' => round($enerjiFonuTutar, 2),//ENERJIFONUTUTAR
  'ENERJIFONUORAN' => $enerjiFonu*100,//ENERJIFONUORAN
  'TRTPAYIORAN' => '2',//TRTPAYIORAN
  'TRTPAYITUTAR' => round($trtTutar , 2),//TRTPAYITUTAR
  'ELEKTRIKTUKETIMVERORAN' => $elektrikTuketimVergisi,//ELEKTRIKTUKETIMVERORAN
  'ELEKTRIKTUKETIMVERTUTAR' => round($elektrikTuketimVergisiTutar, 2),//ELEKTRIKTUKETIMVERTUTAR
  'KESMEBAGLAMAORAN' => '---',//EKESMEBAGLAMAORAN
  'KESMEBAGLAMATUTAR' => '---',//EKESMEBAGLAMATUTAR
  //'GECIKMEFAIZIFATURA' =>$faizHesaplanan,
  'GECIKMEFAIZIORAN' => '3',//GECIKMEFAIZIORAN
  'GECIKMEFAIZITUTAR' => isset($faiztutar) ? $faizHesaplanan : '---' ,//GECIKMEFAIZITUTAR
  'KDVORAN' => '18',//KDVORAN
  'KDVTUTAR' => isset($faizinKdvsi) ? round($genelToplamKdv+$faizHesaplanan, 2) :round($genelToplamKdv, 2),//KDVTUTAR
  'FATURAEMAIL' => $hesap->faturaemail,
  'PSHBEDELSON' => $sayacTip,
  'KESMEACMA' => '---', // $kesmeAcma, // Emre: az önce Cenk ile konuştuk. Bu tutarı genel tutara dahil etmişler, ayrıca göstermeyelim dedi.
  'FATURASERI' => $hesap->fatura_seri_no_tip,
  'FATURASERINO' => $hesap->fatura_seri_no,
  
    );
  

  //grafik
  $grafikQuery="select * from temp_invoice_dinamo_check_line_chart where etsokodu='$etso' order by mount_spec desc";
  $grafik = $db->get_results($grafikQuery);
  $bitsin = array();
  if($grafik){
  
  $idx = 0;
  foreach ($grafik as $g ) {
    //echo $g->value;
    if($idx >= 6) {
      break;
    }
    $bitsin[] = array('x'.$g->mount_spec => round($g->value));
    $bitsin[] = array('y'.$g->mount_spec => round(($g->value / ((100 - $g->price_spec) / 100))));
    $idx++;
    
  }
 
  $bitsin = array_reverse($bitsin);


//print_r($bitsin);

  //lanetgitsin
  //
  //
  //
    
  

  $data['GRAFIK'] = $bitsin;
  }
 else{
  //$tuketimBedeli = (($birimFiyat*$toplamTuketim)
     $bitsin[] = array('x7' => $TOPLAMTUTAR);
     $bitsin[] = array('y7' => ($TOPLAMTUTAR / ((100 - $indirimOrani)/100) ));
     $bitsin = array_reverse($bitsin);
     $data['GRAFIK'] = $bitsin;
  }


  //////
  ///

  $borcSorgu = "select * from temp_invoice_dinamo_spec_value where etsokodu='$hesap->etsokodu' order by donem desc";
  $borc = $db->get_results($borcSorgu);
  $borcArray = array();
  if($borc){
    foreach ($borc as $b) {
      //durum tip hatırlatma
      $borcArray[] = array($b->donem => $b->tutar);
    }

    $borcArray = array_reverse($borcArray);
  }
  else{
    //$borcArray = array();
    //$borcArray[] = array('title-' => 'Ödenmemiş faturanız bulunmamaktadır.');
    //$borcArray = array_reverse($borcArray);
    
    
  }
  $data['BORCDURUM'] = $borcArray;

  ///








  $data = json_encode($data);
  print_r($data);
   }
  }
  else{
    echo $fatura;
  }

}

if(isset($_GET['json'])){
  hesapla($tip,$toplamTuketim,$indirimOrani,$sayacTip,$hesap,$db,$etso,$_GET['json']);
}
else{
  hesapla($tip,$toplamTuketim,$indirimOrani,$sayacTip,$hesap,$db,$etso);
}
?>

