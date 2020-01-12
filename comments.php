<?php
	$has_pageend_1 = is_active_sidebar( 'pageend-1' );
	$has_pageend_2 = is_active_sidebar( 'pageend-2' );
?>

<?php if ( $has_pageend_1 ) { ?>
<!-- .article__pageend -->
<div class="article__pageend">
	<?php dynamic_sidebar( 'pageend-1' ); ?>
</div>
<!-- / .article__pageend -->
<?php } ?>

<?php if ( !post_password_required() ) { ?>
<!-- .article__comments -->
<aside class="article__comments">
	<?php
		if ( comments_open() || pings_open() ) {
			comment_form(
				array(
				'class_form'         => 'comments__form',
				'title_reply_before' => '<div class="comments__header">',
				'title_reply_after'  => '</div>'
				)
			);
		}
		$comments_number = absint( get_comments_number() );
	?>
	<?php if ( $comments_number > 0 ) { ?>
	<div id="comments" class="comments__count">這篇文章有 <?php echo $comments_number; ?> 則留言</div>
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
				$previous_comments = get_previous_comments_link( '← 舊留言' );
				$next_comments     = get_next_comments_link( '新留言 →' );
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

<?php if ( $has_pageend_2 ) { ?>
<!-- .article__pageend -->
<div class="article__pageend">
	<?php dynamic_sidebar( 'pageend-2' ); ?>
</div>
<!-- / .article__pageend -->
<?php } ?>