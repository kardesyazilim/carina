<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
date_default_timezone_set('Europe/Istanbul');
//header ('Content-type: text/plain; charset=utf-8');

//session_start();
//ob_start();


//require_once 'apps/core/shared/ez_sql_core.inc';
//require_once 'apps/core/mysql/ez_sql_mysql.inc';
 		$strMode = "TEST";
        $strApiVersion = "v0.01";
        $strTerminalProvUserID = "PROVAUT";
        $strType = "sales";
        $strAmount = "100"; //Ýþlem Tutarý  1.00 TL için 100 gönderilmeli
        $strCurrencyCode = "949";
        $strInstallmentCount = "1"; //Taksit Sayýsý. Boþ gönderilirse taksit yapýlmaz
        $strTerminalUserID = "PROVAUT";
        $strOrderID = "DENEME";
        $strCustomeripaddress = "127.0.0.1";
        $strcustomeremailaddress = "eticaret@garanti.com.tr";
        $strTerminalID = "30691298";
        $strTerminalID_ = "030691298"; //Baþýna 0 eklenerek 9 digite tamamlanmalýdýr.
        $strTerminalMerchantID = "7000679"; //Üye Ýþyeri Numarasý
        $strStoreKey = "123456WqE"; //3D Secure þifreniz
        $strProvisionPassword = "123456WqE"; //TerminalProvUserID þifresi
        $strSuccessURL = "https://dev.dinamoelektrik.com/3DModelResults.php";
        $strErrorURL = "https://dev.dinamoelektrik.com/3DModelResults.php";
        $SecurityData = strtoupper(sha1($strProvisionPassword.$strTerminalID_));
        $HashData = strtoupper(sha1($strTerminalID.$strOrderID.$strAmount.$strSuccessURL.$strErrorURL.$strType.$strInstallmentCount.$strStoreKey.$SecurityData));
        $strtimestamp = rand();

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Dinamo Elektrik</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <link type="text/css" rel="stylesheet" href="css/select2.css">
        <link type="text/css" rel="stylesheet" href="css/dinamo.css">
        <link type="text/css" rel="stylesheet" href="css/temp-css.css">
         <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
            <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
        <!--[if lt IE 9]>
            <p class="chromeframe">Ne yazık ki <strong>zamanı geçmiş</strong> bir tarayıcı kullanıyorsunuz. Lütfen <a href="http://browsehappy.com/">tarayıcınızı güncelleyin</a> ya da <a href="http://www.google.com/chromeframe/?redirect=true">Google Chrome Frame</a> yükleyerek deneyiminizi artırın.</p>
        <![endif]-->

        <div class="wrapper">
            <header>
                 <div class="top-menu">
                    <div class="container clearfix">
                        <ul class="customer-type">
                            <li class="active"><a href="#">BİREYSEL</a></li>
                            <li><a href="#">KURUMSAL</a></li>
                        </ul>
                        <a href="#" class="btn-gray right"><span class="ico-online"></span>Online İşlem Merkezi</a>
                        <a href="#" class="btn-gray right"><span class="ico-basvur"></span>Hemen Başvur</a>
                    </div>
                </div>

                <nav>
                    <div class="container">
                        <a href="#" class="logo">Dinamo Eleltrik</a>
                        <ul>
                            <li><a href="kesfet.html">KEŞFET</a></li>
                            <li><a href="#">TARİFELER</a></li>
                            <li class="dd-menu">
                                <a href="#">KAMPANYALAR</a>
                                <div class="dropdown_fullwidth">
                                    <ul>
                                        <li><a href="#">KAMPANYA ADI BİR</a></li>
                                        <li><a href="#">KAMPANYA ADI İKİ</a></li>
                                        <li><a href="#">KAMPANYA ADI ÜÇ</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li><a href="#">DİNAMOLU OLMAK İSTİYORUM</a></li>
                        </ul>
                        <div class="menu-icon">
                            <ul class="hidden-dd">
                                <li><a href="kesfet.html">KEŞFET</a></li>
                                <li><a href="#">TARİFELER</a></li>
                                <li class="show-nested-item">
                                    <a href="#">KAMPANYALAR</a>
                                    <div class="nested-dd">
                                        <ul>
                                            <li><a href="#">KAMPANYA ADI BİR</a></li>
                                            <li><a href="#">KAMPANYA ADI İKİ</a></li>
                                            <li><a href="#">KAMPANYA ADI ÜÇ</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li><a href="#">DİNAMOLU OLMAK İSTİYORUM</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
            <div class="container clearfix main-page odeme-yap">
                <section class="content-wrapper ignore-strict-width">
                <br />
                    <h2>Fatura Ödeme</h2>
                    
                    <!---<div class="row">
                        <div class="content-title"><strong>Kemalettin Kahramanoğlu</strong> adına ödenecek faturalar aşağıda listelenmiştir.</div>
                    </div>
                    <div class="row mbot10">
                        <table class="select-table">
                            <tr>
                                <th width="62px">
                                    <input type="checkbox" id="check-all" name="check-all"/><label for="check-all"><span></span></label>
                                </th>
                                <th>Fatura Dönemi</th>
                                <th>Son Ödeme Tarihi</th>
                                <th>Fatura Tutarı</th>
                            </tr>
                            <tr>
                                <td><input type="checkbox" id="check-1" name="check-1"/><label for="check-1"><span></span></label></td>
                                <td>04.07.2014</td>
                                <td>04.08.2014</td>
                                <td>36.45 TL</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" id="tarife-zamlanmayan" name="tarife-zamlanmayan" value="tarife-zamlanmayan"/><label for="tarife-zamlanmayan"><span></span></label></td>
                                <td>04.08.2014</td>
                                <td>04.09.2014</td>
                                <td>27.98 TL</td>
                            </tr>
                            <tr class="additional-spacing">
                                <td colspan=4></td>
                            </tr>
                            <tr>
                                <td class="total-caption" colspan=3>ÖDENECEK TOPLAM TUTAR:</td>
                                <td id="total-val">00.00 TL</td>
                            </tr>
                        </table>
                    </div>-->
                    <div class="row">
                    <div class="bottom-line"></div>
                     <div class="row no-border mbot0">
                        <div class="bottom-info-block">
                        </div>
                        </div>
                        <div class="black-header">Kredi Kartı Bilgileri</div>
                        <div class="privat-info">
                        <form action="https://sanalposprov.garanti.com.tr/servlet/gt3dengine" method="post" id="banka">
                        	<div class="row credit-cardS">
                                <div class="section-title">Kart Sahibinin Adı</div>
                                <div class="row">
                                    <input type="text" id="carduser" name="carduser" maxlength="16" require/>
                                </div>
                            </div>
                            <div class="row credit-cardS">
                                <div class="section-title">Kredi Kartı Numarası:</div>
                                <div class="row">
                                    <input type="text" id="cardnumber" name="cardnumber" maxlength="16" require/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="section-title mbot0">Son Kullanma Tarihi</div>
                                <div class="row">
                                    <div class="col2 right-indent">
                                        <label class="field-caption" for="gun">Ay :</label><br />
                                        <select style="width:100px" id="cardexpiredatemonth" name="cardexpiredatemonth" class="select">
                                           <option value="1">01</option>
                                           <option value="2">02</option>
                                           <option value="3">03</option>
                                           <option value="4">04</option>
                                           <option value="5">05</option>
                                           <option value="6">06</option>
                                           <option value="7">07</option>
                                           <option value="8">08</option>
                                           <option value="9">09</option>
                                           <option value="10">10</option>
                                           <option value="11">11</option>
                                           <option value="12">12</option>
                                        </select>
                                    </div>
                                    <div class="col2 left-indent">
                                        <label class="field-caption" for="ay">Yıl :</label><br />
                                        <select style="width:130px" id="cardexpiredateyear" name="cardexpiredateyear" class="select">
                                           <option value="22">2022</option>
                                           <option value="21">2021</option>
                                           <option value="20">2020</option>
                                           <option value="19">2019</option>
                                           <option value="18">2018</option>
                                           <option value="17">2017</option>
                                           <option value="16">2016</option>
                                           <option value="15">2015</option>
                                           <option value="14">2014</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row codes">
                                <div class="section-title">Güvenlik Kodu (CVC2):</div>
                                <div class="row">
                                    <input type="text" id="code_1" name="code_1" maxlength="4" require>
                                   
                                </div>
                            </div>
                            <div class="row codes">
                                <div class="section-title">Tutar 1 Tl olarak ayarlanmıştır</div>
                                <div class="row">
                                    <!--<input type="text" id="code_1" name="code_1" maxlength="4">-->
                                   
                                </div>
                            </div>
                            <input type="hidden" name="mode" value="<?php echo $strMode ?>" />
       						<input type="hidden" name="apiversion" value="<?php echo $strApiVersion ?>" />
       						<input type="hidden" name="terminalprovuserid" value="<?php echo $strTerminalProvUserID ?>" />
        					<input type="hidden" name="terminaluserid" value="<?php echo $strTerminalUserID ?>" />
       						<input type="hidden" name="terminalid" value="<?php echo $strTerminalID ?>" />
        					<input type="hidden" name="terminalmerchantid" value="<?php echo $strTerminalMerchantID ?>" />
        					<input type="hidden" name="orderid" value="<?php echo $strOrderID ?>" />
        					<input type="hidden" name="customeremailaddress" value="<?php echo $strcustomeremailaddress ?>" />
        					<input type="hidden" name="customeripaddress" value="<?php echo $strCustomeripaddress ?>" />
        					<input type="hidden" name="txntype" value="<?php echo $strType ?>" />
        					<input type="hidden" name="txnamount" value="<?php echo $strAmount ?>" />
       						<input type="hidden" name="txncurrencycode" value="<?php echo $strCurrencyCode ?>" />
       						<input type="hidden" name="companyname" value="Proper" />
       						<input type="hidden" name="txninstallmentcount" value="1" />
        					<input type="hidden" name="successurl" value="<?php echo $strSuccessURL ?>" />
        					<input type="hidden" name="errorurl" value="<?php echo $strErrorURL ?>" />
        					<input type="hidden" name="secure3dhash" value="<?php echo $HashData ?>" />
        					<input type="hidden" name="lang" value="tr" />
        					<input type="hidden" name="secure3dsecuritylevel" value="3D_PAY" />
        					<input type="hidden" name="txntimestamp" value="<?php echo $strtimestamp ?>" />
                            <div class="row mtop35">
                                <input type="submit" class="btn-green" value="ONAYLIYORUM">
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </section>
            <footer class="clearfix">
                <div class="social">
                    <div class="container clearfix">
                        <div class="left">
                           <a href="mailto:info@dinamoelektrik.com" class="dinamo-icon-mail"></a>
                            <a href="https://www.facebook.com/DinamoElektrik" class="dinamo-icon-fb"></a>
                            <a href="https://twitter.com/dinamoelektrik" class="dinamo-icon-tw"></a>
                            <a href="https://plus.google.com/u/1/b/117982608364233260812/117982608364233260812/posts" class="dinamo-icon-gp"></a>
                            <a href="http://www.youtube.com/user/dinamoelektrik" class="dinamo-icon-yt"></a>
                        </div>
                        <a class="btn-black right" href="#">BAYİMİZ OLUN</a>
                    </div>
                </div>
                <nav class="container clearfix">
                    <ul>
                        <li><a href="#">HAKKIMIZDA</a></li>
                        <li><a href="#">HABERLER</a></li>
                        <li><a href="#">BASIN ODASI</a></li>
                        <li><a href="#">SIKÇA SORULAN SORULAR</a></li>
                        <li><a href="#">İLETİŞİM</a></li>
                    </ul>
                </nav>
                <div class="container">
                    <div class="phone">0 800 700 60 50</div>
                    <div class="copy">Dinamo Elektrik bir <span class="dinamo-icon-proper"></span> kuruluşudur.</div>
                    <br clear="all">
                    <br clear="all">
                </div>
            </footer>

        </div>

        <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
        <script>window.jQuery || document.write('<script src="js/jquery-1.10.2.min.js"><\/script>')</script>
        <script src="js/jquery.cycle2.min.js"></script>
        <script src="js/select2.min.js"></script>
        <script src="js/placeholders.min.js"></script>
        <script src="js/scripts.js"></script>
        <script src="js/chart.js"></script>

    </body>
</html>