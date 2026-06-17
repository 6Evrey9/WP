<?php
/**
 * Archive of all procedures.
 *
 * @package iuventa
 */

get_header();
?>
<main id="main" class="site-main">
	<section class="section">
		<div class="container">
			<h1 class="section-title">Процедуры косметологии в Самаре</h1>
			<p class="section-sub">Аппаратные и инъекционные процедуры клиники Ювента</p>
			<div class="procedures-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					$price = get_post_meta( get_the_ID(), '_iuventa_price', true );
					$hit   = get_post_meta( get_the_ID(), '_iuventa_hit', true );
					$short = get_post_meta( get_the_ID(), '_iuventa_short', true );
					if ( ! $short ) {
						$short = get_the_excerpt();
					}
					?>
					<article class="procedure-card">
						<?php if ( $hit ) : ?><span class="hit-badge">хит</span><?php endif; ?>
						<h3><?php the_title(); ?></h3>
						<p class="procedure-desc"><?php echo esc_html( $short ); ?></p>
						<?php if ( $price ) : ?><p class="procedure-price"><?php echo esc_html( $price ); ?></p><?php endif; ?>
						<a class="btn btn-dark" href="<?php the_permalink(); ?>">Подробнее</a>
					</article>
				<?php endwhile; ?>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();
