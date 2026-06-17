<?php
/**
 * Footer template.
 *
 * @package iuventa
 */

$info    = iuventa_clinic_info();
$columns = iuventa_footer_columns();
?>
<footer class="site-footer" id="footer">
	<div class="container footer-cols">
		<?php foreach ( $columns as $col ) : ?>
			<div class="footer-col">
				<h4><?php echo esc_html( $col['title'] ); ?></h4>
				<ul>
					<?php foreach ( $col['links'] as $link ) : ?>
						<li><a href="#contact"><?php echo esc_html( $link ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endforeach; ?>
	</div>

	<div class="container footer-info">
		<p class="footer-desc">Центр косметологии Ювента предлагает современные косметологические процедуры для лечения и коррекции состояния кожи лица. Профессиональные косметологи подбирают эффективные методики с учётом индивидуальных особенностей пациента.</p>

		<div class="footer-legal">
			<p>ООО «Ювента»</p>
			<p><?php echo esc_html( $info['address'] ); ?></p>
			<p class="muted">Имеются противопоказания, необходима консультация специалиста. Цены на услуги, представленные на сайте, не являются публичной офертой.</p>
		</div>

		<div class="footer-brand">
			<img src="<?php echo esc_url( iuventa_img( 'logo-footer.png' ) ); ?>" alt="IUVENTA" class="footer-logo">
			<p class="muted">Политика конфиденциальности<br>Лицензия: Л041-01184-63/01471706</p>
			<a class="btn btn-primary btn-pill" href="#contact">Получить консультацию косметолога</a>
		</div>
	</div>

	<div class="footer-baseline">
		<span>© <?php echo esc_html( date( 'Y' ) ); ?> <?php echo esc_html( $info['name_ru'] ); ?> — клиника косметологии в Самаре</span>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
