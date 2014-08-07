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
  <style type="text/css">
  .form-group{
  }
  </style>
</head>
<body>
<div id="faturaCenter" style="margin:30px auto;">
<div class="container">
<div class="row">
<div class="col-lg-12">

<?php
require_once '../ez/shared/ez_sql_core.php';
require_once '../ez/mysql/ez_sql_mysql.php';
$db = new ezSQL_mysql('root','qweytr','dinamo_master','localhost','utf-8');

date_default_timezone_set('Europe/Istanbul');



if($_GET){
	if($_GET['id']){
		 //$pmumQuery = "select * from temp_pmum_okuma";
		$ids = $_GET['id'];
		$pmumRowQuery ="select * from temp_pmum_okuma where id='$ids'";


		//echo $pmumRowQuery;
		$pmumRow = $db->get_row($pmumRowQuery);
		$regular_expression_1 ="\((.*?)\)";
		preg_match_all('#'.$regular_expression_1.'#' ,$pmumRow->sayac , $out);
		

		echo '<form role="form">
  			<div class="form-group" style="height:160px">
  			<div class="col-lg-3">
            <label class="control-label" for="postalAddress">Pmum Çekilen Bilgileri</label>
        	</div>
            <div class="col-lg-9">
                <textarea rows="6" class="form-control" id="postalAddress" placeholder="Pmum çekilen fatura kullanım bilgileri" disabled>

                id 					: '.$pmumRow->id.'
                sayaç şehir 		: '.$pmumRow->sayac_sehir.'
                etso kodu 		: '.$pmumRow->etso_kodu.'
                sayaç cari  		: '.$pmumRow->sayac.'
                sayaç kayipli cekiş  : '.$pmumRow->kayipli_cekis_mwh.' Mwh

                </textarea>
            </div>
            </div>
            <blockquote>
  <p>Pmumdan okunan değerlerin temizlenmiş halı</p>
</blockquote>
<div class="form-group" style="height:50px">
  	<div class="col-lg-3">
    <label for="exampleInputPassword1" class="control-label">Etso Kodu</label>
	</div>
    <div class="col-lg-9">
    <input type="text" class="form-control " id="exampleInputPassword1" placeholder="Password" value="'.$pmumRow->etso_kodu.'" disabled>
	</div>
  </div>
  <div class="form-group" style="height:50px">
  	<div class="col-lg-3">
    <label for="exampleInputPassword1" class="control-label">Sayaç ID</label>
	</div>
    <div class="col-lg-9">
    <input type="text" class="form-control " id="exampleInputPassword1" placeholder="Password" value="'.$out[1][0].'" disabled>
	</div>
  </div>
   <div class="form-group" style="height:50px">
  	<div class="col-lg-3">
    <label for="exampleInputPassword1" class="control-label">Şehir</label>
	</div>
    <div class="col-lg-9">
    <input type="text" class="form-control " id="exampleInputPassword1" placeholder="'.$pmumRow->sayac_sehir.'" value="'.$pmumRow->sayac_sehir.'" disabled>
	</div>
  </div>
  <div class="form-group" style="height:50px">
  	<div class="col-lg-3">
    <label for="exampleInputPassword1" class="control-label">Cari </label>
	</div>
    <div class="col-lg-9">
    <input type="text" class="form-control " id="exampleInputPassword1" placeholder="'.$pmumRow->sayac.'" value="'.str_replace($out[0][0],"",$pmumRow->sayac).'" disabled>
	</div>
  </div>

   <blockquote>
  <p>Epdk Tarife Ayarları</p>
</blockquote>

  <div class="form-group" style="height:50px">
  	<div class="col-lg-3">
    <label for="exampleInputPassword1" class="control-label">Mevcut Tarife</label>
	</div>
    <div class="col-lg-9">
    	<select class="form-control">
    		<option value="0">Eşleştirilmemiş Tarife</option>';
    		$prefix = "temp_epdk";
    		$epdkTipTable = "_tarife_group";
    		$epdkTipTableName = $prefix.$epdkTipTable;
    		$epdkTipQuery  = "select * from $epdkTipTableName";
    		$epdkTipResults = $db->get_results($epdkTipQuery);
    		foreach($epdkTipResults as $tip){
    			echo '<option value="'.$tip->id.'">'.$tip->group_name.' - '.$tip->group_desc .'</option>';
    		}
    		
    echo '</select>
    </div>
  </div>

<div class="form-group" style="height:50px">
  	<div class="col-lg-3">
    <label for="exampleInputPassword1" class="control-label">Tarife Kategori</label>
	</div>
    <div class="col-lg-9">
    	<select class="form-control">


  </select>
    </div>
  </div>

<div class="form-group" style="height:200px">
  	<div class="col-lg-3">
    <label for="exampleInputPassword1" class="control-label">Tarife Birim Fiyatı Bilgileri</label>
	</div>
    <div class="col-lg-9">
<textarea rows="6" class="form-control" id="postalAddress" placeholder="Pmum çekilen fatura kullanım bilgileri" disabled>
</textarea>
    </div>
  </div>

   <blockquote>
  <p>Dinamo Tarife ve Kampanya Bilgileri</p>
</blockquote>
   <blockquote>
  <p>Muhasebe Ayarları</p>
</blockquote>
  <div class="checkbox">
    <label>
      <input type="checkbox"> Check me out
    </label>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>';

		
	}
}
else{
	echo 'hata';
}
?>

</div>
</div>
</div>
</div>


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