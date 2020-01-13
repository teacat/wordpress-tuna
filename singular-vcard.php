<?php function singular_vcard($position) {
    if ( post_password_required() ) {
        return;
    }
    if (get_theme_mod( 'display_vcard', 'end' ) == 'disabled') {
        return;
    }
    if ($position == 'start' && get_theme_mod( 'display_vcard', 'end' ) != 'start') {
        return;
    }
    if ($position == 'end' && get_theme_mod( 'display_vcard', 'end' ) != 'end') {
        return;
    }
?>
<!-- .article__vcard -->
<div class="article__vcard">
    <div class="vcard__avatar">
        <img src="<?php echo get_avatar_url(get_the_author_meta('user_email')); ?>">
        <div class="vcard__name">
            <?php if( get_the_author_meta( 'user_url' ) != '' ) { ?>
                <a href="<?php the_author_meta( 'user_url' ); ?>"><?php the_author_meta( 'display_name' ); ?></a>
            <?php } else { ?>
                <?php the_author_meta( 'display_name' ); ?>
            <?php } ?>
        </div>
    </div>
    <div class="vcard__section">
        <div class="vcard__name">
            <?php if( get_the_author_meta( 'user_url' ) != '' ) { ?>
                <a href="<?php the_author_meta( 'user_url' ); ?>"><?php the_author_meta( 'display_name' ); ?></a>
            <?php } else { ?>
                <?php the_author_meta( 'display_name' ); ?>
            <?php } ?>
        </div>
        <?php if ( get_the_author_meta('description') != '' ) { ?>
        <div class="vcard__bio">
            <?php the_author_meta('description'); ?>
        </div>
        <?php } ?>
    </div>
</div>
<!-- / .article__vcard -->
<?php } ?>