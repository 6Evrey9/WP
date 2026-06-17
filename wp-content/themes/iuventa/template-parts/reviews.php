<?php
/**
 * Client reviews.
 *
 * @package iuventa
 */

$info    = iuventa_clinic_info();
$reviews = iuventa_reviews();
?>
<section class="section reviews" id="reviews">
	<div class="container">
		<h2 class="section-title">Отзывы о клинике косметологии Ювента в Самаре</h2>

		<div class="reviews-rating">
			<div class="rating-stars">★★★★★</div>
			<div class="rating-meta">
				<strong><?php echo esc_html( $info['rating'] ); ?> / 5</strong>
				<span>Оценка клиники на Яндексе (<?php echo esc_html( $info['reviews_count'] ); ?> отзыва)</span>
			</div>
		</div>

		<div class="reviews-grid">
			<?php foreach ( $reviews as $rev ) : ?>
				<article class="review-card">
					<header class="review-head">
						<span class="review-avatar"><?php echo esc_html( mb_substr( $rev['name'], 0, 1 ) ); ?></span>
						<span class="review-meta">
							<strong><?php echo esc_html( $rev['name'] ); ?></strong>
							<span class="muted"><?php echo esc_html( $rev['date'] ); ?> · Яндекс</span>
						</span>
						<span class="review-stars">★★★★★</span>
					</header>
					<p><?php echo esc_html( $rev['text'] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
