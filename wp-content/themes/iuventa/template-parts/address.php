<?php
/**
 * Address + map section.
 *
 * @package iuventa
 */

$info = iuventa_clinic_info();
?>
<section class="section address" id="address">
	<div class="container address-inner">
		<div class="address-copy">
			<h2 class="section-title address-title">Адрес и контакты</h2>
			<p class="address-phone"><a href="tel:<?php echo esc_attr( $info['phone_raw'] ); ?>"><?php echo esc_html( $info['phone'] ); ?></a> <span class="muted">(администратор)</span></p>
			<p class="address-line"><strong><?php echo esc_html( $info['address'] ); ?></strong><br><span class="muted"><?php echo esc_html( $info['address_note'] ); ?></span></p>
			<div class="address-socials">
				<a href="https://vk.com/" class="soc" aria-label="VK">VK</a>
				<a href="https://t.me/" class="soc" aria-label="Telegram">✈</a>
			</div>
		</div>
		<div class="address-map">
			<iframe
				title="Карта — Самара, проспект Ленина 2А"
				src="https://yandex.ru/map-widget/v1/?text=<?php echo rawurlencode( 'Самара, проспект Ленина 2А' ); ?>&z=16"
				width="100%" height="360" frameborder="0" loading="lazy"></iframe>
		</div>
	</div>
</section>
