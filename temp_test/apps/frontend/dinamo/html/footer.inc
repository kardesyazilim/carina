
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
                        <a class="btn-black right" href="/bayimiz-olun">BAYİMİZ OLUN</a>
                    </div>
                </div>
                <nav class="container clearfix">
                    <ul>
                        <li><a href="/bireysel-hakkimizda">HAKKIMIZDA</a></li>
                        <li><a href="/bireysel-haberler">HABERLER</a></li>
                        <li><a href="/bireysel-basin-odasi">BASIN ODASI</a></li>
                        <li><a href="/bireysel-sikca-sorulan-sorular">SIKÇA SORULAN SORULAR</a></li>
                        <li><a href="/bireysel-iletisim">İLETİŞİM</a></li>
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
  		<script src="<?php echo DOMAIN; ?>skins/frontend/dinamo/js/jquery-1.10.2.min.js"></script>
  		
        <script src="<?php echo DOMAIN; ?>skins/frontend/dinamo/js/jquery.cycle2.min.js"></script>
        <script src="<?php echo DOMAIN; ?>skins/frontend/dinamo/js/select2.min.js"></script>
        <script src="<?php echo DOMAIN; ?>skins/frontend/dinamo/js/placeholders.min.js"></script>
        <script src="<?php echo DOMAIN; ?>skins/frontend/dinamo/js/jquery.nanoscroller.min.js"></script>
        <script src="<?php echo DOMAIN; ?>skins/frontend/dinamo/js/parsley.js"></script>
        <script src="<?php echo DOMAIN; ?>skins/frontend/dinamo/js/scripts.js"></script>
         <script>
$(document).ready(function() {

    /* Every time the window is scrolled ... */
    $(window).scroll( function(){

        /* Check the location of each desired element */
        $('.lazy').each( function(i){

            var bottom_of_object = $(this).position().top + $(this).outerHeight()/1;
            var bottom_of_window = $(window).scrollTop() + $(window).height();

            /* If the object is completely visible in the window, fade it it */
            if( bottom_of_window > bottom_of_object ){

                  $(this).animate({'opacity':'1'},400).css({'margin-top':'-60px'});

            }
        });
    });

        $('#dinamo-etkisi-link').click(function () {
          $('#dinamo-etkisi').fadeToggle();
        });

});
</script>

    </body>
</html>