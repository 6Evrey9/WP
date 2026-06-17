<?php
/**
 * Popular procedures + prices grid.
 *
 * Pulls from the "procedure" custom post type (editable in wp-admin);
 * falls back to the static list if no procedures exist yet.
 *
 * @package iuventa
 */

$query = new WP_Query(
	array(
		'post_type'      => 'procedure',
		'posts_per_page' => 12,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
		'no_found_rows'  => true,
	)
);
?>
<section class="section procedures" id="procedures">
	<div class="container">
		<h2 class="section-title">Популярные процедуры косметологии в Самаре и цены</h2>

		<div class="procedures-grid">
			<?php if ( $query->have_posts() ) : ?>
				<?php
				while ( $query->have_posts() ) :
					$query->the_post();
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
					<?php
				endwhile;
				wp_reset_postdata();
				?>
			<?php else : ?>
				<?php foreach ( iuventa_procedures() as $p ) : ?>
					<article class="procedure-card">
						<?php if ( ! empty( $p['hit'] ) ) : ?><span class="hit-badge">хит</span><?php endif; ?>
						<h3><?php echo esc_html( $p['title'] ); ?></h3>
						<p class="procedure-desc"><?php echo esc_html( $p['desc'] ); ?></p>
						<p class="procedure-price"><?php echo esc_html( $p['price'] ); ?></p>
						<a class="btn btn-dark" href="#contact">Подробнее</a>
					</article>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>

		<p class="procedures-note">В клинике Ювента в Самаре вы можете сделать инъекционные и аппаратные процедуры косметологии по доступным ценам. Подберём решение под вашу задачу: омоложение, лечение акне, чистка лица или коррекция возрастных изменений.</p>
	</div>
</section>
