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
	<div class="container header-inner">
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<span class="brand-mark">IUVENTA</span>
			<span class="brand-sub">косметология</span>
		</a>

		<nav class="main-nav" aria-label="Главное меню">
			<a href="#tasks">Услуги</a>
			<a href="#procedures">Цены</a>
			<a href="#doctors">Специалисты</a>
			<a href="#reviews">Отзывы</a>
			<a href="#news">Блог</a>
			<a href="#contact">Контакты</a>
		</nav>

		<div class="header-actions">
			<a class="header-phone" href="tel:<?php echo esc_attr( $info['phone_raw'] ); ?>"><?php echo esc_html( $info['phone'] ); ?></a>
			<a class="btn btn-primary btn-sm" href="#contact">Записаться</a>
		</div>

		<button class="nav-toggle" aria-label="Меню" aria-expanded="false">
			<span></span><span></span><span></span>
		</button>
	</div>
</header>
