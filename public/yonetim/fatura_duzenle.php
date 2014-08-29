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
		if($pmumRow){


		$regular_expression_1 ="\((.*?)\)";
		preg_match_all('#'.$regular_expression_1.'#' ,$pmumRow->sayac , $out);
		

		echo '<form role="form" action="fatura_detay.php" method="post" id="faturaform">
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
    <input type="text" class="form-control " id="etsokodus" name="etsokodus" placeholder="Password" value="'.$pmumRow->etso_kodu.'" disabled>
	<input type="hidden" class="form-control " id="etsokodu" name="etsokodu" placeholder="Password" value="'.$pmumRow->etso_kodu.'">
	
	</div>
  </div>
  <div class="form-group" style="height:50px">
  	<div class="col-lg-3">
    <label for="exampleInputPassword1" class="control-label">Sayaç ID</label>
	</div>
    <div class="col-lg-9">
    <input type="text" class="form-control " id="sayacid" name="sayacid" placeholder="Sayaç ID" value="'.$out[1][0].'" disabled>
    <input type="hidden" class="form-control " id="sayacid" name="sayacid" placeholder="Sayaç ID" value="'.$out[1][0].'">
	</div>
  </div>
   <div class="form-group" style="height:50px">
  	<div class="col-lg-3">
    <label for="exampleInputPassword1" class="control-label">Şehir</label>
	</div>
    <div class="col-lg-9">
    <input type="text" class="form-control " id="cityname" name="cityname" placeholder="'.$pmumRow->sayac_sehir.'" value="'.$pmumRow->sayac_sehir.'" disabled>
    <input type="hidden" class="form-control " id="cityname" name="cityname" placeholder="'.$pmumRow->sayac_sehir.'" value="'.$pmumRow->sayac_sehir.'">
	</div>
  </div>
  <div class="form-group" style="height:50px">
  	<div class="col-lg-3">
    <label for="exampleInputPassword1" class="control-label">Cari </label>
	</div>
    <div class="col-lg-9">
    <input type="text" class="form-control " id="cariname" name="cariname" placeholder="'.$pmumRow->sayac.'" value="'.str_replace($out[0][0],"",$pmumRow->sayac).'" disabled>
	<input type="hidden" class="form-control " id="cariname" name="cariname" placeholder="'.$pmumRow->sayac.'" value="'.str_replace($out[0][0],"",$pmumRow->sayac).'">
	
	</div>
  </div>
   <div class="form-group" style="height:50px">
  	<div class="col-lg-3">
    <label for="exampleInputPassword1" class="control-label">Tüketim Miktarı</label>
	</div>
    <div class="col-lg-9">
    <input type="text" class="form-control " id="tuketimmiktari" name="tuketimmiktari" placeholder="'.$pmumRow->kayipli_cekis_mwh.'" value="'.$pmumRow->kayipli_cekis_mwh.'" disabled>
	<input type="hidden" class="form-control " id="tuketimmiktari" name="tuketimmiktari" placeholder="'.$pmumRow->kayipli_cekis_mwh.'" value="'.$pmumRow->kayipli_cekis_mwh.'">
	
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
    	<select class="form-control" id="tarifeGroup" name="tarifename">
    		<option value="0">Eşleştirilmemiş Tarife</option>';
    	
    		
    echo '</select>
    </div>
  </div>

<div class="form-group" style="height:50px">
  	<div class="col-lg-3">
    <label for="exampleInputPassword1" class="control-label">Tarife Kategori</label>
	</div>
    <div class="col-lg-9">
    	<select class="form-control" id="tarifeDesc" name="tarifedesc">


  		</select>
    </div>
  </div>

<div class="form-group" style="height:200px">
  	<div class="col-lg-3">
    <label for="exampleInputPassword1" class="control-label">Tarife Birim Fiyatı Bilgileri</label>
	</div>
    <div class="col-lg-9">
<textarea rows="6" class="form-control"  placeholder="Epdk dan çekilen tarife birim fiyatları" id="tarifeInfo" disabled>
</textarea>
    </div>
  </div>

   <blockquote>
  <p>Dinamo Tarife ve Kampanya Bilgileri</p>
</blockquote>
<div class="form-group" style="height:50px">
  	<div class="col-lg-3">
    <label for="exampleInputPassword1" class="control-label">Dinamo Tarife Bilgileri</label>
	</div>
    <div class="col-lg-9">
    	<select class="form-control" id="tarifeDinamo" name="tarifedinamo">
    		<option value="0">Seçiniz</option>
    		<option value="1">Standart Mesken (Eski Mesken Cari)</option>
    		<option value="2">Standart Ticarethane(Eski Ticarethane Cari)</option>
  		</select>
    </div>
  </div>
  <div class="form-group" style="height:50px">
  	<div class="col-lg-3">
    <label for="exampleInputPassword1" class="control-label">Dinamo Tarife İndirim oranı</label>
	</div>
    <div class="col-lg-9">
    <input type="text" class="form-control " id="dinamoindirim" name="dinamoindirim"placeholder="Dinamo İndirim Oranı" value="">
	
    </div>
  </div>
  <div class="form-group" style="height:50px">
  	<div class="col-lg-3">
    <label for="exampleInputPassword1" class="control-label">Sayaç Okuma</label>
	</div>
    <div class="col-lg-9">
    	<select class="form-control" name="dinamosayac" id="dinamoSayac">
    		<option value="0" >Seçiniz</option>
    		<option value="1">Sayaç OG</option>
    		<option value="2">Sayaç AG</option>

  		</select>
    </div>
  </div>
   <div class="form-group" style="height:50px">
  	<div class="col-lg-3">
    <label for="exampleInputPassword1" class="control-label">Faturanın Gönderileceği Mail</label>
	</div>
    <div class="col-lg-9">
    	<input type="text" class="form-control " id="faturaemail" name="faturaemail" placeholder="Fatura Mail" value="">
	
    </div>
  </div>

<div class="form-group" style="height:200px">
  	<div class="col-lg-3">
    <label for="exampleInputPassword1" class="control-label">Fatura Adresi</label>
	</div>
    <div class="col-lg-9">
<textarea rows="6" class="form-control"  placeholder="Faturanın Gönderileceği Adresi Giriniz" id="faturaadres" name="faturaadres">
</textarea>
    </div>
  </div>

   <div class="form-group" style="height:50px">
  	<div class="col-lg-3">
    <label for="exampleInputPassword1" class="control-label">Micro Cari Kodu</label>
	</div>
    <div class="col-lg-9">
    	<input type="text" class="form-control " id="carikodu" name="carikodu" placeholder="Mikro Cari Kodu" value="">
	
    </div>
  </div>

  
  <button type="submit" class="btn btn-default" id="hesapla">Hesapla</button>
</form>';

		}
		else{
			echo 'hata';
		}
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
<div id="debugs">
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<p id="data"></p>	
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

    var tarife = $(function() {

        $.ajax({
            type: 'GET',
            url: 'https://www.dinamoelektrik.com/post.php?&q=tarifeGroup',
            success: function(data) {
                var tarife = '';
         	       $.each($.parseJSON(data), function() {
                    //console.log(this.adi);
                    tarife += '<option value=' + this.tarifeid + '>' + this.tarifeadi + this.tarifedesc + '</option>';
                });
                $('#tarifeGroup').html(tarife);
                $('#tarifeDesc').html('<option value="0">Tarife Seçiniz</option>');
                $('#tarifeGroup').on('change', function() {
                    var descID = this.value;
                    $.ajax({
                        type: 'GET',
                        url: 'https://wwww.dinamoelektrik.com/post.php?&q=tarifeDesc&p=' + descID,
                        success: function(data) {
                            var descdata = '<option value="0">Seçiniz</option>';
                            $.each($.parseJSON(data), function() {
                                descdata += '<option value=' + this.tarifeid + '>' + this.tarifeadi + '</option>';
                            });
                            $('#tarifeDesc').html(descdata);
                            $('#tarifeInfo').html('Tarife Kategori Seçiniz');
                            //$("#tarifeDesc").select2({allowClear: true, showSearchBox: false});
                            $('#tarifeDesc').on('change', function() {
                            	var changeID = this.value;


                            	$.ajax({
                            		type: 'GET',
                            		url: 'https://www.dinamoelektrik.com/post.php?&q=tarifeBirim&p=1&k='+changeID,
                            		success: function(data){
                            			var infoData = '';
                            			$.each($.parseJSON(data), function(){
                            				infoData += this.tarifeid + ' - ' + this.tarifeadi + ' : ' + this.tarifespec +'\n';
                            			});
                            		   $('#tarifeInfo').html(infoData);
                            		},
                            	});	
                            
                            });
                        }
                    });
                });
            }
        });

    });

	$('#hesapla').click(function(event){
		event.preventDefault();
		if($('#tarifeDesc').val() == 0){
			alert('! Lütfen mevcut tarife grubunu ve kategorisini giriniz.');

		}
		else if($('#tarifeDinamo').val() == 0){
			alert('! Lütfen dinamo tarife bilgisini giriniz.');

		}
		else if($('#dinamoindirim').val() == ''){
			alert('! Lütfen dinamo oranını  giriniz.');
		}
		else if($('#dinamoindirim').val() > 20){
			alert('! Yüzde 20 nin üstünde indirim oranı veremezsiniz.');
		}
		else if($('#dinamoSayac').val() == 0){
			alert('! Lütfen kullanıcı sayaç tipini giriniz.');
		}
		else if($('#faturamail').val() == 0){
			alert('! Lütfen faturanın gönderileceği mail adresini giriniz.');
		}

		else if($('#faturaadres').val() == 0){
			alert('! Lütfen faturanın gönderileceği adresi giriniz.');
		}
		else if($('#carikodu').val() == 0){
			alert('! Lütfen mikro cari giriniz.');
		}


		else{
			$.post('https://wwww.dinamoelektrik.com/yonetim/fatura_detay.php',$('#faturaform').serializeArray(),function(data){
				$('#data').html(data);
				if(data == 'ok'){
					document.location='./fat.php?etso='+$('#etsokodu').val();
				}
				else{
					alert('Sistemde Hata Oluştu. Bu fatura daha önce işlenmiş olabilir. Lütfen Sistem Yetkilisi ile irtibata geçiniz.');
				}
			});
		}

	})

} );

  </script>

</body>
</html>