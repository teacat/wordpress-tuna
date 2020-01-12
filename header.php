<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php if ( get_theme_mod('social_friendly') == 'enabled' ) {
        global $post;
        global $wp;

        $type        = is_singular() ? 'object' : 'website';
        $title       = is_singular() ? get_the_title() : get_bloginfo( 'name' );
        $description = is_singular() && $post->post_password == '' ? wp_trim_words( $post->post_content, 180 ) : get_bloginfo( 'description' );
        $url         = is_singular() ? get_the_permalink() : home_url( $wp->request );
        $site_name   = get_bloginfo( 'name' );
        $image       = is_singular() && get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/assets/images/16-9.png';
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
    <meta property="og:image" content="<?php echo $image; ?>">
    <meta name="twitter:image" content="<?php echo $image; ?>">
    <?php } ?>
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>
<?php
    $classes = array('');
    if ( get_theme_mod('header_width') == 'wide' ) {
        array_push($classes, 'is-wide-aside');
    }
    if ( get_theme_mod('featured_picture_visibility') == 'enabled' ) {
        array_push($classes, 'is-featured-shown');
    }
    if ( get_theme_mod('featured_picture_visibility') == 'enabled_background' ) {
        array_push($classes, 'is-featured-shown-background');
    }
    if ( get_theme_mod('text_justify') == 'enabled' ) {
        array_push($classes, 'is-text-justify');
    }
    if ( get_theme_mod('text_justify') == 'enabled_mobile' ) {
        array_push($classes, 'is-text-justify-mobile');
    }
    if ( get_theme_mod('codeblock_width') == 'full' ) {
        array_push($classes, 'is-codeblock-full');
    }
    if ( get_theme_mod('comment_style') == 'standard' ) {
        array_push($classes, 'is-standard-comment');
    }
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
        <a class="header__button" href="#!">選單</a>
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

<?php } ?>