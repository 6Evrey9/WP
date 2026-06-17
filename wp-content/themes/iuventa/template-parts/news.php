<?php
/**
 * Clinic news / blog.
 *
 * @package iuventa
 */

$news = iuventa_news();
?>
<section class="section news" id="news">
	<div class="container">
		<h2 class="section-title">Все новости клиники</h2>

		<div class="news-grid">
			<?php foreach ( $news as $n ) : ?>
				<article class="news-card">
					<div class="news-media">
						<img src="<?php echo esc_url( iuventa_img( $n['img'] ) ); ?>" alt="<?php echo esc_attr( $n['title'] ); ?>" loading="lazy">
					</div>
					<div class="news-body">
						<span class="news-tag">Новости клиники</span>
						<h3><?php echo esc_html( $n['title'] ); ?></h3>
						<a class="news-link" href="#contact">Читать</a>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
