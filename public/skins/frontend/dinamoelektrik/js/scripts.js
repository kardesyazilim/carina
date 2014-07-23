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
  });

$(function() {

   // fade in divs
var fadein = $('div.lazy');
$.each(fadein, function(i, item) {
	setTimeout(function() {
		$(item).fadeIn(1000); // duration of fadein
	}, 1000 * i) // duration between fadeins
	});

 var allPanels = $('.accordion > dd').hide();

  $('.accordion > dt > a').click(function() {
  	$('.accordion > dt').removeClass('border-bottom-none');
    allPanels.slideUp();
    $(this).parent().addClass('border-bottom-none');
    $(this).parent().next().slideDown();
    return false;
  });

});

