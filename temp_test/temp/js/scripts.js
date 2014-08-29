$(document).ready(function() {


//cros domain 
	var porotokol = 'https://';
	var domain = window.location.host ;
//cros domain

//global settings  
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
//error block 

//





$(errorBlock).hide();


/*var errorAlert = (function(element){

}); sonrası burayı düzenle*/

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



//select box group
	$('.select').select2({
        minimumResultsForSearch: -1
	});
//select box group

//global validator

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

//integer decimal input


//tcno 

            

var remoteTc = (function(username,year,tcno){
	///37750676124
		var tcnostatus;
	   $.ajax({
        type: 'GET',
        url: '//'+domain+'/api.php?api=rmJ9E57uyk84277&prog=tcno&ad='+username+'&year='+year+'&tcno='+tcno,
        success: function(data) {
        	var status;
            $.each($.parseJSON(data), function() {
                  // console.log(this.statusid);
                   status = this.statusid;
            });
            //status;
            console.log(status);
        }
    });
	   
});


console.log(remoteTc('Görkem Özkan','1983','37750676124'));


var fixValueTcno = (function(element){
	$(element).blur(function(){

		var tcno = $(element).val();
		

		var toplam = Number(tcno.substring(0,1)) + 
					 Number(tcno.substring(1,2)) + 
					 Number(tcno.substring(2,3)) + 
					 Number(tcno.substring(3,4)) + 
					 Number(tcno.substring(4,5)) + 
					 Number(tcno.substring(5,6)) +
					 Number(tcno.substring(6,7)) +
					 Number(tcno.substring(7,8)) +
					 Number(tcno.substring(8,9)) +
					 Number(tcno.substring(9,10)) ;
		
		strtoplam = String(toplam);
		onunbirlerbas = strtoplam.substring(strtoplam.length, strtoplam.length-1);
		
		if(onunbirlerbas == tcno.substring(10,11)){
			
			if(remoteTc('Görkem Özkan','1983',tcno) !== 1){
				$(errorBlock).hide();
				$(this).css('border-color', 'yellow');
				return true;
			}
			else{
				$(errorBlock).fadeTo(200,0.1,function(){
            	  	$(this).html(fixTcnoError).addClass(errorClass).fadeTo(900,1,function(){
              		//fantazisi
        	      	});
    	         });
				$(this).css('border-color', 'red');		
			}
		}
		
		else{
			$(errorBlock).fadeTo(200,0.1,function(){
              	$(this).html(fixTcnoError).addClass(errorClass).fadeTo(900,1,function(){
              		//fantazisi
              	});
             });
			$(this).css('border-color', 'red');
		}
	
	});

});
//tcno 
//
//birthday
var fixValueBirthday = (function(element){
	$(element).blur(function(){
		var b = $(element).val();
		var d = new Date();
		var n = d.getFullYear();
		var c = n - b ;

		if(c < minAge){
			$(errorBlock).fadeTo(200,0.1,function(){
              	$(this).html(fixBirthdayMinError).addClass(errorClass).fadeTo(900,1,function(){
              		//fantazisi
              	});
             });
			$(this).css('border-color', 'red');
			return false;

		}
		else if(c > maxAge){
			$(errorBlock).fadeTo(200,0.1,function(){
              	$(this).html(fixBirthdayMaxError).addClass(errorClass).fadeTo(900,1,function(){
              		//fantazisi
              	});
             });
			$(this).css('border-color', 'red');
			return false;
	
		}
		
		else{
			//console.log('olumlu');
			$(errorBlock).hide();

			$(this).css('border-color', 'yellow');
			return true;
		}
	
		//console.log(c);
	});
});
//birthday

//mobil phone number turkish
var fixValueMobil = (function(element){
	//uygun format
		
	$(element).blur(function(){
		var m = $(element).val();
	
			var c = Number(m.substring(0,1));
			if(c == 5 ){
				if(m.length == 10){

					$(errorBlock).hide();
					$(this).css('border-color', 'yellow');
					return true;
				}
				else{

					$(errorBlock).fadeTo(200,0.1,function(){
              			$(this).html(fixMobilFormatError).addClass(errorClass).fadeTo(900,1,function(){
              			//fantazisi
              			});
             		});	
             		$(this).css('border-color', 'red');
				}

		}
		else{
			$(errorBlock).fadeTo(200,0.1,function(){
              	$(this).html(fixMobilFormatError).addClass(errorClass).fadeTo(900,1,function(){
              		//fantazisi
              	});
             });
			$(this).css('border-color', 'red');

		}
	});
});
//mobil phone number turkish


//phone number turkish
var fixValuePhone = (function(element){
	$(element).blur(function(){

		var p = $(element).val();
		
			var c = Number(p.substring(0,1));
			if(c == 2 || c == 3 || c == 4 ){
				if(p.length == 10){

					$(errorBlock).hide();
					$(this).css('border-color', 'yellow');
					return true;
				}
				else{

					$(errorBlock).fadeTo(200,0.1,function(){
              			$(this).html(fixPhoneFormatError).addClass(errorClass).fadeTo(900,1,function(){
              			//fantazisi
              			});
        			});

				$(this).css('border-color', 'red');
				}
			}
			else{
				$(errorBlock).fadeTo(200,0.1,function(){
              		$(this).html(fixPhoneFormatError).addClass(errorClass).fadeTo(900,1,function(){
              			//fantazisi
              		});
        		});
        		$(this).css('border-color', 'red');
			}
	
	});
});
//phone number turkish


//email adress
var fixValueEmail = (function(element){
	$(element).blur(function(){
		var email = $(element).val();
	

			if( !email.match(/\S+@\S+\.\S+/) ){
				$(errorBlock).fadeTo(200,0.1,function(){
            	  	$(this).html(fixEmailError).addClass(errorClass).fadeTo(900,1,function(){
              		//fantazisi
              	});
        	});
			$(this).css('border-color', 'red');
			return false;
			}
			else if( email.indexOf(' ') != -1 || email.indexOf('..') != -1){
				$(errorBlock).fadeTo(200,0.1,function(){
              		$(this).html(fixEmailError).addClass(errorClass).fadeTo(900,1,function(){
              		//fantazisi
              		});
        		});
        		$(this).css('border-color', 'red');
				return false;
			}
			else{
				$(errorBlock).hide();
				$(this).css('border-color', 'yellow');
				return true;
			}	
	
		
	});
});




//email adress

//tcno 



//require block

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

//require block

//select validate

/*var fixValueSelect = (function(element){
	$(element).change(function(){
		var sdata = $(element).val();
		//if()
		if(sdata == '' || stada == '0' || sdata = null){
			$(errorBlock).fadeTo(200,0.1,function(){
              	$(this).html(fixSelectError).addClass(errorClass).fadeTo(900,1,function(){
              		//fantazisi
              	});
        	});
			return false;
		}
		else{
			return true;
		}
		console.log(sdata);
	});
});*/
//select validate

fixValueCharacter('#fullname');//test
fixValueInt('#tckn,#birthday,#mobil,#phone');//test
fixValueTcno('#tckn');//test
fixValueBirthday('#birthday');//test
fixValueMobil('#mobil');//test
fixValuePhone('#phone');//test
fixValueEmail('#eposta');//test
//fixValueSelect('#city');

//step1

//console.log(creaRequire('.stepOne'));
$('.next').click(function(){
	console.log(creaRequire('.stepOne'));
	if(creaRequire('.stepOne') == true){
		//alert('geçebilin');
		$(errorBlock).hide();
		console.log('gectim');
	}
	else{

		console.log('gecemedim');
		return false;
	}

});


//creaRequire('.stepOne');





//global validator
//
//

//global get params


//il ve ilçe
var city = $(function() {

    $.ajax({
        type: 'GET',
        url: '//'+domain+'/api.php?api=rmJ9E57uyk84277&prog=city',
        success: function(data) {
            var options = '';
            $.each($.parseJSON(data), function() {
                    //console.log(this.adi);
                options += '<option value=' + this.il + '>' + this.adi + '</option>';
            })
            $('#city').html(options);
            $('#city').on('change', function() {
                var cityID = this.value;
                $.ajax({
                    type: 'GET',
                    url: '//'+domain+'/api.php?api=rmJ9E57uyk84277&prog=state&id=' + cityID,
                    success: function(data) {

                        var states = '';
                        $.each($.parseJSON(data), function() {
                            states += '<option value=' + this.ilce + '>' + this.adi + '</option>';
                        });
                        $('#region').html(states);
                        $("#region").select2({allowClear: true, showSearchBox: false});
                    }
                });
            });
        }
    });
});

//il ve ilçe

//basvuru formu atraksiyonları
//basvuru formu ataraksiyonları


//frontend
$('#indirim').change(function () {
	$('#indirim-kod').fadeToggle();
});

});