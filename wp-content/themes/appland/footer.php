<?php
/**
 * Footer
 *
 * @package AppLand
 * @subpackage Frontend
 * @since 1.0
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.2.2
 */
?>
        <script type="text/javascript">
            //<![CDATA[
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', '<?php echo oxy_get_option( 'google_anal' ) ?>']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
            //]]>
        </script>
        <div id="fb-root"></div>



        <?php wp_footer(); ?> 
    </body>
</html>