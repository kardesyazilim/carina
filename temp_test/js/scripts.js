$(document).ready(function() {





//cros domain 
	var porotokol = 'https://';
	var domain = window.location.host ;
//cros domain

//security api key
	var guid = (function() {
  		function s4() {
    		return Math.floor((1 + Math.random()) * 0x10000)
               .toString(16)
               .substring(1);
  		}
  		return function() {
    	return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
           s4() + '-' + s4() + s4() + s4();
  		};
	})();
//security api key 

var minAge = '18';
var maxAge = '100';
var errorBlock = '.bottom-info-block';
var errorClass = 'red';
//error block 
var fixValueCharacterError = '<p>Bu alana sadece karakter girebilirsiniz</p><i class="ico-error"></i>';
var fixValueCharacterBlankError = '<p>Zorunlu alanları doldurunuz.</p><i class="ico-error"></i>';
var fixIntError = '<p>Bu alana sadece rakam girebilirsiniz</p><i class="ico-error"></i>';
var fixTcnoError = '<p>Girmiş olduğunuz TCNO hatalı</p><i class="ico-error"></i>';
var fixTcnoBlankError = '<p>Tc kimlik no giriniz</p><i class="ico-error"></i>';
var fixBirthdayBlankError = '<p>Doğum yılınızı giriniz.</p><i class="ico-error"></i>';
var fixBirthdayMinError = '<p>18 yaşından büyükler başvurada bulunabilir.</p><i class="ico-error"></i>';
var fixBirthdayMaxError = '<p>100 yaşından küçükler başvuruda bulunabilir.</p><i class="ico-error"></i>';
var fixMobilFormatError = '<p>Cep telefonu formatı başında 0 olmadan 5XXXXXXXXX ve 10 rakamdan oluşmalıdır ör: 5123456789</p><i class="ico-error"></i>';
var fixMobilBlankError  =  '<p>Cep telefonu giriniz.</p><i class="ico-error"></i>';
var fixPhoneFormatError = '<p>Sabit telefon formatı başında 0 olmadan 2XXXXXXXXX ve 10 rakamdan oluşmalıdır ör: 2123456789</p><i class="ico-error"></i>';
var fixPhoneBlankError = '<p>Sabit telefonu giriniz.</p><i class="ico-error"></i>';
var fixRequireBlankError = '<p>Zorunlu alanları doldurunuz.</p><i class="ico-error"></i>';
var fixEmailError = '<p>Geçerli bir mail adresi giriniz. ör: ornek@dinamoelektrik.com</p><i class="ico-error"></i>';
var fixEmailBlankError = '<p>Email adresi giriniz.</p><i class="ico-error"></i>';

var fixSelectError = '<p>İl ilçe bilgilerinizi giriniz.</p><i class="ico-error"></i>';

//select box group
	$('.select').select2({
        minimumResultsForSearch: -1
	});
//select box group

//global validator
//error block 
$('.bottom-info-block').hide();
//charecter input
var fixValueCharacter = (function(element){
  var valueCharacter = $(element).val();  
  $(element).keypress(function (evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
        if (((charCode <= 93 && charCode >= 65) || (charCode <= 122 && charCode >= 97) || charCode == 8) || charCode == 350 || charCode == 351 || charCode == 304 || charCode == 286 || charCode == 287 || charCode == 231 || charCode == 199 || charCode == 305 || charCode == 214 || charCode == 246 || charCode == 220 || charCode == 252 || charCode == 32) {
           
            $(errorBlock).hide();

      $(this).css('border-color', 'yellow');
              return true;
           }
            else{
     
                $(errorBlock).fadeTo(200,0.1,function(){
                $(this).html(fixValueCharacterError).addClass(errorClass).fadeTo(900,1,function(){
                  //fantazisi
                });
              });
              return false;
            }
            

        }); 
});
//charecter input
//integer decimal input
var fixValueInt = (function(element){
  $(element).keypress(function (evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode  != 8 && charCode  != 0 && (charCode  < 48 || charCode  > 57)) {
            $(errorBlock).fadeTo(200,0.1,function(){
                $(this).html(fixIntError).addClass(errorClass).fadeTo(900,1,function(){
                  //fantazisi
                });
             });
            return false;
        }
        else{
          $(errorBlock).hide();

      $(this).css('border-color', 'yellow');
            return true;
        }
    });
});
fixValueCharacter('#carduser');
fixValueInt('#cardnumber');



var creaRequire = (function(element){
  //error block
  var errorRequire = [];
  $(element + ' :input').filter('[required]:visible').each(function(){
    var cR = $(this).val();
    if(cR == ''){
      if(this.dataset.creaError == 'undefined' || this.dataset.creaError == '' || this.dataset.creaError == null ){
        errorRequire += 'Zorunlu alanları doldurunuz</br>';
        $(this).css('border-color', 'red');
          }
      else{
        errorRequire += this.dataset.creaError+'</br>';
        $(this).css('border-color', 'red');
        
          }


    }
    else{
      $(errorBlock).hide();
      $(this).css('border-color', 'yellow');
      return true;
    }

    //console.log(cR);
    //console.log($(this));
    
  });
  //console.log(errorRequire);
  console.log(errorRequire);
  if(errorRequire == '' || errorRequire == 'undefined' || errorRequire == null ){
    $(errorBlock).hide();
    return true;
  }
  else{
    $(errorBlock).fadeTo(200,0.1,function(){
      $(this).html('<p>'+errorRequire+'</p><i class="ico-error"></i>').addClass(errorClass).fadeTo(900,1,function(){
            //fantazisi
            });
        });
        //return false;
        return false;
    
  }
  
    
  //console.log($('input,textarea,select').filter('[required]:visible'));

  //success blok

});

$( "#banka" ).submit(function() {
if(creaRequire('#banka') == true){
    //alert('geçebilin');
    $(errorBlock).hide();
    console.log('gectim');
  }
  else{

    console.log('gecemedim');
    return false;
  }
});
return false; 






});