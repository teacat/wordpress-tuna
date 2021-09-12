<?php
	$has_pageend_1   = is_active_sidebar( 'pageend-1' );
	$has_pageend_2   = is_active_sidebar( 'pageend-2' );
	$comments_number = absint( get_comments_number() );
?>

<?php if ( $has_pageend_1 ) { ?>
<!-- .article__pageend -->
<div class="article__pageend">
	<?php dynamic_sidebar( 'pageend-1' ); ?>
</div>
<!-- / .article__pageend -->
<?php } ?>

<?php if ( !post_password_required() ) { ?>
<?php if ( ( !comments_open() && $comments_number > 0 ) || comments_open() || ( !comments_open() && pings_open() && $comments_number > 0) ) { ?>
<!-- .article__comments -->
<aside class="article__comments">
	<?php
		if ( comments_open() ) {
			comment_form(
				array(
				'class_form'         => 'comments__form',
				'title_reply_before' => '<div class="comments__header">',
				'title_reply_after'  => '</div>'
				)
			);
		}
	?>
	<?php if ( $comments_number > 0 ) { ?>
	<div id="comments" class="comments__count"><?php printf( _n( '%s thought on the post', '%s thoughts on the post', $comments_number, 'tunalog' ), number_format_i18n( $comments_number )); ?></div>
	<!-- .comments_wrapper -->
	<div class="comments_wrapper">
		<?php
			wp_list_comments(
				array(
					'avatar_size' => 32,
					'style'       => 'div',
				)
			);
		?>
		<?php if ( get_comment_pages_count() > 1 ) { ?>
		<div class="comments_pagination">
			<?php
				$previous_comments = get_previous_comments_link( __( '← Older Comments', 'tunalog' ) );
				$next_comments     = get_next_comments_link( __( 'Newer Comments →', 'tunalog' ) );
			?>
			<div class="pagination__previous">
				<?php if( $previous_comments ) { echo $previous_comments; } ?>
			</div>
			<div class="pagination__next">
				<?php if( $next_comments ) { echo $next_comments; } ?>
			</div>
		</div>
		<?php } ?>
	</div>
	<!-- / .comments_wrapper -->
	<?php } ?>
</aside>
<!-- / .article__comments -->
<?php } ?>
<?php } ?>

<?php if ( $has_pageend_2 ) { ?>
<!-- .article__pageend -->
<div class="article__pageend">
	<?php dynamic_sidebar( 'pageend-2' ); ?>
</div>
<!-- / .article__pageend -->
<?php } ?>