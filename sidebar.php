<!-- .sidebar -->
<div class="global-sidebar">
    <div class="sidebar__header">
        選單
        <a href="#!" class="sidebar__close">關閉</a>
    </div>

    <?php
        $has_sidebar_1 = is_active_sidebar( 'sidebar-1' );
    ?>
    <?php if ( $has_sidebar_1 ) { ?>
    <!-- .sidebar__widgets -->
    <div class="sidebar__widgets">
        <?php dynamic_sidebar( 'sidebar-1' ); ?>
    </div>
    <!-- .sidebar__widgets -->
    <?php } ?>
</div>
<!-- / .sidebar -->