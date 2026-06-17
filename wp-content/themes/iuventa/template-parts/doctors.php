<?php
/**
 * Doctors / specialists.
 *
 * Pulls from the "specialist" custom post type (editable in wp-admin);
 * falls back to the static list if none exist yet.
 *
 * @package iuventa
 */

$query = new WP_Query(
	array(
		'post_type'      => 'specialist',
		'posts_per_page' => 12,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
		'no_found_rows'  => true,
	)
);
?>
<section class="section doctors" id="doctors">
	<div class="container">
		<h2 class="section-title">Косметологи клиники Ювента в Самаре с медицинским образованием</h2>
		<p class="section-sub">Врачи-косметологи с опытом работы от 4 лет</p>

		<div class="doctors-grid">
			<?php if ( $query->have_posts() ) : ?>
				<?php
				while ( $query->have_posts() ) :
					$query->the_post();
					$role = get_post_meta( get_the_ID(), '_iuventa_role', true );
					if ( ! $role ) {
						$role = get_the_excerpt();
					}
					?>
					<article class="doctor-card">
						<a class="doctor-media" href="<?php the_permalink(); ?>">
							<img src="<?php echo esc_url( iuventa_specialist_photo( get_the_ID() ) ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
						</a>
						<div class="doctor-body">
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p><?php echo esc_html( $role ); ?></p>
						</div>
					</article>
					<?php
				endwhile;
				wp_reset_postdata();
				?>
			<?php else : ?>
				<?php foreach ( iuventa_doctors() as $d ) : ?>
					<article class="doctor-card">
						<div class="doctor-media">
							<img src="<?php echo esc_url( iuventa_img( $d['img'] ) ); ?>" alt="<?php echo esc_attr( $d['name'] ); ?>" loading="lazy">
						</div>
						<div class="doctor-body">
							<h3><?php echo esc_html( $d['name'] ); ?></h3>
							<p><?php echo esc_html( $d['role'] ); ?></p>
						</div>
					</article>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>
