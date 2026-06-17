<?php
/**
 * Fallback template (used for archives, search, 404, single posts).
 *
 * The main landing page is rendered by front-page.php.
 *
 * @package iuventa
 */

get_header();
?>
<main id="main" class="site-main">
	<section class="section">
		<div class="container container--narrow">
			<?php if ( have_posts() ) : ?>
				<h1 class="section-title"><?php echo esc_html( wp_get_document_title() ); ?></h1>
				<div class="faq-list">
					<?php
					while ( have_posts() ) :
						the_post();
						?>
						<article class="review-card">
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<div><?php the_excerpt(); ?></div>
						</article>
						<?php
					endwhile;
					?>
				</div>
				<?php the_posts_pagination(); ?>
			<?php else : ?>
				<h1 class="section-title">Страница не найдена</h1>
				<p class="section-sub">Вернитесь на <a href="<?php echo esc_url( home_url( '/' ) ); ?>">главную страницу</a> клиники Ювента.</p>
			<?php endif; ?>
		</div>
	</section>
</main>
<?php
get_footer();
