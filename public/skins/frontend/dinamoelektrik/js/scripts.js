$(document).ready(function() {
        $('.select').select2({
            minimumResultsForSearch: -1
        });

        $('#indirim').change(function () {
	      $('#indirim-kod').fadeToggle();
	    });

	    $('.map-to').bind('blur', function () {
	        $('#'+ $(this).data('href') ).addClass('hide');
	    }).bind('focus', function () {
	        $('#'+ $(this).data('href') ).removeClass('hide');
	    });

	    $(".abone-grubu").click(function() {
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

  $( ".schedule-details-link" ).click(function() {
      $('.schedule-open .close').hide();
      $('.compare-box').removeClass('schedule-open');
      $(this).parent().addClass('schedule-open');
      $('.schedule').hide();
      $('.schedule-open .close').show();
      var soruid = $(this).data("id");
      $('.schedule .schedule-details[data-id='+ soruid +']').parent().slideToggle("fast");
  });

  $( ".close a" ).click(function() {
      $('.schedule').hide();
      $('.schedule-open .close').hide();
      $('.compare-box').removeClass('schedule-open');

       return false;
  });

  //tab script
    $('#tab-content div.tab').hide();
    $('#tab-content div.tab:first').show();

    $('.tab-menu li').click(function() {
        $('.tab-menu li a').removeClass("active");
        $(this).find('a').addClass("active");
        $('#tab-content div.tab').hide();

        var indexer = $(this).index();
        $('#tab-content div.tab:eq(' + indexer + ')').show();
        return false;
    });

//modal window script
     $("#modal").leanModal({ overlay : 0.4, closeButton: ".modal_close" });

});

