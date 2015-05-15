<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Able WP
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php 
				if ( has_post_thumbnail() ) { ?>
					<figure class="excerpt">
					<a href="<?php echo get_permalink(); ?>">
					<?php echo the_post_thumbnail(); ?>
					<figcaption><?php the_title(); ?></figcaption>
					</a>
					</figure>
				<?php }
				?>
				
				<div class="cx_block excerpt">
				<header class="entry-header">
					
				</header><!-- .entry-header -->

				</div><!-- .cx_block -->

			</article><!-- #post-## -->

			<?php endwhile; ?>

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
