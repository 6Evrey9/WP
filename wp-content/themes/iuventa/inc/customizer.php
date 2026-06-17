<?php
/**
 * Customizer — separate editing of the main (front) page content.
 *
 * Adds a "Главная страница (Ювента)" panel with Hero, Promo (RF-лифтинг),
 * Contacts and Clinic info sections. All homepage strings read through
 * iuventa_opt(), which falls back to sensible defaults so nothing breaks
 * before anything is edited.
 *
 * @package iuventa
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Editable homepage option with default. Stored as a theme mod.
 */
function iuventa_opt( $key, $default = '' ) {
	$value = get_theme_mod( 'iuventa_' . $key, null );
	return ( null === $value || '' === $value ) ? $default : $value;
}

/**
 * Default values for the editable homepage strings.
 */
function iuventa_opt_defaults() {
	return array(
		// Hero.
		'hero_eyebrow' => 'Клиника косметологии Ювента | IUVENTA в Самаре',
		'hero_title'   => 'Уберём морщины и подтянем овал лица за 1–5 процедур',
		'hero_lead'    => 'Работаем по методам доказательной медицины. 3000+ клиентов и рейтинг 5.0 на Яндексе',
		'hero_note'    => 'Свяжемся в течение 15 минут • Ваши данные никому не передаются!',
		// Promo.
		'promo_pill'     => 'RF-лифтинг в Самаре — акция месяца',
		'promo_title'    => 'RF-лифтинг лица',
		'promo_now'      => '1900Р',
		'promo_old'      => '4000Р',
		'promo_discount' => '-53%',
		'promo_desc'     => 'Аппаратная процедура подтяжки кожи без операции. Подходит для омоложения, уменьшения морщин и второго подбородка. Стимулирует выработку коллагена, делает кожу более упругой и плотной.',
		'promo_gift'     => '+ Подарок: спектральный анализ кожи',
		// Contact.
		'contact_title' => 'Запишитесь на визит или задайте вопрос косметологу',
		'contact_text'  => 'Оценим состояние кожи, подберём процедуры и рассчитаем стоимость. Перезвоним через 15 минут.',
		// Clinic info.
		'phone'         => '+7 917 106 33 22',
		'phone_raw'     => '+79171063322',
		'address'       => 'Самара, проспект Ленина 2А',
		'address_note'  => 'вход справа от 4 подъезда',
		'rating'        => '5.0',
		'reviews_count' => '273',
	);
}

function iuventa_default( $key ) {
	$defaults = iuventa_opt_defaults();
	return $defaults[ $key ] ?? '';
}

function iuventa_customize_register( $wp_customize ) {
	$wp_customize->add_panel(
		'iuventa_home',
		array(
			'title'    => 'Главная страница (Ювента)',
			'priority' => 20,
		)
	);

	$sections = array(
		'hero'    => 'Первый экран (Hero)',
		'promo'   => 'Акция RF-лифтинг',
		'contact' => 'Блок записи',
		'clinic'  => 'Контакты клиники',
	);
	foreach ( $sections as $id => $title ) {
		$wp_customize->add_section(
			'iuventa_' . $id,
			array(
				'title' => $title,
				'panel' => 'iuventa_home',
			)
		);
	}

	$fields = array(
		'hero'    => array(
			'hero_eyebrow' => array( 'Надзаголовок', 'text' ),
			'hero_title'   => array( 'Заголовок', 'textarea' ),
			'hero_lead'    => array( 'Подзаголовок', 'textarea' ),
			'hero_note'    => array( 'Примечание под кнопками', 'text' ),
		),
		'promo'   => array(
			'promo_pill'     => array( 'Плашка-акция', 'text' ),
			'promo_title'    => array( 'Заголовок', 'text' ),
			'promo_now'      => array( 'Цена по акции', 'text' ),
			'promo_old'      => array( 'Старая цена', 'text' ),
			'promo_discount' => array( 'Скидка', 'text' ),
			'promo_desc'     => array( 'Описание', 'textarea' ),
			'promo_gift'     => array( 'Подарок', 'text' ),
		),
		'contact' => array(
			'contact_title' => array( 'Заголовок', 'textarea' ),
			'contact_text'  => array( 'Текст', 'textarea' ),
		),
		'clinic'  => array(
			'phone'         => array( 'Телефон (отображение)', 'text' ),
			'phone_raw'     => array( 'Телефон (для ссылки tel:)', 'text' ),
			'address'       => array( 'Адрес', 'text' ),
			'address_note'  => array( 'Уточнение адреса', 'text' ),
			'rating'        => array( 'Рейтинг', 'text' ),
			'reviews_count' => array( 'Кол-во отзывов', 'text' ),
		),
	);

	$defaults = iuventa_opt_defaults();
	foreach ( $fields as $section => $controls ) {
		foreach ( $controls as $key => $meta ) {
			list( $label, $type ) = $meta;
			$wp_customize->add_setting(
				'iuventa_' . $key,
				array(
					'default'           => $defaults[ $key ] ?? '',
					'sanitize_callback' => ( 'textarea' === $type ) ? 'sanitize_textarea_field' : 'sanitize_text_field',
					'transport'         => 'refresh',
				)
			);
			$wp_customize->add_control(
				'iuventa_' . $key,
				array(
					'label'   => $label,
					'section' => 'iuventa_' . $section,
					'type'    => ( 'textarea' === $type ) ? 'textarea' : 'text',
				)
			);
		}
	}
}
add_action( 'customize_register', 'iuventa_customize_register' );
