<form class="compact-search" method="get" action="<?php echo home_url('/'); ?>">
    <input type="text" class="search__field" name="s" placeholder="在此輸入關鍵字…" value="<?php the_search_query(); ?>">
    <input class="search__button" type="submit" value="搜尋">
</form>