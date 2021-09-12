<form class="compact-search" method="get" action="<?php echo esc_url( home_url( '/' ) ) ; ?>">
    <input type="text" class="search__field" name="s" placeholder="<?php _e( 'Search anything...', 'tunalog'); ?>" value="<?php the_search_query(); ?>">
    <input class="search__button" type="submit" value="<?php _e( 'Search', 'tunalog'); ?>">
</form>