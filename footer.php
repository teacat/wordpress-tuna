</div>
<!-- / .content -->

<?php
    $has_footer_1 = is_active_sidebar( 'footer-1' );
    $has_footer_2 = is_active_sidebar( 'footer-2' );
    $has_footer_3 = is_active_sidebar( 'footer-3' );
?>

<?php if ( $has_footer_1 || $has_footer_2 || $has_footer_3 ) { ?>
<!-- .footer -->
<footer class="footer">
    <div class="footer__wrapper">
        <?php if ( $has_footer_1 ) { ?>
            <div class="footer__widget">
                <?php dynamic_sidebar( 'footer-1' ); ?>
            </div>
        <?php } if ( $has_footer_2 ) { ?>
            <div class="footer__widget">
                <?php dynamic_sidebar( 'footer-2' ); ?>
            </div>
        <?php } if ( $has_footer_3 ) { ?>
            <div class="footer__widget">
                <?php dynamic_sidebar( 'footer-3' ); ?>
            </div>
        <?php } ?>
    </div>
</footer>
<!-- / .footer -->
<?php } ?>

<?php if ( get_theme_mod( 'display_by', 'enabled_all' )  != 'disabled' || get_theme_mod( 'display_copyright', 'enabled' ) == 'enabled' ) { ?>
<!-- .copyright -->
<div class="copyright">
    <div class="copyright__wrapper">
        <?php if ( get_theme_mod( 'display_copyright', 'enabled' ) == 'enabled' ) { ?>
        <div class="copyright__left">
            <?php echo get_bloginfo( 'name' ); ?> © <?php echo date('Y'); ?>
        </div>
        <?php } ?>

        <?php if ( get_theme_mod( 'display_by', 'enabled_all' ) != 'disabled' ) { ?>
        <div class="copyright__right">
            <?php if ( get_theme_mod( 'display_by', 'enabled_all' ) == 'enabled_all' ) { ?>
            <?php _e( 'Powered by <a href="//tw.wordpress.org/">WordPress</a> with <a href="//github.com/teacat/tunalog">Tunalog</a> theme', 'tunalog' ); ?>
            <?php } else { ?>
            <?php _e ( 'Proudly powered by <a href="//tw.wordpress.org/">WordPress</a>', 'tunalog' ); ?>
            <?php } ?>
        </div>
        <?php } ?>
    </div>
</div>
<!-- / .copyright -->
<?php } ?>

</div>
<!-- / .wrapper -->

<script>
window.addEventListener('load', () => document.body.classList.remove('is-preload'));
window.addEventListener('load', () => document.body.appendChild(document.querySelector("#wpadminbar")))
</script>
<?php wp_footer(); ?>
</body>
</html>