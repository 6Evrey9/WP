<?php
/**
 * Template for a single cosmetologist page (шаблон страницы косметолога).
 *
 * @package iuventa
 */

get_header();

while ( have_posts() ) :
	the_post();
	$role  = get_post_meta( get_the_ID(), '_iuventa_role', true );
	$photo = iuventa_specialist_photo( get_the_ID() );
	$info  = iuventa_clinic_info();
	?>
	<main id="main" class="site-main single-specialist">
		<section class="section specialist-hero">
			<div class="container specialist-hero-inner">
				<div class="specialist-photo">
					<img src="<?php echo esc_url( $photo ); ?>" alt="<?php the_title_attribute(); ?>">
				</div>
				<div class="specialist-info">
					<nav class="breadcrumbs">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
						<span>→</span>
						<a href="<?php echo esc_url( get_post_type_archive_link( 'specialist' ) ); ?>">Косметологи</a>
					</nav>
					<h1 class="single-title"><?php the_title(); ?></h1>
					<?php if ( $role ) : ?><p class="specialist-role"><?php echo esc_html( $role ); ?></p><?php endif; ?>
					<div class="single-content"><?php the_content(); ?></div>
					<a class="btn btn-primary btn-lg" href="<?php echo esc_url( home_url( '/#contact' ) ); ?>">Записаться к специалисту</a>
					<p class="single-cta-phone">или позвоните: <a href="tel:<?php echo esc_attr( $info['phone_raw'] ); ?>"><?php echo esc_html( $info['phone'] ); ?></a></p>
				</div>
			</div>
		</section>
	</main>
	<?php
endwhile;

get_footer();
