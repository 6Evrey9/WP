<?php
/**
 * Popular procedures + prices grid.
 *
 * @package iuventa
 */

$procedures = iuventa_procedures();
?>
<section class="section procedures" id="procedures">
	<div class="container">
		<h2 class="section-title">Популярные процедуры косметологии в Самаре и цены</h2>

		<div class="procedures-grid">
			<?php foreach ( $procedures as $p ) : ?>
				<article class="procedure-card">
					<?php if ( ! empty( $p['hit'] ) ) : ?><span class="hit-badge">хит</span><?php endif; ?>
					<h3><?php echo esc_html( $p['title'] ); ?></h3>
					<p class="procedure-desc"><?php echo esc_html( $p['desc'] ); ?></p>
					<p class="procedure-price"><?php echo esc_html( $p['price'] ); ?></p>
					<a class="btn btn-dark" href="#contact">Подробнее</a>
				</article>
			<?php endforeach; ?>
		</div>

		<p class="procedures-note">В клинике Ювента в Самаре вы можете сделать инъекционные и аппаратные процедуры косметологии по доступным ценам. Подберём решение под вашу задачу: омоложение, лечение акне, чистка лица или коррекция возрастных изменений.</p>
	</div>
</section>
