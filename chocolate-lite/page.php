<?php get_header(); ?>

<div id="content">
	<div id="path">
		<a rel="bookmark" href="<?php echo home_url(); ?>"><?php _e('Home','chocolate'); ?></a>
		<?php the_post(); ?>
			<?php printf(('&rsaquo; '.__('Page', 'chocolate').' &rsaquo; %s'),get_the_title()); ?>
		<?php rewind_posts(); ?>
	</div>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div <?php post_class('post post_singular'); ?> id="post-<?php the_ID(); ?>">
		<h2 class="title title_page"><?php the_title(); ?></h2>
		<div class="entry">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page_link"><strong>' . __( 'Pages:', 'chocolate' ) . '</strong>' , 'after' => '</div>' ) ); ?>
		</div><!-- END entry -->
	</div><!-- END post -->
	<?php comments_template( '', true ); ?>
	<?php endwhile; else: ?>
	<?php endif; ?>
</div><!--content-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>