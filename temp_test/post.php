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
    else if($_GET['q']=='tarifeGroup'){
        $prefix = "temp_epdk";
            $epdkTipTable = "_tarife_group";
            $epdkTipTableName = $prefix.$epdkTipTable;
            $epdkTipQuery  = "select * from $epdkTipTableName";
            $d[] = array(
                'tarifeid' => 0,
                'tarifeadi' => 'Eşlendirilmemiş Tarife',
                'tarifedesc' => ' Sisteme de önceden var olan eski cari kaydı',
            );
        $tarifeGroups = $db->get_results($epdkTipQuery);
        foreach ($tarifeGroups as $tarifeGroup) {
    
            $d[] = array(
                'tarifeid' => $tarifeGroup->id,
                'tarifeadi' => $tarifeGroup->group_name,
                'tarifedesc' => ' '.$tarifeGroup->group_desc,
            );
        }
    }


    else if($_GET['q']=='tarifeDesc'){
            $prefix = "temp_epdk";
            $epdkDescTable = "_tarife_desc";
            $epdkDescTableName = $prefix.$epdkDescTable;
            if(isset($_GET['p'])){
            $epdkDescQuery  = 'select * from '.$epdkDescTableName.' where group_id='.$_GET['p'];
            
        $tarifeDescs = $db->get_results($epdkDescQuery);
        if($tarifeDescs){
        foreach ($tarifeDescs as $tarifeDesc) {
    
            $d[] = array(
                'tarifeid' => $tarifeDesc->id,
                'tarifeadi' => $tarifeDesc->group_name,
            );
        }
        }
        else{
            $d[] = array(
                'tarifeid' => '0',
                'tarifeadi' => 'Mevcut Tarife Grubunu Seçiniz',
            );
        }
        }
        else{
            $d[] = array(
                'tarifeid' => '0',
                'tarifeadi' => 'Mevcut Tarife Grubunu Seçiniz',
            );
        }

    }

    else if($_GET['q']=='tarifeBirim'){
            $prefix = "temp_epdk";
            $epdkBirimTable = "_tarife_birim";
            $epdkBirimTableName = $prefix.$epdkBirimTable;
            if(isset($_GET['p'])){
            $epdkBirimQuery  = 'select * from '.$epdkBirimTableName.' where group_id=1';
            
            //echo $epdkBirimQuery;
            if(isset($_GET['k'])){

            }
        $tarifeBirims = $db->get_results($epdkBirimQuery);
        if($tarifeBirims){
        foreach ($tarifeBirims as $tarifeBirim) {
            if($_GET['k']){
                if($_GET['k'] !== 0){


            $epdkBirimFiyati = 'select * from temp_epdk_tarife_birim_field where group_id='.$_GET['k']. ' and field_id='.$tarifeBirim->id;
            $epdkBirimFiyat = $db->get_row($epdkBirimFiyati);

            $d[] = array(
                'tarifeid' => $tarifeBirim->id,
                'tarifeadi' => $tarifeBirim->spec_name,
                'tarifespec' => isset($epdkBirimFiyat->field_value)  ? $epdkBirimFiyat->field_value : 'Yok' ,
            );
            }
            else{
                 $d[] = array(
                'tarifeid' => '0',
                'tarifeadi' => 'Mevcut Tarife Grubunu Seçiniz',
                'tarifespec' => '',
            );
            }
            }
            else{
                 $d[] = array(
                'tarifeid' => '0',
                'tarifeadi' => 'Mevcut Tarife Grubunu Seçiniz',
                'tarifespec' => '',
            );
            }
        }
        }
        else{
            $d[] = array(
                'tarifeid' => '0',
                'tarifeadi' => 'Mevcut Tarife Grubunu Seçiniz',
                'tarifespec' => '',
            );
        }
        }
        else{
            $d[] = array(
                'tarifeid' => '0',
                'tarifeadi' => 'Mevcut Tarife Grubunu Seçiniz',
                'tarifespec' => '',
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