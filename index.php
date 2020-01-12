<?php get_header(); ?>

<?php if ( is_search() ) { ?>
<form class="global-search" method="get" action="<?php echo home_url('/'); ?>">
    <input type="text" class="search__field" name="s" placeholder="在此輸入關鍵字…" value="<?php the_search_query(); ?>">
    <input class="search__button" type="submit" value="搜尋">
</form>
<?php } ?>

<!-- .global-articles -->
<div class="global-articles">
    <?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>
    <div class="articles__article">
        <?php if ( get_theme_mod('featured_picture_visibility') == 'enabled_background' && has_post_thumbnail() ) { ?>
        <div class="article__featured">
            <?php the_post_thumbnail();?>
        </div>
        <?php } ?>
        <div class="article__section">
            <a href="<?php the_permalink();?>" class="article__title">
                <?php the_title(); ?>
            </a>
            <?php if ( get_theme_mod('featured_picture_visibility') == 'enabled' && has_post_thumbnail() ) { ?>
            <div class="article__featured">
                <?php the_post_thumbnail('tunalog-fullsize');?>
            </div>
            <?php } ?>
            <div class="article__content">
                <?php if( !post_password_required() ) { ?>
                    <?php echo wp_trim_words( get_the_content(), 180 ); ?>
                <?php } ?>
            </div>
            <div class="article__meta">
                <a href="<?php echo get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j'));  ?>" class="meta__date"><?php echo get_the_date(); ?></a>
                <?php if ( get_theme_mod( 'display_author' ) == 'enabled' ) { ?>
                <?php if ( get_the_author_meta( 'user_url' ) != "" ) { ?>
                    ．<a href="<?php the_author_meta( 'user_url' ); ?>" class="meta__author"><?php the_author_meta( 'display_name' ); ?></a>
                <?php } else { ?>
                    ．<div class="meta__author"><?php the_author_meta( 'display_name' ); ?></div>
                <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php } } ?>
</div>
<!-- / .global-articles -->

<?php
    global $wp_query;
    $total_pages = $wp_query->max_num_pages;
    $paged       = (get_query_var('paged')) ? get_query_var('paged') : 1;
?>
<?php if ( $total_pages > 1 ) { ?>
<!-- .global-pagination -->
<div class="global-pagination">
    <div class="pagination__previous">
        <?php if ($paged != 1) { ?>
        <?php echo previous_posts_link( '← 新文章' ); ?>
        <?php } ?>
    </div>
    <div class="pagination__info">
        目前第 <?php echo $paged ?> 頁，共有 <?php echo $total_pages ?> 頁
    </div>
    <div class="pagination__next">
        <?php if ($paged != $total_pages) { ?>
        <?php echo next_posts_link( '舊文章 →' ); ?>
        <?php } ?>
    </div>
</div>
<!-- / .global-pagination -->
<?php } ?>

<?php if ( is_search() && $total_pages == 0 ) { ?>
<!-- .global-nothing -->
<div class="global-nothing">
    <div class="nothing__header">找不到文章</div>
    <div class="nothing__description">請試著變換搜尋關鍵字</div>
</div>
<!-- / .global-nothing -->
<?php } ?>

<?php get_footer(); ?>