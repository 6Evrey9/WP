<?php
/**
 * Hero section.
 *
 * @package iuventa
 */

$info     = iuventa_clinic_info();
$benefits = iuventa_hero_benefits();
?>
<section class="hero" id="top">
	<div class="container hero-inner">
		<div class="hero-content">
			<p class="hero-eyebrow"><?php echo esc_html( iuventa_opt( 'hero_eyebrow', iuventa_default( 'hero_eyebrow' ) ) ); ?></p>
			<h1 class="hero-title"><?php echo esc_html( iuventa_opt( 'hero_title', iuventa_default( 'hero_title' ) ) ); ?></h1>
			<p class="hero-lead"><?php echo esc_html( iuventa_opt( 'hero_lead', iuventa_default( 'hero_lead' ) ) ); ?> <span class="star">★</span></p>

			<ul class="hero-benefits">
				<?php foreach ( $benefits as $b ) : ?>
					<li>
						<span class="check"></span>
						<span><?php echo esc_html( $b['text'] ); ?>
							<?php if ( $b['accent'] ) : ?><strong><?php echo esc_html( $b['accent'] ); ?></strong><?php endif; ?>
						</span>
					</li>
				<?php endforeach; ?>
			</ul>

			<div class="hero-cta">
				<a class="btn btn-primary btn-lg" href="#contact">Записаться на консультацию</a>
				<a class="btn btn-outline btn-lg" href="tel:<?php echo esc_attr( $info['phone_raw'] ); ?>">Позвонить</a>
			</div>
			<p class="hero-note"><?php echo esc_html( iuventa_opt( 'hero_note', iuventa_default( 'hero_note' ) ) ); ?></p>
		</div>

		<div class="hero-media">
			<img src="<?php echo esc_url( iuventa_img( 'hero-team.png' ) ); ?>" alt="Косметологи клиники Ювента в Самаре" loading="eager">
			<div class="hero-badge">
				<span class="hero-badge-rating">★ <?php echo esc_html( $info['rating'] ); ?></span>
				<span class="hero-badge-text"><?php echo esc_html( $info['reviews_count'] ); ?> отзыва на Яндексе</span>
			</div>
		</div>
	</div>
</section>
