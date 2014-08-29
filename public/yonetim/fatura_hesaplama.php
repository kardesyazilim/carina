<?php
session_start();
ob_start();
if($_SESSION){
	$etsokodu = $_SESSION['etsokodu'];
	//echo $etsokodu;
	require_once '../ez/shared/ez_sql_core.php';
	require_once '../ez/mysql/ez_sql_mysql.php';
	$db = new ezSQL_mysql('root','qweytr','dinamo_master','localhost','utf-8');

	date_default_timezone_set('Europe/Istanbul');

}
?>
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
 
  <style type="text/css">
 .invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}
  </style>
</head>
<body>
<div id="faturaCenter" style="margin:30px auto;">
<div class="container">
<div class="row">
<div class="col-lg-12">
<?php 
$checkIvoice = "select * from temp_invoice_dinamo_check where etsokodu='$etsokodu' and fatura_status='0' and hesaplama_ok='0'";
$check = $db->get_row($checkIvoice);
if($check){
	var_dump($check);
	

	echo '	<div class="invoice-title">
    			<h4>'.$check->cariname.'</h4><h6>Etso kodu :' .$etsokodu.' Sayaç No:'.$check->sayacid.' </h6>
    		</div>';
    echo '<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Adres:</strong><br>
    					Yeni Sistemde ilk Kayıt
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
        			<strong>Fatura Adresi:</strong><br>
    					Yeni Sistemde ilk Kayıt
    				</address>
    			</div>
    		</div>';
    echo ' <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Güncel Fatura Detayları</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>Kalem</strong></td>
        							<td class="text-center"><strong>Birim Fiyatı</strong></td>
        							<td class="text-center"><strong>Tüketim Oranı</strong></td>
        							<td class="text-right"><strong>Toplam</strong></td>
                                </tr>
    						</thead>
    						<tbody>';
    		/*					<!-- foreach ($order->lineItems as $line) or some such thing here -->
    							<tr>
    								<td> 600.01.001   ELEKTRİK GELİRİ</td>
    								<td class="text-center">$10.99</td>
    								<td class="text-center">1</td>
    								<td class="text-right">$10.99</td>
    							</tr>
    							<tr>
    								<td> 600.01.001   ELEKTRİK GELİRİ</td>
    								<td class="text-center">$10.99</td>
    								<td class="text-center">1</td>
    								<td class="text-right">$10.99</td>
    							</tr>
                               
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Total</strong></td>
    								<td class="no-line text-right">$685.99</td>
    							</tr>*/
echo '	<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Toplam</strong></td>
    								<td class="thick-line text-right">$670.99</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>KDV</strong></td>
    								<td class="no-line text-right">$15</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>KDV Dahil Toplam</strong></td>
    								<td class="no-line text-right">$685.99</td>
    							</tr>';

    					echo '</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>';
    echo ' <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Epdk Tarife Detayları</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>ID</strong></td>
        							<td class="text-center"><strong>Açıklama</strong></td>
        							<td class="text-center"><strong>Birim Fiyatı</strong></td>
    						</thead>
    						<tbody>';
$tarifeBirim = "select * from temp_epdk_tarife_birim_field where group_id='$check->tarifename'";
	$tarife = $db->get_results($tarifeBirim);
	//var_dump($tarife);
	foreach($tarife as $tar){
		if(isset($tar->field_value)){

		$field_name = "select * from temp_epdk_tarife_birim where id='$tar->field_id'";
		$field_name = $db->get_row($field_name);
		

		echo '<tr>
    								<td>'.$tar->field_id.'</td>
    								<td class="text-center">'.$field_name->spec_name.'</td>
    								<td class="text-center">'.$tar->field_value.'</td>
    							</tr>';
		} 
	}
}
	echo '</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>';

?>
</div>
</div>
</div>
</div>

<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script type="text/javascript" class="init">

$(document).ready(function() {
  

});

  </script>

</body>
</html>