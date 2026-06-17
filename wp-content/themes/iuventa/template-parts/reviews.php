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
		<p class="section-sub">Реальные отзывы клиентов о косметологии Ювента в Самаре. Пациенты делятся результатами процедур: лечение акне, чистка лица, RF-лифтинг и омоложение кожи.</p>

		<div class="reviews-rating">
			<div class="rating-left">
				<span class="rating-label">ОЦЕНКА КОСМЕТОЛОГИЯ ЮВЕНТА В <span class="ya">Я</span>ндекс</span>
				<span class="rating-line">
					<span class="rating-stars">★★★★★</span>
					<strong><?php echo esc_html( $info['rating'] ); ?> / 5</strong>
					<span class="muted">(<?php echo esc_html( $info['reviews_count'] ); ?> отзыва)</span>
				</span>
			</div>
			<a class="btn btn-primary btn-sm" href="#contact">Оставить отзыв</a>
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
