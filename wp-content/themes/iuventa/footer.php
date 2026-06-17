<?php
/**
 * Footer template.
 *
 * @package iuventa
 */

$info = iuventa_clinic_info();
?>
<footer class="site-footer" id="footer">
	<div class="container footer-grid">
		<div class="footer-col footer-about">
			<span class="brand-mark brand-mark--light">IUVENTA</span>
			<p>Клиника косметологии в Самаре. Работаем по методам доказательной медицины. 3000+ клиентов и рейтинг <?php echo esc_html( $info['rating'] ); ?> на Яндексе.</p>
			<a class="btn btn-primary" href="#contact">Записаться на консультацию</a>
		</div>

		<div class="footer-col">
			<h4>Направления</h4>
			<ul>
				<li><a href="#tasks">Морщины и овал лица</a></li>
				<li><a href="#tasks">Лечение акне</a></li>
				<li><a href="#tasks">Уход за кожей</a></li>
				<li><a href="#tasks">Консультация</a></li>
			</ul>
		</div>

		<div class="footer-col">
			<h4>Популярные процедуры</h4>
			<ul>
				<li><a href="#procedures">RF-лифтинг лица</a></li>
				<li><a href="#procedures">Ботокс от морщин</a></li>
				<li><a href="#procedures">Чистка лица</a></li>
				<li><a href="#procedures">Увеличение губ</a></li>
			</ul>
		</div>

		<div class="footer-col">
			<h4>Контакты</h4>
			<ul>
				<li><a href="tel:<?php echo esc_attr( $info['phone_raw'] ); ?>"><?php echo esc_html( $info['phone'] ); ?></a></li>
				<li><?php echo esc_html( $info['address'] ); ?></li>
				<li class="muted"><?php echo esc_html( $info['address_note'] ); ?></li>
			</ul>
		</div>
	</div>

	<div class="container footer-bottom">
		<span>© <?php echo esc_html( date( 'Y' ) ); ?> <?php echo esc_html( $info['name_ru'] ); ?> — клиника косметологии в Самаре</span>
		<span class="muted">Имеются противопоказания, необходима консультация специалиста</span>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
