<?php
/**
 * Video reviews.
 *
 * @package iuventa
 */

$videos = iuventa_video_reviews();
?>
<section class="section video-reviews" id="video-reviews">
	<div class="container">
		<h2 class="section-title">Отзывы реальных клиентов косметологии Ювента — видео</h2>
		<p class="section-sub">Отзывы опубликованы с разрешения клиентов. Больше отзывов смотрите в Яндекс Картах.</p>

		<div class="video-grid">
			<?php foreach ( $videos as $v ) : ?>
				<figure class="video-card">
					<div class="video-media">
						<img src="<?php echo esc_url( iuventa_img( $v['img'] ) ); ?>" alt="Видеоотзыв — <?php echo esc_attr( $v['name'] ); ?>" loading="lazy">
						<span class="video-play" aria-hidden="true">▶</span>
					</div>
					<figcaption>
						<strong><?php echo esc_html( $v['name'] ); ?></strong>
						<span class="muted"><?php echo esc_html( $v['note'] ); ?></span>
					</figcaption>
				</figure>
			<?php endforeach; ?>
		</div>
	</div>
</section>
