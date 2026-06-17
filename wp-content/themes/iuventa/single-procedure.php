<?php
/**
 * Template for a single procedure page (шаблон страницы процедуры).
 *
 * @package iuventa
 */

get_header();

while ( have_posts() ) :
	the_post();
	$price = get_post_meta( get_the_ID(), '_iuventa_price', true );
	$hit   = get_post_meta( get_the_ID(), '_iuventa_hit', true );
	$info  = iuventa_clinic_info();
	?>
	<main id="main" class="site-main single-procedure">
		<section class="single-hero">
			<div class="container single-hero-inner">
				<nav class="breadcrumbs">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
					<span>→</span>
					<a href="<?php echo esc_url( get_post_type_archive_link( 'procedure' ) ); ?>">Процедуры</a>
				</nav>
				<?php if ( $hit ) : ?><span class="hit-badge hit-badge--static">хит</span><?php endif; ?>
				<h1 class="single-title"><?php the_title(); ?></h1>
				<?php if ( has_excerpt() ) : ?><p class="single-lead"><?php echo esc_html( get_the_excerpt() ); ?></p><?php endif; ?>
				<?php if ( $price ) : ?>
					<div class="single-price-row">
						<span class="single-price"><?php echo esc_html( $price ); ?></span>
						<a class="btn btn-primary btn-lg" href="<?php echo esc_url( home_url( '/#contact' ) ); ?>">Записаться</a>
					</div>
				<?php endif; ?>
			</div>
		</section>

		<section class="section single-body">
			<div class="container container--narrow">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="single-thumb"><?php the_post_thumbnail( 'large' ); ?></div>
				<?php endif; ?>
				<div class="single-content"><?php the_content(); ?></div>

				<div class="single-cta">
					<h2>Запишитесь на процедуру «<?php the_title(); ?>»</h2>
					<p>Перезвоним в течение 15 минут, ответим на вопросы и подберём удобное время.</p>
					<a class="btn btn-primary btn-lg" href="<?php echo esc_url( home_url( '/#contact' ) ); ?>">Записаться на консультацию</a>
					<p class="single-cta-phone">или позвоните: <a href="tel:<?php echo esc_attr( $info['phone_raw'] ); ?>"><?php echo esc_html( $info['phone'] ); ?></a></p>
				</div>
			</div>
		</section>

		<?php iuventa_related_procedures( get_the_ID() ); ?>
	</main>
	<?php
endwhile;

get_footer();
