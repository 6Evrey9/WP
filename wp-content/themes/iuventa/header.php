<?php
/**
 * Header template.
 *
 * @package iuventa
 */

$info = iuventa_clinic_info();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Клиника косметологии Ювента (IUVENTA) в Самаре: омоложение, лечение акне, чистка лица, RF-лифтинг. Работаем по методам доказательной медицины.">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
	<div class="container header-top">
		<div class="header-socials">
			<a href="https://t.me/" aria-label="Telegram" class="soc">✈</a>
			<a href="https://wa.me/<?php echo esc_attr( ltrim( $info['phone_raw'], '+' ) ); ?>" aria-label="WhatsApp" class="soc">✆</a>
			<a href="https://vk.com/" aria-label="VK" class="soc">VK</a>
		</div>

		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="IUVENTA">
			<img src="<?php echo esc_url( iuventa_img( 'logo.png' ) ); ?>" alt="IUVENTA" class="brand-logo">
		</a>

		<div class="header-actions">
			<a class="header-phone" href="tel:<?php echo esc_attr( $info['phone_raw'] ); ?>"><?php echo esc_html( $info['phone'] ); ?></a>
			<a class="btn btn-primary btn-sm" href="#contact">Записаться</a>
		</div>

		<button class="nav-toggle" aria-label="Меню" aria-expanded="false">
			<span></span><span></span><span></span>
		</button>
	</div>

	<nav class="main-nav" aria-label="Главное меню">
		<div class="container main-nav-inner">
			<a href="#top">Главная</a>
			<a href="#tasks">Услуги</a>
			<a href="#procedures">Цены</a>
			<a href="#doctors">Специалисты</a>
			<a href="#news">Блог</a>
			<a href="#contact">Контакты</a>
		</div>
	</nav>
</header>
