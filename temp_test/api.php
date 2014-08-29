<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
date_default_timezone_set('Europe/Istanbul');
header ('Content-type: text/plain; charset=utf-8');

session_start();
ob_start();


require_once 'apps/core/shared/ez_sql_core.inc';
require_once 'apps/core/mysql/ez_sql_mysql.inc';

$db = new ezSQL_mysql('root','qweytr','dinamo_master','localhost','utf-8');
$d = array();
if($_GET){

	if(isset($_GET['api'])){
			if($_GET['api'] == 'rmJ9E57uyk84277'){
				if($_GET['prog'] == 'city'){
					$citys = $db->get_results('select * from pk_il');
					if($citys){
						foreach ($citys as $c){
							$d[] = array(
								'il' => $c->il_id,
								'adi' => $c->il_adi,
							);
						}
					}
				}
				else if($_GET['prog'] == 'state'){
					$id = $_GET['id'];
					$states = $db->get_results("select * from pk_ilce where il_id=$id");
					if ($states) {
                		foreach ($states as $state) {
                    		$d[] = array(
                        	'ilce' => $state->ilce_id,
                       		'adi' => $state->ilce_adi,
                    		);
                		}
            		}

				}
				else if($_GET['prog'] == 'tcno'){

					if(isset($_GET['ad']) && isset($_GET['year']) && isset($_GET['tcno'])) {

						$adfull = $_GET['ad'];
						$adfull = explode(" ", $adfull);
						if(isset($adfull[2])){
							$ad = $adfull[0].' '.$adfull[1];
							$soyadi = $adfull[1];
						}
						else{
							$ad = $adfull[0];
							$soyadi = $adfull[1];
						}

						//$ad = 'görkem';
						//$soyadi = 'özkan';
						$tcno = $_GET['tcno'];
						$dogumyili = $_GET['year'];
					}
					
					//$pieces = explode(" ", $pizza);
					function karakter_duzeltme($gelen){
    				$karakterler = array("ç","ğ","ı","i","ö","ş","ü");
    				$degistir = array("Ç","Ğ","I","İ","Ö","Ş","Ü");
    				return str_replace($karakterler, $degistir, $gelen);
					}

					$ad =  strtoupper(karakter_duzeltme(trim($ad)));
					$soyadi =  strtoupper(karakter_duzeltme(trim($soyadi)));
					$dogumyili = trim($dogumyili);

					$tcno = trim($tcno);
    				settype($tcno, "double");

					header("Content-type: text/html; charset=utf-8");
 

   					try {
        				// Gönderilecek veriler
        				$veriler = array(
            				"TCKimlikNo" => $tcno,
            			    "Ad" => $ad,
            				"Soyad" => $soyadi,
            				"DogumYili" => $dogumyili
        				);
 
        			$baglan = new SoapClient("https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx?WSDL");
        			$sonuc = $baglan->TCKimlikNoDogrula($veriler);
 
        			// Sonucun döndürülmesi
        			if ($sonuc->TCKimlikNoDogrulaResult){
            			$d[] = array('status' => 'T.C numarası doğru','statusid' => '1');
        			}else {
            			$d[] = array('status' => '! T.C numarası yanlış','statusid' => '2');
        			}
 
    				}catch (Exception $hata){
        				$d[] = array('status' => '! T.C numarası bulunmamaktadır...','statusid' => '3');
    				}

				}
				else if($_GET['prog'] == 'statement'){
					//
					if($_GET['type'] == 'bireysel'){
						$campainQuery = "select * from campains where core_website_id='1' and campain_type_id='1' and status='1'";
						$campain = $db->get_results($campainQuery);
						if($campain){
							foreach($campain as $c){
							$campainDescQuery = "select * from campains_desc where campains_id='$c->id' and status='1'";
							$campainDesc = $db->get_row($campainDescQuery);
							$sharedQuery = "select * from campains_shared where campains_id='$c->id' and status='1'";
							$shared = $db->get_results($sharedQuery);
							//$db->debug();
							$desc = isset($campainDesc) ?  $campainDesc->campains_short : 'yok';
							$share = array();
							foreach($shared as $s){
								$k = array('id' => $s->share_type_id, 
									'icerikid' => $s->share_content_id);
								array_push($share, $k);
							}
							$d[] = array(
								'kampanyaid' => $c->id,
								'kampanyabaslik' => $c->campain_name,
								'kampanyaresim' => $c->campain_img,
								'kampanyakisa' => $desc,
								'share' => $share,
								);
							}
							
							
						}
						

					}	

				}
			}

	}
	else{
		$d[] = array('error' => 'Atar ERROR :)');
	}
}
else{
	$d[] = array('error' => 'Atar ERROR :)');
}
echo json_encode($d, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);