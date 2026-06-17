<?php
/**
 * Before / after results.
 *
 * @package iuventa
 */

$results = iuventa_results();
?>
<section class="section results" id="results">
	<div class="container">
		<h2 class="section-title">Результаты наших клиентов</h2>
		<p class="section-sub">Фото до и после процедур в клинике</p>

		<div class="results-grid">
			<?php foreach ( $results as $r ) : ?>
				<figure class="result-card">
					<div class="result-media">
						<img src="<?php echo esc_url( iuventa_img( $r['img'] ) ); ?>" alt="<?php echo esc_attr( $r['title'] ); ?>" loading="lazy">
						<span class="result-tag">До / После</span>
					</div>
					<figcaption>
						<h3><?php echo esc_html( $r['title'] ); ?></h3>
						<p><?php echo esc_html( $r['desc'] ); ?></p>
					</figcaption>
				</figure>
			<?php endforeach; ?>
		</div>
		<p class="results-note">Фотографии клиентов опубликованы с разрешения</p>
	</div>
</section>
