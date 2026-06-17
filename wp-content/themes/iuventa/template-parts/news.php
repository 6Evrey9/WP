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
					<a class="news-media" href="#contact">
						<img src="<?php echo esc_url( iuventa_img( $n['img'] ) ); ?>" alt="<?php echo esc_attr( $n['title'] ); ?>" loading="lazy">
					</a>
					<h3 class="news-title"><a href="#contact"><?php echo esc_html( $n['title'] ); ?></a></h3>
				</article>
			<?php endforeach; ?>
		</div>

		<div class="news-more">
			<a class="btn btn-dark btn-pill" href="#contact">Показать ещё</a>
		</div>
	</div>
</section>
