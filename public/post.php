<?php
//campanya 
//sehir 
//ilçe
require_once 'ez/shared/ez_sql_core.php';
require_once 'ez/mysql/ez_sql_mysql.php';
$db = new ezSQL_mysql('root','qweytr','dinamo_master','localhost','utf-8');







$d = array();
if($_GET){

	if($_GET['q']=='tarife'){
		if($_GET['p'] == 'bireysel'){
			$campainQuery = "select * from campains where status='1' and core_website_id='1'";
		}
		else{
			$campainQuery = "select * from campains where status='1' and core_website_id='2'";
		}
		$campains = $db->get_results($campainQuery);
		foreach ($campains as $campain) {
	
			$d[] = array(
                'ids' => $campain->id,
                'adi' => $campain->campain_name,
                'spec' => $campain->campain_a,
		    );
		}
	}
	else if ($_GET['q'] == 'city') {
            $citys = $db->get_results('select * from pk_il');
            if ($citys) {
                foreach ($citys as $city) {
                    $d[] = array(
                        'il' => $city->il_id,
                        'adi' => $city->il_adi,
                    );
                }
            }
        } elseif ($_GET['q'] == 'state') {

            $states = $db->get_results('select * from pk_ilce where il_id=' . $_GET['p']);
            if ($states) {
                foreach ($states as $state) {
                    $d[] = array(
                        'ilce' => $state->ilce_id,
                        'adi' => $state->ilce_adi,
                    );
                }
            }
        } elseif ($_GET['q'] == 'company') {

            $companys = $db->get_results('select * from pk_company');
            if ($companys) {
                foreach ($companys as $company) {
                    $d[] = array(
                        'id' => $company->id,
                        'adi' => $company->company_name,
                    );
                }
            }
        }
        elseif ($_GET['q'] == 'distributor') {

            $distributors = $db->get_results('select * from pk_distributor');
            if ($distributors) {
                foreach ($distributors as $distributor) {
                    $d[] = array(
                        'id' => $distributor->id,
                        'adi' => $distributor->distributor_name,
                    );
                }
            }
        }
		


}








echo json_encode($d, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);