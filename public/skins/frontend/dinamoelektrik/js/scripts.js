$(document).ready(function() {
    $('.select').select2({
        minimumResultsForSearch: -1
    });

    $('#indirim').change(function() {
        $('#indirim-kod').fadeToggle();
    });

    $('.map-to').bind('blur', function() {
        $('#' + $(this).data('href')).addClass('hide');
    }).bind('focus', function() {
        $('#' + $(this).data('href')).removeClass('hide');
    });

    $(".abone-grubu").click(function() {
        $('#map-abone-grubu').removeClass('hide');
    });
    var $dd = $('nav.secondary'),
        $navbar = $('#navbar').length > 0 ? $('#navbar') : $('aside.green-bg'),
        $mainDd = $('.hidden-dd'),
        $nestedDd = $('header .nested-dd ul');

    $('#user-info-wrapper .selected').on('click', function(e) {
        if ($dd.is(':visible')) {
            $dd.slideUp();
            $('body').off('click.close tap.close');
            return;
        }
        $dd.slideDown();
        $navbar.css('left', -$navbar.width() + 'px');
        $navbar.addClass('forced-left');
        $mainDd.slideUp();
        e.stopImmediatePropagation();
        $('body').on('click.close tap.close', function(e) {
            if ($(e.target).parents('.secondary').length == 0) {
                $('nav.secondary').slideUp();
                $('body').off('click.close tap.close');
            }
        })
    })
    $('.show-menu-btn').on('click', function(e) {
        $navbar.css({
            'left': 0
        });
        $mainDd.slideUp();
        $nestedDd.slideUp();
        $dd.slideUp();

        $navbar.removeClass('forced-left');
        e.stopImmediatePropagation();
        $('body').on('click.close tap.close', function(e) {
            if ($(e.target).parents('#navbar').length == 0) {
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
    $('.menu-icon').on('click', function(e) {
        if ($mainDd.is(':visible')) {
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
        $('body').on('click.close tap.close', function(e) {
            if ($(e.target).parents('.secondary').length == 0) {
                $mainDd.slideUp();
                $nestedDd.slideUp();
                $('body').off('click.close tap.close');
            }
        })
    })
    $('.show-nested-item a').on('click', function(e) {
        e.stopImmediatePropagation();
        if (!$nestedDd.is(':visible')) {
            $nestedDd.slideDown();
            return;
        };
        return false
    })
    $('#check-all').on('change', function() {
        $('.select-table input[type="checkbox"]').not(this).prop('checked', $(this).prop('checked'));
        updateValue();
    })
    $('.select-table input[type="checkbox"]').not($('#check-all')[0]).on('change', updateValue);

    function updateValue() {
        var sum = 0;
        $('.select-table input[type="checkbox"]:checked').not($('#check-all')[0]).each(function() {
            sum += parseFloat($(this).parent().parent().find('td:last').html());
        })
        $('#total-val').html(sum.toFixed(2) + ' TL');
    }
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

    $('.accordion > dt').click(function() {
        $('.accordion > dt').removeClass('border-bottom-none');
        allPanels.slideUp();
        $('compare-box').addClass('border-bottom-none');
        $(this).next().slideDown();
        return false;
    });

    // tarife detay aç/kapa

    $(".schedule-details-link").click(function() {
        $('.schedule-open .close').hide();
        $('.compare-box').removeClass('schedule-open');
        $(this).parent().addClass('schedule-open');
        $('.schedule').hide();
        $('.schedule-open .close').show();
        var soruid = $(this).data("id");
        $('.schedule .schedule-details[data-id=' + soruid + ']').parent().slideToggle("fast");
    });

    $(".close a").click(function() {
        $('.schedule').hide();
        $('.schedule-open .close').hide();
        $('.compare-box').removeClass('schedule-open');

        return false;
    });

    //tab script
    $('.tab-content div.tab').hide();
    $('.tab-content div.tab:first').show();

    $('.tab-menu li').click(function() {
        $('.tab-menu li a').removeClass("active");
        $(this).find('a').addClass("active");
        $('.tab-content div.tab').hide();

        var indexer = $(this).index();
        $('.tab-content div.tab:eq(' + indexer + ')').show();
        return false;
    });

    //modal window script
    /*$("#modal").leanModal({
        overlay: 0.4,
        closeButton: ".modal_close"
    });*/
    $('#dolu').hide();
    
    $("#bireyselHesapla").mask("999");

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
                var indirim = Math.round(fiyat*0.05);
                $('.fz26').html(indirim+' TL');    
            }
            
            
        }
        //
    });
    $('#bireyselYeniden').click(function(event){
        event.preventDefault();

         $('#bos').show();
         $('#dolu').hide();

    });



//salaklık ama ne yapalım bizimde kaderimiz(html yollda tamamlamak)
    $('#doluk').hide();
    
    $("#kurumsalHesapla").mask("9999");

    $('#kurumsalHesaplaBtn').click(function(event){
        event.preventDefault();
        if($('#kurumsalHesapla').val() == ''){
            alert('Lütfen Fiyat Giriniz');
        }
        else{
            if($('#kurumsalTarife').val() == 1){
                alert('Yararlanmak istediğiniz tarifeyi seçiniz!');
                
            }
            else{

                $('#bosk').hide();
                $('#doluk').show();
                var fiyat = $('#kurumsalHesapla').val();
                var indirim = Math.round(fiyat*0.05);
                $('.fz26').html(indirim+' TL');    
            }
            
            
        }
        //
    });
    $('#kurumsalYeniden').click(function(event){
        event.preventDefault();

         $('#bosk').show();
         $('#doluk').hide();

    });






    
///
  var bireysel = $(function() {

        $.ajax({
            type: 'GET',
            url: 'https://www.dinamoelektrik.com/post.php?q=tarife&p=bireysel',
            success: function(data) {
                var options = '';
                $.each($.parseJSON(data), function() {
                    //console.log(this.adi);
                    options += '<option value=' + this.ids + '>' + this.adi + '</option>';
                })
                $('#bireyselTarife').html(options);
            }
        });

    });
   var kurumsal = $(function() {

        $.ajax({
            type: 'GET',
            url: 'https://www.dinamoelektrik.com/post.php?q=tarife&p=kurumsal',
            success: function(data) {
                var options = '';
                $.each($.parseJSON(data), function() {
                    //console.log(this.adi);
                    options += '<option value=' + this.ids + '>' + this.adi + '</option>';
                })
                $('#kurumsalTarife').html(options);
            }
        });

    });

///

//bireysel başvuru formu kusura bakmayın (yine html ve script yazıyorum ne yapacağımı inanki bilemediğimden sorunum o )
//
//mask blok

//$('#ad-soyad').mask("999");
$('#tckn').mask("9999999999");
$('#mobil').mask("5999999999");
//$('#eposta').mask("999");
//$('#adres').mask("999");



    var city = $(function() {

        $.ajax({
            type: 'GET',
            url: 'https://www.dinamoelektrik.com/post.php?&q=city&p=null',
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
                        url: 'https://www.dinamoelektrik.com/post.php?&q=state&p=' + cityID,
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

var distributor = $(function() {

        $.ajax({
            type: 'GET',
            url: 'https://www.dinamoelektrik.com/post.php?q=distributor&p=null',
            success: function(data) {
                var dists = '';
                $.each($.parseJSON(data), function() {
                    dists += '<option value=' + this.id + '>' + this.adi + '</option>';
                });
                $('#dagitim-sirketi').html(dists);
            }
        });
    });
    var company = $(function() {

        $.ajax({
            type: 'GET',
            url: 'https://www.dinamoelektrik.com/post.php?q=company&p=null',
            success: function(data) {
                var companys = '';
                $.each($.parseJSON(data), function() {
                    companys += '<option value=' + this.id + '>' + this.adi + '</option>';
                });
                $('#tedarikci-sirketi').html(companys);
            }
        });
    });






$('#bireyselOne').click(function(events){
    event.preventDefault();
    if($('#ad-soyad').val() == ''){
        alert('Lütfen Adı Soyadı Giriniz.');
    }
    else if($('#tckn').val() == ''){
        alert('Lütfen T.C no  Giriniz.');
    }
    else if($('#mobil').val() == ''){
        alert('Lütfen Cep Telefonu Giriniz.');
    }
    else if($('#city').val() == '1'){
        alert('Lütfen İl Giriniz.');
    }
    else if($('#region').val() == '1'){
        alert('Lütfen İlçe Giriniz.');
    }
    else if($('#eposta').val() == ''){
        alert('Lütfen Eposta Giriniz.');
    }
    else if($('#adres').val() == ''){
        alert('Lütfen Adres Giriniz.');
    }
});
$('#bireyselTwo').click(function(events){
     event.preventDefault();
    if($('#isletme-kodu').val() =='' ){
        alert('Lütfen İşletme Kodunu Giriniz.');
    }

    else if($('#dagitim-sirketi').val() == '1'){
        alert('Lütfen Dağıtım Şirketi Giriniz.');
    }

    else if($('#tedarikci-sirketi').val() == '1'){
        alert('Lütfen Tedarikçi Şirketi Giriniz.');
    }

    else if($('#abone-no').val() == ''){
        alert('Lütfen Abone / Tesisat No Giriniz.');
    }

    else if($('#tarife-kodu').val() == ''){
        alert('Lütfen Tarife Kodu Giriniz.');
    }

    else if($('#aktif-sayac-seri-no').val() == ''){
       alert('Lütfen Aktif Sayaç Seri No Giriniz.');
    }
    else if($('#endüktif-sayac-seri-no').val() == ''){
        alert('Lütfen Endüktif Sayaç Seri No Giriniz.');
    }
    else if($('#sayac-carpani').val()== ''){
        alert('Lütfen Sayaç Çarpanı Giriniz.');
    }

});
$('#hemenOde').click(function(evenst){
    alert('Şuanda Ödeme İşlemi Gerçekleştiremiyoruz');

});




});