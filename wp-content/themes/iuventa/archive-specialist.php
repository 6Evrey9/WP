<?php
/**
 * Archive of all cosmetologists.
 *
 * @package iuventa
 */

get_header();
?>
<main id="main" class="site-main">
	<section class="section">
		<div class="container">
			<h1 class="section-title">Косметологи клиники Ювента в Самаре</h1>
			<p class="section-sub">Врачи-косметологи с медицинским образованием и опытом работы от 4 лет</p>
			<div class="doctors-grid">
				<?php
				while ( have_posts() ) :
					the_post();
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
				<?php endwhile; ?>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();
