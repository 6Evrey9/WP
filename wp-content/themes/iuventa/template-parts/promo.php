<?php
/**
 * RF-лифтинг promotional banner.
 *
 * @package iuventa
 */
?>
<section class="section promo-wrap">
	<div class="container">
		<div class="promo">
			<div class="promo-content">
				<span class="promo-pill">🔥 <?php echo esc_html( iuventa_opt( 'promo_pill', iuventa_default( 'promo_pill' ) ) ); ?></span>
				<h2 class="promo-title"><?php echo esc_html( iuventa_opt( 'promo_title', iuventa_default( 'promo_title' ) ) ); ?></h2>
				<p class="promo-price">
					<span class="promo-now"><?php echo esc_html( iuventa_opt( 'promo_now', iuventa_default( 'promo_now' ) ) ); ?></span>
					<span class="promo-old"><?php echo esc_html( iuventa_opt( 'promo_old', iuventa_default( 'promo_old' ) ) ); ?></span>
					<span class="promo-discount"><?php echo esc_html( iuventa_opt( 'promo_discount', iuventa_default( 'promo_discount' ) ) ); ?></span>
				</p>
				<p class="promo-desc"><?php echo esc_html( iuventa_opt( 'promo_desc', iuventa_default( 'promo_desc' ) ) ); ?></p>
				<div class="promo-tags">
					<span>✓ Без уколов</span>
					<span>✓ Без реабилитации</span>
					<span>✓ Эффект сразу</span>
				</div>
				<a class="btn btn-light btn-lg" href="#contact">Записаться по акции</a>
				<p class="promo-gift"><?php echo esc_html( iuventa_opt( 'promo_gift', iuventa_default( 'promo_gift' ) ) ); ?></p>
			</div>
			<div class="promo-media">
				<img src="<?php echo esc_url( iuventa_img( 'promo-rf.png' ) ); ?>" alt="RF-лифтинг лица в клинике Ювента">
				<span class="promo-quote">Вернула 5 лет молодости без операций!</span>
			</div>
		</div>
	</div>
</section>
