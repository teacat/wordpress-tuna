<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php if ( get_theme_mod( 'social_friendly', 'enabled' ) == 'enabled' ) {
        global $post;
        global $wp;
        $type        = is_singular() ? 'object' : 'website';
        //$title       = is_singular() ? wp_trim_words(get_the_title(), 30, '…' ) : get_bloginfo( 'name' );
        $title       = is_singular() ? get_the_title() : get_bloginfo( 'name' );
        $description = is_singular() && $post->post_password == ''  ? wp_trim_words( has_excerpt() ? get_the_excerpt() : $post->post_content , 180 ) : get_bloginfo( 'description' );
        $url         = is_singular() ? get_the_permalink() : home_url( $wp->request );
        $site_name   = get_bloginfo( 'name' );
        $images      = array();
        if( is_singular() && get_the_post_thumbnail_url()) {
            array_push($images, get_the_post_thumbnail_url());
        } else if( is_singular() && !get_the_post_thumbnail_url() ) {
            $output = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );
            foreach( $matches[1] as $value ) {
                array_push($images, $value);
            }
        }
        if( empty( $images ) ) {
            array_push($images, get_template_directory_uri() . '/assets/images/16-9.png');
        }
    ?>
    <link rel="canonical" href="<?php echo $url; ?>">
    <meta property="og:type" content="<?php echo $type ?>">
    <meta property="og:title" content="<?php echo $title ?>">
    <meta property="og:description" content="<?php echo $description ?>">
    <meta property="og:url" content="<?php echo $url ?>">
    <meta property="og:site_name" content="<?php echo $site_name ?>">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="<?php echo $title ?>">
    <meta name="twitter:description" content="<?php echo $description ?>">
    <?php foreach( $images as $value ) { ?>
    <meta property="og:image" content="<?php echo $value; ?>">
    <meta name="twitter:image" content="<?php echo $value; ?>">
    <?php } ?>
    <?php } ?>
    <?php tunalog_dynamic_highlight_loader(); ?>
    <link href="//fonts.googleapis.com/css?family=Noto+Sans+TC&display=swap" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Fira+Code&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
<?php
    $classes = array( '' );
    if ( get_theme_mod( 'header_width', 'standard' ) == 'wide' ) {
        array_push( $classes, 'is-wide-aside' );
    }
    if ( get_theme_mod( 'featured_picture_visibility', 'disabled' ) == 'enabled' ) {
        array_push( $classes, 'is-featured-shown' );
    }
    if ( get_theme_mod( 'featured_picture_visibility', 'disabled' ) == 'enabled_background' ) {
        array_push( $classes, 'is-featured-shown-background' );
    }
    if ( get_theme_mod( 'text_justify', 'disabled' ) == 'enabled' ) {
        array_push( $classes, 'is-text-justify' );
    }
    if ( get_theme_mod( 'text_justify', 'disabled' ) == 'enabled_mobile' ) {
        array_push( $classes, 'is-text-justify-mobile' );
    }
    if ( get_theme_mod( 'codeblock_width', 'standard' ) == 'full' ) {
        array_push( $classes, 'is-codeblock-full' );
    }
    if ( get_theme_mod( 'comment_style', 'standard' ) == 'standard' ) {
        array_push( $classes, 'is-standard-comment' );
    }
    if ( get_theme_mod( 'image_aspected', 'disabled' ) == 'enabled' ) {
        array_push( $classes, 'is-aspected-top' );
    }
    if ( get_theme_mod( 'image_aspected', 'disabled' ) == 'enabled_center' ) {
        array_push( $classes, 'is-aspected-center' );
    }
    array_push( $classes, 'is-preload' );
?>
<body <?php body_class($classes); ?>>
<?php get_sidebar(); ?>

<!-- .wrapper -->
<div class="wrapper">
<?php wp_body_open(); ?>

<!-- .content -->
<div class="content">

<?php if ( is_singular() ) { ?>

<!-- .singular-header -->
<div class="singular-header">
    <div class="header__wrapper">
        <a href="<?php echo get_bloginfo('url'); ?>" class="header__title"><?php echo get_bloginfo('name'); ?></a>
        <?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
        <a class="header__button" href="#!">選單</a>
        <?php } ?>
    </div>
</div>
<!-- / .singular-header -->

<?php } else { ?>

<!-- .global-header -->
<div class="global-header">
    <a class="header__title" href="<?php echo get_bloginfo('url'); ?>">
        <?php if ( is_category() ) { ?>
            <?php echo single_cat_title(); ?>
        <?php } else if ( is_archive() ) { ?>
            <?php the_archive_title(); ?>
        <?php// } else if ( is_search() ) { ?>
            <?php //the_search_query(); ?>
        <?php } else { ?>
            <?php echo get_bloginfo('name'); ?>
        <?php } ?>
    </a>
    <div class="header__description">
        <?php if ( is_category() ) { ?>
            <?php echo category_description(); ?>
        <?php } else if ( !is_archive() /*&& !is_search()*/ ) { ?>
            <?php echo get_bloginfo('description'); ?>
        <?php }  ?>
    </div>
</div>
<!-- / .global-header -->

<!-- .global-nav -->
<div class="global-nav">
    <?php if ( has_nav_menu('tunalog-homepage-menu') ) {
        wp_nav_menu( array(
        'theme_location'  => 'tunalog-homepage-menu',
        'container_class' => 'nav__wrapper' ) );
    } ?>
</div>
<!-- / .global-nav -->

<?php } ?>