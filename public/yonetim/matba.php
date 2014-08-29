  <?php

error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once '../ez/shared/ez_sql_core.php';
require_once '../ez/mysql/ez_sql_mysql.php';
$db = new ezSQL_mysql('root','qweytr','dinamo_master','localhost','utf-8');

date_default_timezone_set('Europe/Istanbul');

setlocale(LC_MONETARY, 'tr_TR');
setlocale(LC_CTYPE, 'tr_TR.UTF8');
//if($_GET){
//  if($_GET['etso']){

  //}


$header = '';
/*
function hesapla($tip,$toplamTuketim,$indirimOrani,$sayacTip,$hesap,$db,$param =false){
	$tarife = array();
	$tarife[] = array(
	'sanayi' => array(
	'birimFiyat' => 17.5666,//Perakende Tek Zamanlı Enerji Bedeli
	'kkFiyat' => 0.23253,//K/K Bedeli
	'psbhFiyat' => 0.6075,//Perakende Satış Hizmet Bedeli
	'iltFiyat' => 0.8945,//İletim Bedeli
	'dagitimFiyat' => 1.4424,//Dağıtım Bedeli
	),
  'ticarethane' => array(
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
  }
  else{
    $carpan = 100;
    $sayacTip = $sayacAG;
    $elektrikTuketimVergisi = 0.05;//40Z000001032738N
  }
	
	$enerjiFonu = 0.01;


	$stepOne = $tarife[0][$tip];

	$birimFiyat = $stepOne['birimFiyat'];
	$kkFiyat = $stepOne['kkFiyat'];
	$psbhFiyat = $stepOne['psbhFiyat'];
	$iltFiyat = $stepOne['iltFiyat'];
	$dagitimFiyat = $stepOne['dagitimFiyat'];



	$tuketimBedeli = (($birimFiyat*$toplamTuketim)*(100-$indirimOrani))/10000;


	$kayipKacakBedeli = ($toplamTuketim*$kkFiyat)/$carpan;


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



  $ADSOYAD= $hesap->cariname;//ADSOYAD
  $FATURAADRESI= $hesap->faturaadres;//FATURAADRESI
  $SIRANO= $hesap->sayacid;//SIRANO
  $FATURATARIHI= '8 TEMMUZ';//FATURATARIHI
  $ABONENO= $hesap->etsokodu;//ABONENO
  $ABONEGRUBU= $hesap->carikodu;//ABONEGRUBU
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
  $ABONEGRUBU= $hesap->carikodu;//ABONEGRUBU

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
  $tuketimBirimGeceInd= '---';//
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

 


  


  $ADSOYAD= $hesap->cariname;//ADSOYAD
  $FATURAADRESI= $hesap->faturaadres;//FATURAADRESI
  $SIRANO= $hesap->sayacid;//SIRANO
  $FATURATARIHI= '8 TEMMUZ';//FATURATARIHI
  $ABONENO= isset($hesap->aboneno) ? $hesap->abondeno : 'YOK ';//ABONENO
  $ABONEGRUBU= $hesap->carikodu;//ABONEGRUBU
  $HESAPDONEMI= 'TEMMUZ 2014';//HESAPDONEMI

  $TOPLAMTUTAR= $genelKdvDahilToplam ;//TOPLAMTUTAR
  $SONODEME= '15 AĞUSTOS 2014';//SONODEME
 
  $AYLIKKAZANCINIZ=round($genelKdvDahilToplam*0.1,2);//AYLIKKAZANCINIZ
  $SAYACNO = $hesap->sayacid;

  $PSHORAN= $psbhFiyat ;
  $PSHTUTAR= round($psbhTutar, 2) ;


  $TUKETIMMIKTARI=  round($hesap->tuketimmiktari, 2);//TUKETIMMIKTARI
  $TUTKETIMBIRIMFIYAT= $birimFiyat;//TUTKETIMBIRIMFIYAT
 
  $HESAPDONEMI= 'TEMMUZ 2014';//HESAPDONEMI
  $ABONEGRUBU= $hesap->carikodu;//ABONEGRUBU

  $tuketimGunduz= '---';//tuketimGunduz
  $tuketimPuant= '---';//tuketimPuant
  $tuketimGece= '---';//tuketimGece
  $tuketimBirimGunduz= '---';//tuketimBirimGunduz
  $tuketimBirimPuant= '---';//tuketimBirimPuant
  $tuketimBirimGece= '---';//tuketimBirimGece
  $tuketimBirimGunduzIndOrn= '---';//tuketimBirimGunduzIndOrn
  $tuketimBirimPuantIndOrn= '---';//tuketimBirimPuantIndOrn
  $Orn= '---';//tuketimBirimGeceIndOrn
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
  bin . 
  virgül küsürat

 echo '^';//tuketim_tutari_tek_zamanli
        echo '^';//
        echo '^';//indrim_oran_tek_zamanli
        echo '^';//tarife_br_fiyat_tek_zamanli
        echo '^';//tuketim_tek_zamanli
        echo '^';//musteri_no
 
}*/

  $ustBaslik = "faturatipi^sirano^faturatarihi1^faturatarihi2^isletmeadi^aboneno^abonegrubu^donem^sayacno^tuketim_gunduz^tuketim_puant^tuketim_gece^tarife_br_fiyat_gunduz^tarife_br_fiyat_puant^tarife_br_fiyat_gece^indirim_oran_gunduz^indirim_oran_puant^indirim_oran_gece^indirim_fiyat_gunduz^indirim_fiyat_puant^indirim_fiyat_gece^tuketim_tutari_gunduz^tuketim_tutari_puant^tuketim_tutari_gece^enduktif_br_fiyat^enduktif_tutar^kapasitif_br_fiyat^kapasitif_tutar^gucbedeli_br_fiyat^gucbedeli_tutar^trafokaybi_br_fiyat^trafpkaybi_tutar^kayipkacak_br_fiyat^kayipkacak_tutar^persatis_br_fiyat^persatis_tutar^dagitim_br_fiyat^dagitim_tutar^iskb_br_fiyat^iskb_tutar^psh_br_fiyat^psh_tutar^enerjifonu_oran^enerjifonu_tutar^trtpayi_oran^trtpayi_tutar^etv_oran^etv_tutar^kasmebaglama_oran^kesmebaglama_tutar^gecikmefaizi_oran^gecikmefaizi_tutar^kdv_oran^kdv_tutar^ilkokuma^sonokuma^adsoyad^adres^postakodu^ilce^sehir^odenecektutar^sonodemetarihi^mevcuttarife^dinamo_1^dinamo_2^dinamo_3^dinamo_4^dinamo_5^dinamo_6^dinamo_7^dinamo_8^dinamo_9^dinamo_10^dinamo_11^dinamo_12^dinamo_13^dinamo_14^dinamo_15^dinamo_16^dinamo_17^dinamo_18^dinamo_19^dinamo_20^dinamo_21^dinamo_22^dinamo_23^dinamo_24^dinamo_25^dinamo_26^dinamo_27^dinamo_28^dinamo_29^dinamo_30^dinamo_31^dinamo_32^dinamo_33^dinamo_34^dinamo_35^dinamo_36^dinamo_mesaj_1^dinamo_mesaj_2^dinamo_mesaj_3^dinamo_mesaj_4^dinamo_mesaj_5^dinamo_mesaj_6^dinamo_mesaj_7^dinamo_mesaj_8^dinamo_mesaj_9^dinamo_mesaj_10^ipucu^mesaj_1^mesaj_2^mesaj_3^mesaj_4^mesaj_5^mesaj_6^mesaj_7^mesaj_8^mesaj_9^mesaj_10^banka_1^banka_1_durum^banka_2^banka_2_durum^banka_3^banka_3_durum^banka_4^banka_4_durum^banka_5^banka_5_durum^banka_6^banka_6_durum^banka_7^banka_7_durum^banka_8^banka_8_durum^banka_9^banka_9_durum^banka_10^banka_10_durum^dummy_1^dummy_2^dummy_3^dummy_4^dummy_5^dummy_6^dummy_7^donem_borcu^aylik_kazanc_tutari^tuketim_tutari_tek_zamanli^indirim_fiyat_tek_zamanli^indrim_oran_tek_zamanli^tarife_br_fiyat_tek_zamanli^tuketim_tek_zamanli^musteri_no^eof";

  echo $ustBaslik."</br>";
    $hesapQuery = "select * from temp_invoice_dinamo_check where etsokodu='40Z000001217281F'";
    $hesaps = $db->get_results($hesapQuery);
    foreach ($hesaps as $hesap) {

 $sayacTip = $hesap->dinamosayac ;
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


  $indirimOrani = $hesap->dinamoindirim;
  $toplamTuketim = $hesap->tuketimmiktari;
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

    if($hesap->hesaplama_ok == 1){
    $sonodeme = '15 AĞUSTOS 2014';
  }
  else if($hesap->hesaplama_ok == 2){
    $sonodeme = '22 AĞUSTOS 2014';
  }
  else{
    $sonodeme = '01 EYLUL 2014';
  }
  
  $enerjiFonu = 0.01;


  $stepOne = $tarife[0][$hesap->carikodu];

  $birimFiyat = $stepOne['birimFiyat'];
  $kkFiyat = $stepOne['kkFiyat'];
  $psbhFiyat = $stepOne['psbhFiyat'];
  $iltFiyat = $stepOne['iltFiyat'];
  $dagitimFiyat = $stepOne['dagitimFiyat'];



  $tuketimBedeli = (($birimFiyat*$toplamTuketim)*(100-$indirimOrani))/10000;


  $kayipKacakBedeli = ($toplamTuketim*$kkFiyat)/$carpan;


  $psbhTutar = ($toplamTuketim*$psbhFiyat)/100;
  $dagitimTutar = ($toplamTuketim*$dagitimFiyat)/100;
  $iletimTutar = ($toplamTuketim*$iltFiyat)/100;
  $sayacTutar = $sayacTip;
  $trtTutar = (($tuketimBedeli+$kayipKacakBedeli)*0.02);
  $elektrikTuketimVergisiTutar = ($tuketimBedeli+$kayipKacakBedeli)*$elektrikTuketimVergisi;
  $enerjiFonuTutar =  ($tuketimBedeli+$kayipKacakBedeli)*$enerjiFonu;
  $genelToplam =  $tuketimBedeli + $kayipKacakBedeli + $psbhTutar + $dagitimTutar + $iletimTutar + $sayacTutar + $trtTutar + $elektrikTuketimVergisiTutar + $enerjiFonuTutar ; 
  $genelToplamKdv = $genelToplam*0.18;
  $genelKdvDahilToplam = $genelToplam*1.18;
  $kurus = ' Kr.';
  $tl = ' TL.'; 






    
        echo $hesap->carikodu.'^';//faturatipi
        echo $hesap->sayacid.'^';//sırano
        //echo $hesap->cariname.'^';
        echo '12 Ağustos 2014^';//faturatarihi1
        echo '12082014^';//
        echo $hesap->cariname.'^';//isletmeadi
        echo isset($hesap->aboneno) ?  $hesap->aboneno : 'YOK';//aboneno
        echo '^'.$hesap->carikodu.'^';//abondegrubu
        echo 'AGUSTOS 2014^';//donem
        echo isset($hesap->sayacno) ? $hesap->sayacno : 'YOK';//sayacno
        echo '^'.'---'.'^';//tüketim gündüz
        echo '---'.'^';//tüketimpuant
        echo '---'.'^';//tuketim_gece
        echo '---'.'^';//tarife_br_fiyat_gunduz
        echo '---'.'^';//tarife_br_fiyat_puant
        echo '---'.'^';//tarife_br_fiyat_gece
        echo '---'.'^';//indirim_oran_gunduz
        echo '---'.'^';//indirim_oran_puant^
        echo '---'.'^';//indirim_oran_gece^
        //echo '---'.'^';//indirim_oran_gece^
        echo '---'.'^';//indirim_fiyat_gunduz^
        echo '---'.'^';//indirim_fiyat_puant
        echo '---'.'^';//^indirim_fiyat_gece
        echo '---'.'^';//^tuketim_tutari_gunduz
        echo '---'.'^';//^tuketim_tutari_puant
        echo '---'.'^';//^tuketim_tutari_gece
        echo '---'.'^';//^enduktif_br_fiyat
        echo '---'.'^';//^enduktif_tutar
        echo '---'.'^';//^enduktif_tutar
        echo '---'.'^';//^kapasitif_br_fiyat
        echo '---'.'^';//kapasitif_tutar^
        echo '---'.'^';//gucbedeli_br_fiyat^
        echo '---'.'^';//gucbedeli_tutar^
        echo '---'.'^';//trafokaybi_br_fiyat^
        //echo '---'.'^';//trafpkaybi_tutar^
        echo str_replace ( "TRL" , " ", money_format('%i',$kkFiyat*100)).$kurus.'^';//kayipkacak_br_fiyat^
        echo str_replace ( "TRL" , " ", money_format('%i',round($kayipKacakBedeli,2))).$tl.'^';//kayipkacak_tutar^
        echo str_replace ( "TRL" , " ", money_format('%i',$birimFiyat)).$kurus.'^';//persatis_br_fiyat^
        echo str_replace ( "TRL" , " ", money_format('%i',round($tuketimBedeli,2))).$tl.'^';//persatis_tutar^
        echo str_replace ( "TRL" , " ", money_format('%i',$dagitimFiyat)).$kurus.'^';//dagitim_br_fiyat^
        echo str_replace ( "TRL" , " ", money_format('%i',round($dagitimTutar,2))).$tl.'^';//dagitim_tutar^
        echo str_replace ( "TRL" , " ", money_format('%i',$iltFiyat*100)).$kurus.'^';//iskb_br_fiyat^
        echo str_replace ( "TRL" , " ", money_format('%i',round($iletimTutar,2))).$tl.'^';//iskb_tutar^
        echo str_replace ( "TRL" , " ", money_format('%i',$psbhFiyat*100)).$kurus.'^';//psh_br_fiyat^
        echo str_replace ( "TRL" , " ", money_format('%i',round($psbhTutar,2))).$tl.'^';//psh_br_tutar^
        echo '1'.'^';//enerjifonu_oran^
        echo str_replace ( "TRL" , " ", money_format('%i',round($enerjiFonuTutar,2))).$tl.'^';//enerjifonu_tutar^
        echo '2'.'^';//trtpayi_oran^
        echo str_replace ( "TRL" , " ", money_format('%i',round($trtTutar,2))).$tl.'^';//ttrtpayi_tutar^
        echo ($elektrikTuketimVergisi*100).'^';//etv_oran^
        echo str_replace ( "TRL" , " ", money_format('%i',round($elektrikTuketimVergisiTutar,2))).$tl.'^';//etv_tutar^
        echo '---'.'^';//kasmebaglama_oran^
        if($sayacTip==0.5448){
          echo '19,1'.'^';//kesmebaglama_tutar^
        }
        else{
          echo '97'.'^';//kesmebaglama_tutar^
          
        }
        echo '4'.'^';//gecikmefaizi_oran^
        echo '---'.'^';//gecikmefaizi_tutar^
        echo '18'.'^';//kdv_oran^
        echo str_replace ( "TRL" , " ", money_format('%i',round($genelToplamKdv,2))).$tl.'^';//kdv_tutar^
        echo '---'.'^';//ilkokuma^
        echo '---'.'^';//sonokuma^
        echo $hesap->cariname.'^';//adsoyad^
        echo $hesap->faturaadres.'^';//adres^
        echo '---'.'^';//postakodu^
        echo '^';//ilce^
        echo $hesap->cityname.'^';//sehir^
        echo str_replace ( "TRL" , " ", money_format('%i',round($genelKdvDahilToplam,2))).$tl.'^';//odenecektutar^
        echo $sonodeme.'^';//sonodemetarihi^
        echo 'standart_tarife'.'^';//mevcuttarife^


        echo 'Şubat'.'^';//dinamo_1^
        echo 'Mart'.'^';//dinamo_2^
        echo 'Nisan'.'^';//dinamo_3^
        echo 'Mayıs'.'^';//dinamo_4^
        echo 'Haziran'.'^';//dinamo_5^
        echo 'Temmuz'.'^';//dinamo_6^
        echo ''.'^';//dinamo_7^
        echo ''.'^';//dinamo_8^
        echo ''.'^';//dinamo_9^
        echo ''.'^';//dinamo_10^
        echo ''.'^';//dinamo_11^
        echo ''.'^';//dinamo_12^
        /*$raporQuery = "select * from temp_invoice_dinamo_check_line_chart where etsokodu='$hesap->etsokodu'";
        $rapors = $db->get_results($raporQuery);
        if($rapors){


        foreach ($rapors as $r) {
          
        }
        }*/
        $grafikQuery="select * from temp_invoice_dinamo_check_line_chart where etsokodu='$hesap->etsokodu' order by mount_spec desc";
        $grafik = $db->get_results($grafikQuery);
      if($grafik){
        $bitsin = array();
       $idx = 0;
  foreach ($grafik as $g ) {
    //echo $g->value;
    if($idx >= 6) {
      break;
    }
    $bitsin[] = array('x'.$g->mount_spec => $g->value * ((100 - $g->price_spec) / 100));
    $bitsin[] = array('y'.$g->mount_spec => $g->value);
    $idx++;
        echo $g->value * ((100 - $g->price_spec) / 100).'^';//dinamo_13^
        
  }
}

else{
   echo ''.'^';//dinamo_19^
        echo ''.'^';//dinamo_20^
        echo ''.'^';//dinamo_21^
        echo ''.'^';//dinamo_22^
        echo ''.'^';//dinamo_23^
        echo ''.'^';//dinamo_24^
}
       
        echo ''.'^';//dinamo_19^
        echo ''.'^';//dinamo_20^
        echo ''.'^';//dinamo_21^
        echo ''.'^';//dinamo_22^
        echo ''.'^';//dinamo_23^
        echo ''.'^';//dinamo_24^
        
     $grafikQuery="select * from temp_invoice_dinamo_check_line_chart where etsokodu='$hesap->etsokodu' order by mount_spec desc";
        $grafik = $db->get_results($grafikQuery);
      if($grafik){
        $bitsin = array();
       $idx = 0;
  foreach ($grafik as $g ) {
    //echo $g->value;
    if($idx >= 6) {
      break;
    }
    $bitsin[] = array('x'.$g->mount_spec => $g->value * ((100 - $g->price_spec) / 100));
    $bitsin[] = array('y'.$g->mount_spec => $g->value);
    $idx++;
        echo $g->value.'^';//dinamo_13^
        
  }
}
else{
   echo ''.'^';//dinamo_19^
        echo ''.'^';//dinamo_20^
        echo ''.'^';//dinamo_21^
        echo ''.'^';//dinamo_22^
        echo ''.'^';//dinamo_23^
        echo ''.'^';//dinamo_24^
}
        echo ''.'^';//dinamo_31^
        echo ''.'^';//dinamo_32^
        echo ''.'^';//dinamo_33^
        echo ''.'^';//dinamo_34^
        echo ''.'^';//dinamo_35^
        echo ''.'^';//dinamo_36^



                /*
dummy_2^dummy_3^dummy_4^dummy_5^dummy_6^dummy_7^dummy_8^dummy_9^dummy_10^dummy_11^dummy_12^dummy_13^dummy_14^dummy_15^
31 anadodulu osb 15.diğerleri
 */
///burada kaldım
           $grafikQuery="select * from temp_invoice_dinamo_check_line_chart where etsokodu='$hesap->etsokodu' order by mount_spec desc";
        //echo $grafikQuery;
        $grafik = $db->get_results($grafikQuery);
        if($grafik){
          echo 'dolu';

        }
        else{
            $bosikenkazanc = ($genelKdvDahilToplam/($indirimOrani/100)) - $genelKdvDahilToplam;
            echo $genelKdvDahilToplam.'</br>';
        }
 /*     if($grafik){
       echo 'SON X AYLIK KAZANCINIZ'.'^';//dinamo_mesaj_1^
 
 //       echo $g->value.'^';//dinamo_13^
         
        }
      else{
         echo 'KAZANÇ TUTARI HESAPLANAMADI'.'^';//dinamo_mesaj_1^
          echo ''.'^';//dinamo_mesaj_2^
      }
   */     //kazanç hesabı


        
        echo '^';//dinamo_mesaj_3^
        echo '^';//dinamo_mesaj_4^
        echo '^';//dinamo_mesaj_5^
        echo '^';//dinamo_mesaj_6^
        echo '^';//dinamo_mesaj_7^
        echo '^';//dinamo_mesaj_8^
        echo '^';//dinamo_mesaj_9^
        echo '^';//dinamo_mesaj_10^
        echo $hesap->carikodu.'_tem'.'^';//ipucu^
        echo 'Teşekkür ederiz.'.'^';//^mesaj_1
        echo 'Ödenmemiş faturanız bulunmamaktadır.'.'^';//^mesaj_2
        echo 'Ödemelerinizde gecikme yaşandığında aylık %4 gecikme faizi uygulanacağını ve ödeme yapmadığınız takdirde elektriğinizin kesileceğini unutmayın. Herhangi bir aksilik yaşamamak için bankanıza otomatik ödeme talimatı verebilirsiniz.'.'^';//^mesaj_3
        echo '^';//^mesaj_4
        echo '^';//^mesaj_5
        echo '^';//^mesaj_6
        echo '^';//^mesaj_7
        echo '^';//^mesaj_8
        echo '^';//^mesaj_9
        echo '^';//^mesaj_10
        echo 'Garanti Bankası'.'^';//banka_1^
        echo '11111110'.'^';//banka_1_durum^
        echo 'Yapı Kredi Bankası'.'^';//banka_2^
        echo '11111111'.'^';//banka_2_durum^
        echo 'Denizbank'.'^';//banka_3^
        echo '10101110'.'^';//banka_3_durum^
        echo 'PTT'.'^';//banka_4^
        echo '00000001'.'^';//banka_4_durum^
        echo '^';//banka_5^
        echo '^';//banka_5_durum^
        echo '^';//banka_6^
        echo '^';//banka_6_durum^
        echo '^';//banka_7^
        echo '^';//banka_7_durum^
        echo '^';//banka_8^
        echo '^';//banka_8_durum^
        echo '^';//banka_9^
        echo '^';//banka_9_durum^
        echo '^';//banka_10^
        echo '^';//banka_10_durum^
        echo '^';//dummy_1^
        echo '^';//dummy_2^
        echo '^';//dummy_3^
        echo '^';//dummy_4^
        echo '^';//dummy_5^
        echo '^';//dummy_6^
        echo '^';//dummy_7^
        echo 'gecmis dönem borcu'.'^';//dummy_8^
        echo 'aylık kazan tutarı kazanctutari'.'^';//dummy_9^

        echo str_replace ( "TRL" , " ", money_format('%i',round($tuketimBedeli,2))).$tl.'^';//tuketim_tutari_tek_zamanli
        echo str_replace ( "TRL" , " ", money_format('%i',$birimFiyat*((100 - $indirimOrani)*0.01))).$tl.'^';//indirim_fiyat_tek_zamanli
        echo $indirimOrani.'^';//indrim_oran_tek_zamanli
        echo str_replace ( "TRL" , " ", money_format('%i',$birimFiyat)).$tl.'^';//tarife_br_fiyat_tek_zamanli
        echo str_replace ( "TRL" , " ", money_format('%i',$toplamTuketim)).$tl.'^';//tuketim_tek_zamanli
        echo $hesap->proper_kodu.'^';//musteri_no
        echo "</br>";
          


        //echo '</br>';
        
        $toplamTuketim = $hesap->tuketimmiktari;
        $indirimOrani = $hesap->dinamoindirim;
        $tip = $hesap->carikodu;
        $sayacTip = $hesap->dinamosayac ;
      }

      echo 'eof'."</br>";
?>

