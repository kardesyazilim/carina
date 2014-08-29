 <div class="container clearfix main-page">
                <section class="content-section ignore-strict-width">
                    <form class="bb-form" data-parsley-validate>

                        <h2>Bireysel<br> Başvuru Formu</h2>
                        <hr class="green">
                       
                        <ul id="steps">
                            <li class="active dinamo-icon-Kisisel-Bilgiler"><a href="">Bireysel Bilgiler</a></li><li class="dinamo-icon-Fatura-Bilgileri"><a href="">Fatura Bilgileri</a></li><li class="dinamo-icon-Tarifeler"><a href="">Tarife Seç</a></li><li class="dinamo-icon-Ziyaret"><a href="">Ziyaret Zamanı</a></li>
                        </ul>
                        <div class="row control-group">
                            <label class="control-label" for="firma-unvani">Adı Soyadı :</label>
                            <input type="text" id="firma-unvani" name="firma-unvani" placeholder="" data-parsley-range="[4, 20]" >
                        </div>
                        <div class="row">
                            <label for="tckn">TC Kimlik Numarası:</label>
                            <input type="text" id="tckn" name="tckn" placeholder="">
                        </div>
                        <div class="row">
                            <label for="mobil">Mobil Telefon:</label>
                            <input type="tel" id="mobil" name="mobil" placeholder="Mobil Telefon">
                        </div>
                        <div class="row">
                            <label for="eposta">E-Posta Adresi:</label>
                            <input type="email" id="eposta" name="eposta" class="mid" placeholder="" >
                        </div>
                        <div class="row">
                            <div class="col2 right-indent">
                                <label class="field-caption" for="il">İl Seçiniz:</label>
                                <select id="city" name="city" class="select">
                                   <option>Seçiniz</option>
                                   <option value="1">İstanbul</option>
                                   <option value="2">sad</option>
                                   <option value="3">sdsa</option>
                                   <option value="4">sadsa sd</option>
                                </select>
                            </div><div class="col2 left-indent">
                                <label class="field-caption" for="il">İlçe Seçiniz:</label>
                                <select id="region" name="region" class="select">
                                   <option>Seçiniz</option>
                                   <option value="1">Kadıköy</option>
                                   <option value="2">sad</option>
                                   <option value="3">sdsa</option>
                                   <option value="4">sadsa sd</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                        <label for="adres">Adres:</label>
                            <textarea name="adres" id="adres" cols="30" rows="10" placeholder="" data-validation="email"  data-validation-error-msg="Lütfen geçerli bir email adresi giriniz."></textarea>
                        </div>
                        <div class="row">
                            <div class="left"><input type="checkbox" id="indirim" name="indirim" value="indirim"/> <label for="indirim"><span></span>İndirim kuponu kullanmak istiyorum. </label></div>
                        </div>
                        <div class="row" id="indirim-kod">
                            <input type="text" placeholder="Kupon kodunu giriniz.">
                        </div>
                        <div class="row">
                            <input type="submit" class="btn-green" value="DEVAM ET">
                        </div>
                    </form>


                </section>
            </div>