<?php get_header(); ?>



<script>
document.querySelector(".wrapper").addEventListener("click", (e) => {
    document.querySelector(".global-sidebar").classList.remove("sidebar--active")
    document.querySelector("a.header__button").classList.remove("header__button--active")
})

document.querySelector("a.header__button").addEventListener("click", (e) => {
    document.querySelector(".global-sidebar").classList.toggle("sidebar--active")
    document.querySelector("a.header__button").classList.toggle("header__button--active")
    e.stopPropagation();
})

document.querySelector(".sidebar__close").addEventListener("click", () => {
    document.querySelector(".global-sidebar").classList.toggle("sidebar--active")
    document.querySelector("a.header__button").classList.toggle("header__button--active")
})
</script>

<?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>
<!-- .article -->
<article class="singular-article">

    <?php if ( has_post_thumbnail() && ! post_password_required() ) {?>
    <!-- .article__featured -->
    <figure class="article__featured">
        <?php the_post_thumbnail();?>
    </figure>
    <!-- / .article__featured -->
    <?php } ?>

    <?php if ( !is_page() ) { ?>
    <!-- .article__meta -->
    <aside class="article__meta">
        <time class="meta__time"><a href="<?php echo get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j'));  ?>"><?php echo get_the_date(); ?></a></time>
    </aside>
    <!-- / .article__meta -->
    <?php } ?>

    <!-- .article__title -->
    <header class="article__title"><?php the_title(); ?></header>
    <!-- / .article__title -->

    <!-- .article__vcard -->
    <?php singular_vcard('start'); ?>
    <!-- / .article__vcard -->

    <!-- .article__content -->
    <section class="article__content">
        <?php the_content(); ?>
    </section>
    <!-- / .article__content -->

    <!-- .article__footer -->
    <?php if( has_category() || has_tag() ) { ?>
    <footer class="article__footer">
        <?php if( has_category() ) { ?>
        <div class="footer__categories">
            <?php the_category( ' ' ); ?>
        </div>
        <?php } if ( has_tag() ) { ?>
        <div class="footer__tags">
            <?php the_tags( '', '' ); ?>
        </div>
        <?php } ?>
    </footer>
    <?php } ?>
    <!-- / .article__footer -->

    <!-- .article__vcard -->
    <?php singular_vcard('end'); ?>
    <!-- / .article__vcard -->

    <!-- .article__comments -->
    <?php comments_template(); ?>
    <!-- / .article__comments -->

    <?php if ( !is_page() ) { ?>
    <!-- .article__pagenav -->
    <nav class="article__pagenav">
        <?php
            $previous = get_previous_post();
            $next = get_next_post();
        ?>
        <?php if ( get_previous_post() ) { ?>
        <a href="<?php echo get_permalink( $previous->ID ); ?>" class="pagenav__previous">
            <div class="pagenav__label">上一篇</div>
            <div class="pagenav__title"><?php echo get_the_title($previous) ?></div>
        </a>
        <?php } if ( get_next_post() ) { ?>
        <a href="<?php echo get_permalink( $next->ID ); ?>" class="pagenav__next">
            <div class="pagenav__label">下一篇</div>
            <div class="pagenav__title"><?php echo get_the_title($next) ?></div>
        </a>
        <?php } ?>
    </nav>
    <!-- / .article__pagenav -->
    <?php } ?>
</article>
<!-- / .article -->
<?php } } ?>

<?php get_footer();