<?php
/**
 * Doctors / specialists.
 *
 * @package iuventa
 */

$doctors = iuventa_doctors();
?>
<section class="section doctors" id="doctors">
	<div class="container">
		<h2 class="section-title">Косметологи клиники Ювента в Самаре с медицинским образованием</h2>
		<p class="section-sub">Врачи-косметологи с опытом работы от 4 лет</p>

		<div class="doctors-grid">
			<?php foreach ( $doctors as $d ) : ?>
				<article class="doctor-card">
					<div class="doctor-media">
						<img src="<?php echo esc_url( iuventa_img( $d['img'] ) ); ?>" alt="<?php echo esc_attr( $d['name'] ); ?>" loading="lazy">
					</div>
					<div class="doctor-body">
						<h3><?php echo esc_html( $d['name'] ); ?></h3>
						<p><?php echo esc_html( $d['role'] ); ?></p>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
