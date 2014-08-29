$(document).ready(function() {
        $('.select').select2({
            minimumResultsForSearch: -1
        });

        $('#indirim').change(function () {
        $('#indirim-kod').fadeToggle();
      });

      $('.map-to').bind('blur', function () {
          if ( $(window).width() < 800 ) {
            return;
          }
          $('#'+ $(this).data('href') ).addClass('hide');
          $('#map-abone-grubu').addClass('hide');
      }).bind('focus', function () {
          if ( $(window).width() < 800 ) {
            return;
          }
          $('#'+ $(this).data('href') ).removeClass('hide');
          $('#map-abone-grubu').addClass('hide');
      });

      $(".abone-grubu").change(function() {
          $('#map-abone-grubu').removeClass('hide');
      });
      var $dd = $('nav.secondary'),
          $navbar = $('#navbar').length>0 ? $('#navbar') : $('aside.green-bg'),
          $mainDd = $('.hidden-dd'),
          $nestedDd = $('header .nested-dd ul');

      $('#user-info-wrapper .selected').on('click', function( e ) {
        if ( $dd.is(':visible') ) {
          $dd.slideUp();
          $('body').off('click.close tap.close');
          return;
        }
        $dd.slideDown();
        $navbar.css('left', -$navbar.width() + 'px');
        $navbar.addClass('forced-left');
        $mainDd.slideUp();
        e.stopImmediatePropagation();
        $('body').on('click.close tap.close', function( e ) {
          if ( $(e.target).parents('.secondary').length == 0 ) {
            $('nav.secondary').slideUp();
            $('body').off('click.close tap.close');
          }
        })
      })
      $('.show-menu-btn').on('click', function( e ) {
        $navbar.css({'left': 0});
        $mainDd.slideUp();
        $nestedDd.slideUp();
        $dd.slideUp();

        $navbar.removeClass('forced-left');
        e.stopImmediatePropagation();
        $('body').on('click.close tap.close', function(e) {
          if ( $(e.target).parents('#navbar').length == 0 ) {
            $navbar.css('left', -$navbar.width() + 'px');
            $navbar.addClass('forced-left');
            $('body').off('click.close tap.close');
          }
        })
      })
      $('#navbar div input').on('click', function() {
        $navbar.css('left', -$navbar.width() + 'px');
        $navbar.addClass('forced-left');
        $('body').off('click.close tap.close');
      })
      $('.menu-icon').on('click', function( e ) {
        if ( $mainDd.is(':visible') ) {
          $mainDd.slideUp();
          $nestedDd.slideUp();
          $('body').off('click.close tap.close');
          return;
        }
        $mainDd.slideDown();
        $navbar.css('left', -$navbar.width() + 'px');
        $navbar.addClass('forced-left');
        $dd.slideUp();
        e.stopImmediatePropagation();
        $('body').on('click.close tap.close', function( e ) {
          if ( $(e.target).parents('.secondary').length == 0 ) {
            $mainDd.slideUp();
            $nestedDd.slideUp();
            $('body').off('click.close tap.close');
          }
        })
      })
      $('.show-nested-item a').on('click',function( e ) {
          e.stopImmediatePropagation();
          if ( !$nestedDd.is(':visible') ) {
            $nestedDd.slideDown();
            return;
          };
          return false
      })
      $('#check-all').on('change', function() {
        $('.select-table input[type="checkbox"]').not(this).prop('checked', $(this).prop('checked') );
        updateValue();
      })
      $('.select-table input[type="checkbox"]').not( $('#check-all')[0] ).on('change', updateValue);

      function updateValue() {
        var sum = 0;
        $('.select-table input[type="checkbox"]:checked').not( $('#check-all')[0] ).each(function() {
          sum += parseFloat( $(this).parent().parent().find('td:last').html() );
        })
        $('#total-val').html( sum.toFixed(2) + ' TL');
      }

     //sade form sayfası için kapattım   $(".nano").nanoScroller({ alwaysVisible: true });

  //tab script

        $('.tab-content > div.tab:first-child').show();
        $(".tab-menu li a").click(function(event) {
              event.preventDefault();
              $(this).parent().addClass("active");
              $(this).parent().siblings().removeClass("active");
              var tab = $(this).attr("href");
              $(".tab-content div.tab").not(tab).css("display", "none");
              $(tab).fadeIn();
          });

  });

$(function() {

   // fade in divs
var fadein = $('div.lazy');
$.each(fadein, function(i, item) {
  setTimeout(function() {
    $(item).fadeIn(1000); // duration of fadein
  }, 1000 * i) // duration between fadeins
  });

   // sss accordion
 var allPanels = $('.accordion > dd').hide();

  $('.accordion > dt > a').click(function() {
    $('.accordion > dt').removeClass('border-bottom-none');
    allPanels.slideUp();
    $('compare-box').addClass('border-bottom-none');
    $(this).parent().next().slideDown();
    return false;
  });

   // tarife detay aç/kapa



//modal window script
     $('.open-modal').on('click', function() {
        var popupId = $(this).attr('href') ? $(this).attr('href').replace('#', '') : undefined,
            $popup = $('#' + popupId );
        if ( $popup.length > 0 ) {
          $popup.parent().fadeIn(200);
        }
        return false;
     })
     $('.modal_close').on('click', function() {
       $(this).parents('.modal-popup-wrapper').fadeOut(200);
       return false;
     })
     $('.modal-popup-wrapper').on('click', function( e ) {
       if ( $(e.target).parents('.modal').length == 0 ) {
        $(this).fadeOut(200);
       }
     })
     /*$(".open-modal").leanModal({
        overlay : 0.4,
        closeButton: ".modal_close"
      });*/


 // tarife sihirbazı soru aç/kapa

  $( ".next-question" ).click(function() {
      var wrapper = $( ".next-question" ).parents('form'),
          soruid = $(this).data("id");
      $('.question-content', wrapper).hide();
      $('.question-content[data-id='+ soruid +']', wrapper).fadeToggle("fast");
      return false;
  });



});


//Tarife karşılaştırma script
 $('#open,#compare-container > .container > a').hide();

                function getSelectedIds() {
                    return $('.box .prod-id').map(function() { return $(this).text(); }).toArray();
                }

                function updateLinkAndCounter() {
                    var ids = getSelectedIds().map(function(x,i) {
                        return ['P', ++i, '=', x].join('');
                    });
                    // $("p.alert-text").text(ids.length >= 2 ? $('#compare-container > .container > a').attr('href', '#' + ids.join('&')).attr('id','openDiv').show() : $('#open,#compare-container > .container > a').hide() );
                    $("p.alert-text").text(ids.length >= 2 ? $('#compare-container > .container > a').attr('href', '#open-modal2' ).attr('id','openDiv').show() : $('#open,#compare-container > .container > a').hide() );
                        $("#alert").text(ids.length == 1 ? 'Karşılaştırma yapabilmek için en az 1 adet tarife daha eklemelisiniz' : '' );
                }

                $(".compare-btn").click(function() {
                    var id=$(this).data('comparename'); //$(this).next('.ProdId').text();

                    var selected = getSelectedIds();
                    if(selected.length == 3) return;
                    if(selected.indexOf(id) != -1) return; // item already added

                    $('<div/>', { 'class': 'box' })
                    .append($('<span/>', { class: 'prod-id', text: id }))
                    .append($('<a/>', { class: 'close', href: '#', text: 'x', id: id }))
                       .appendTo('#compare-container > .container');
                    $(this).addClass("added").text('Eklendi');
                    updateLinkAndCounter();
                    $("#compare-container").removeClass("hidden");
                    return false; 
                });

                $( document ).on("click",'.close', function() {
                    $(this).parent().remove();
                    id = $(this).attr('id');
                    $('a[data-comparename="'+ id +'"]').removeClass("added").text('Karşılaştır');
                    updateLinkAndCounter();
                    return false; 
                });
                $( document ).on("click",'.added', function() {
                    return false;
                    });
///

        $("#fullname").keypress(function (evt) {

             var charCode = (evt.which) ? evt.which : event.keyCode
            if (((charCode <= 93 && charCode >= 65) || (charCode <= 122 && charCode >= 97) || charCode == 8) || charCode == 350 || charCode == 351 || charCode == 304 || charCode == 286 || charCode == 287 || charCode == 231 || charCode == 199 || charCode == 305 || charCode == 214 || charCode == 246 || charCode == 220 || charCode == 252 || charCode == 32) {
                return true;

            }
            else{
              alert('Bu alana sadece karakter giribilirsiniz.');
              return false;
            }
            

        });
        $("#tckn,#mobil,#birthday").keypress(function (evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode  != 8 && charCode  != 0 && (charCode  < 48 || charCode  > 57)) {
                alert('Bu alana sadece rakam girebilirsiniz.');
                return false;
            }
        });
        

//parsey i 18n

window.ParsleyConfig = window.ParsleyConfig || {};
window.ParsleyConfig.i18n = window.ParsleyConfig.i18n || {};

// Define then the messages
window.ParsleyConfig.i18n.tr = $.extend(window.ParsleyConfig.i18n.tr || {}, {
  defaultMessage: "Bu değer geçerli değil.",
  type: {
    email:        "Geçerli bir e-posta adresi yazınız.",
    url:          "Geçerli bir bağlantı adresi yazınız.",
    number:       "Geçerli bir sayı yazınız.",
    integer:      "Geçerli bir tamsayı yazınız.",
    digits:       "Geçerli bir rakam yazınız.",
    alphanum:     "Geçerli bir alfanümerik değer yazınız."
  },
  notblank:       "Bu alan boş bırakılmamalıdır.",
  required:       "Bu alan gereklidir.",
  pattern:        "Girdiğiniz değer geçerli değil.",
  min:            "Bu alan %s değerinden büyük ya da eşit olmalıdır.",
  max:            "Bu alan %s değerinden küçük ya da eşit olmalıdır.",
  range:          "Bu alan %s ve %s değerleri arasında olmalıdır.",
  minlength:      "Girdiğiniz değer çok kısa. Bu alan %s değerine eşit ya da fazla olmalıdır.",
  maxlength:      "Girdiğiniz değer çok uzun. Bu alan %s değerine eşit ya da az olmalıdır.",
  length:         "Girdiğiniz değerin uzunluğu geçersiz. Bu alanın uzunluğu %s ve %s arasında olmalıdır.",
  mincheck:       "En az %s adet seçim yapmalısınız.",
  maxcheck:       "En fazla %s ya da daha az seçim yapmalısınız.",
  check:          "Bu alan için en az %s en fazla %s seçim yapmalısınız.",
  equalto:        "Bu alanın değeri aynı olmalıdır."
});

// If file is loaded after Parsley main file, auto-load locale
//if ('undefined' !== typeof window.ParsleyValidator)
//  window.ParsleyValidator.addCatalog('tr', window.ParsleyConfig.i18n.tr, true);




//window.ParsleyValidator.setLocale('tr');

//api.php
//
    var domain = window.location.host;
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

function doSomething(obj)
{
console.log($(obj).data('id'));
//$( ".schedule-details-link" ).click();
$('.schedule-open .close').toggle();
$(".compare-box > a[id^='karsilastir-']").show();
$('.compare-box').removeClass('schedule-open');
$(obj).parent().addClass('schedule-open');
$('.schedule').hide();
$('.schedule-open .close').show();
var soruid = $(obj).data("id");
$('.schedule .schedule-details[data-id='+ soruid +']').parent().slideToggle("fast");
$(".compare-box.schedule-open > a[id^='karsilastir-']").toggle();
  //burada ibnelik
return false;
 
}


$( ".schedule-details-link" ).click(function(e) {
     e.preventDefault();
      // alert('adsfsad');
      $('.schedule-open .close').hide();
      $(".compare-box > a[id^='karsilastir-']").show();
      $('.compare-box').removeClass('schedule-open');
      $(this).parent().addClass('schedule-open');
      $('.schedule').hide();
      $('.schedule-open .close').show();
      var soruid = $(this).data("id");
      $('.schedule .schedule-details[data-id='+ soruid +']').parent().slideToggle("fast");
      $(".compare-box.schedule-open > a[id^='karsilastir-']").hide();
    
      return false;

  });




  $( ".close a" ).click(function() {
      $('.schedule').hide();
      $('.schedule-open .close').hide();
      $('.compare-box').removeClass('schedule-open');
      $(".compare-box > a[id^='karsilastir-']").show();

       return false;
  });

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


  var mixbasket = $(function(){
  
    $.ajax({
      type: 'GET',
      url: '//'+domain+'/api.php?api=rmJ9E57uyk84277&prog=statement&type=bireysel',
      success: function(data){
        var content = '';
        $.each($.parseJSON(data),function(){
          //console.log(data);
          
          //burası
          //
          var randomKey = guid();
            content += '<div class="compare-box">';
            content += '<div class="close"><a href="javascript:void(0)">x</a></div>';
            content += '<h3><b>'+this.kampanyabaslik+'</b> Tarifesi</h3>';
            content += '<img src="//'+domain+'/media/campain/'+this.kampanyaresim+'" alt="">';
            content += '<p>'+this.kampanyakisa+'</p>';
            content += '<a onclick="doSomething(this)" class="text-link schedule-details-link" data-id="'+this.kampanyaid+'">Tarife Detayları</a>';
            content += '<div class="share-btns">';
            content += '<a href="https://'+domain+'/share.php?key=rmJ9E57uyk84277&type=1&content='+this.share[0].icerikid+'" target="_blank" class="dinamo-icon-fb"></a>';
            content += '<a href="https://'+domain+'/share.php?key=rmJ9E57uyk84277&type=2&content='+this.share[1].icerikid+'" target="_blank" class="dinamo-icon-tw"></a>';
            content += '<a href="https://'+domain+'/share.php?key=rmJ9E57uyk84277&type=3&content='+this.share[2].icerikid+'" target="_blank" class="dinamo-icon-gp"></a>';
            content += '<a href="https://'+domain+'/share.php?key=rmJ9E57uyk84277&type=4&content='+this.share[3].icerikid+'" target="_blank" class="dinamo-icon-in"></a>';
            content += '<a href="https://'+domain+'/share.php?key=rmJ9E57uyk84277&type=5&content='+this.share[4].icerikid+'" target="_blank" class="dinamo-icon-mail"></a>';
            content += '</div>';
            content += '<a href="#" class="btn-orange left">Tarifeyi Seç</a>';
            content += '<a href="#" id="'+this.kampanyabaslik.replace(/\s/g, '-').replace(/[^\w/-]/g, '').toLowerCase()+'" data-comparename="'+this.kampanyabaslik+'" class="right compare-btn">Karşılaştır</a>';
            content += '</div>';
            content += '<div class="schedule">';
            content += '<div class="schedule-details" data-id="'+this.kampanyaid+'">';
            content += '<ul class="tab-menu">';
            content += '<li class="col3-1 active"><a href="#tab1'+randomKey+'">Avantajlar1</a></li>';
            content += '<li class="col3-1"><a href="#tab2'+randomKey+'">Şartlar</a></li>';
            content += '<li class="col3-1"><a href="#tab3'+randomKey+'">Fiyatlar</a></li>';
            content += '</ul>';
            content += '<div class="tab-content">';
            content += '<div class="tab" id="tab1'+randomKey+'">';
            content += '<ul>';
            content += '<li>Lorem ipsum dolor sit amet.</li>';
            content += '<li>Doloremque reprehenderit pariatur similique, ipsa?</li>';
            content += '<li>Repellendus earum illo officia ullam!</li>';
            content += '<li>Explicabo nulla, eaque odit reiciendis!</li>';
            content += '<li>Dolorem iusto nemo necessitatibus laboriosam.</li>';
            content += '<li>Cupiditate a doloremque facere molestias.</li>';
            content += '<li>Cum iste, maiores distinctio expedita.</li>';
            content += '<li>Voluptatum perspiciatis, maiores temporibus. Assumenda.</li>';
            content += '</ul>';
            content += '</div>';
            content += '<div class="tab" id="tab2'+randomKey+'">';
            content += '<ul>';
            content += '<li>Explicabo nulla, eaque odit reiciendis!</li>';
            content += '<li>Dolorem iusto nemo necessitatibus laboriosam.</li>';
            content += '<li>Cupiditate a doloremque facere molestias.</li>';
            content += '<li>Cum iste, maiores distinctio expedita.</li>';
            content += '<li>Voluptatum perspiciatis, maiores temporibus. Assumenda.</li>';
            content += '</ul>';
            content += '</div>';
            content += '<div class="tab" id="tab3'+randomKey+'">';
            content += '<ul>';
            content += '<li>Lorem ipsum dolor sit amet.</li>';
            content += '<li>Doloremque reprehenderit pariatur similique, ipsa?</li>';
            content += '<li>Repellendus earum illo officia ullam!</li>';
            content += '<li>Cum iste, maiores distinctio expedita.</li>';
            content += '<li>Voluptatum perspiciatis, maiores temporibus. Assumenda.</li>';
            content += '</ul>';
            content += '</div>';
            content += '<a href="#" class="btn-green">HEMEN BAŞVUR</a>';
            content += '<a href="#" id="karsilastir-tarife-zamlanmayan" class="right compare-btn" data-comparename="Zamlanmayan Tarife">Karşılaştır</a>';
            content += '</div>';
            content += '</div>';
            content += '</div>';

           







          //

        });
        $('#campain').append(content);
      }
    });
  });

console.log('gir');

//parsey
//
$('.next').on('click', function () {
    var current = $(this).data('currentBlock'),
      next = $(this).data('nextBlock');

    // only validate going forward. If current group is invalid, do not go further
    // .parsley().validate() returns validation result AND show errors
    if (next > current)
      if (false === $('#bireysel-form').parsley().validate('block' + current))
        return;

    // validation was ok. We can go on next step.
    $('.block' + current)
      .removeClass('show')
      .addClass('hidden');

    $('.block' + next)
      .removeClass('hidden')
      .addClass('show');

  });
  $('#dolu').hide();
    
 

    $('#bireselHesaplaBtn').click(function(event){
        event.preventDefault();
        if($('#bireyselHesapla').val() == ''){
            alert('Lütfen Fiyat Giriniz');
        }
        else{
            if($('#bireyselTarife').val() == 1){
                alert('Yararlanmak istediğiniz tarifeyi seçiniz!');
                
            }
            else{

                $('#bos').hide();
                $('#dolu').show();
                var fiyat = $('#bireyselHesapla').val();
                //var indirim = Math.round(fiyat - (fiyat * ($('#bireyselTarife').val()/100)));
                var indirim = Math.round(fiyat * ($('#bireyselTarife').val()/100));
                $('.fz26').html(indirim+' TL');
                if($('#bireyselTarife').val() == 3){
                   $('.tarifeadi').html('Tarife İki %3');  
                }
                else{
                  $('.tarifeadi').html('Tarife bir  %4'); 
                }
               
            }
            
            
        }
        //
    });
     $('#nekoyam').hide();
    $('#bireselHesaplaBtn2').click(function(event){
        event.preventDefault();
        if($('#bireyselHesapla2').val() == ''){
            alert('Lütfen Fiyat Giriniz');
        }
        else{
            if($('#bireyselTarife2').val() == 1){
                alert('Yararlanmak istediğiniz tarifeyi seçiniz!');
                
            }
            else{

                $('#gizli').hide();
                $('#nekoyam').show();
                var fiyat = $('#bireyselHesapla2').val();
                //var indirim = Math.round(fiyat - (fiyat * ($('#bireyselTarife').val()/100)));
                var indirim = Math.round(fiyat * ($('#bireyselTarife2').val()/100));
                $('.fz26').html(indirim+' TL');
                if($('#bireyselTarife2').val() == 3){
                   $('.tarifeadi').html('Tarife İki %3');  
                }
                else{
                  $('.tarifeadi').html('Tarife bir  %4'); 
                }
               
            }
            
            
        }
        //
    });
$('#bireyselYeniden2').click(function(event){
        event.preventDefault();

         $('#gizli').show();
         $('#nekoyam').hide();

    });
    $('#bireyselYeniden').click(function(event){
        event.preventDefault();

         $('#bos').show();
         $('#dolu').hide();

    });


   





