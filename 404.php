<?php get_header(); ?>

<!-- .nothing -->
<div class="nothing">
    <div class="nothing__header">404</div>
    <div class="nothing__description"><?php _e( 'Page not found', 'tunalog' ); ?></div>
    <a href="<?php echo esc_url( home_url() ); ?>" class="nothing__button">← 返回首頁</a>
</div>
<!-- / .nothing -->

<?php get_footer(); ?>