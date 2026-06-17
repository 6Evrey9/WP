<?php
/**
 * IUVENTA theme functions.
 *
 * @package iuventa
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'IUVENTA_VERSION', '1.0.0' );

require_once get_template_directory() . '/inc/content.php';
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/cpt.php';

/**
 * Theme setup.
 */
function iuventa_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo' );

	register_nav_menus(
		array(
			'primary' => __( 'Главное меню', 'iuventa' ),
		)
	);
}
add_action( 'after_setup_theme', 'iuventa_setup' );

/**
 * Enqueue styles and scripts.
 */
function iuventa_assets() {
	$dir = get_template_directory();
	$uri = get_template_directory_uri();

	wp_enqueue_style(
		'iuventa-fonts',
		'https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'iuventa-main',
		$uri . '/assets/css/main.css',
		array( 'iuventa-fonts' ),
		file_exists( $dir . '/assets/css/main.css' ) ? filemtime( $dir . '/assets/css/main.css' ) : IUVENTA_VERSION
	);

	wp_enqueue_script(
		'iuventa-main',
		$uri . '/assets/js/main.js',
		array(),
		file_exists( $dir . '/assets/js/main.js' ) ? filemtime( $dir . '/assets/js/main.js' ) : IUVENTA_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'iuventa_assets' );

/**
 * Helper: theme image URL.
 */
function iuventa_img( $file ) {
	return get_template_directory_uri() . '/assets/img/' . $file;
}

/* -------------------------------------------------------------------------
 * Lead capture — consultation requests are stored as a custom post type so
 * they can be managed inside wp-admin.
 * ---------------------------------------------------------------------- */

function iuventa_register_lead_cpt() {
	register_post_type(
		'iuventa_lead',
		array(
			'labels'       => array(
				'name'          => 'Заявки',
				'singular_name' => 'Заявка',
				'menu_name'     => 'Заявки',
				'all_items'     => 'Все заявки',
			),
			'public'       => false,
			'show_ui'      => true,
			'show_in_menu' => true,
			'menu_icon'    => 'dashicons-phone',
			'menu_position'=> 25,
			'supports'     => array( 'title' ),
			'capability_type' => 'post',
		)
	);
}
add_action( 'init', 'iuventa_register_lead_cpt' );

/**
 * Handle the consultation form submission (admin-post.php endpoint).
 */
function iuventa_handle_lead() {
	$redirect = wp_get_referer() ? wp_get_referer() : home_url( '/' );

	if ( ! isset( $_POST['iuventa_lead_nonce'] ) || ! wp_verify_nonce( $_POST['iuventa_lead_nonce'], 'iuventa_lead' ) ) {
		wp_safe_redirect( add_query_arg( 'lead', 'error', $redirect ) . '#contact' );
		exit;
	}

	$name    = isset( $_POST['lead_name'] ) ? sanitize_text_field( wp_unslash( $_POST['lead_name'] ) ) : '';
	$phone   = isset( $_POST['lead_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['lead_phone'] ) ) : '';
	$message = isset( $_POST['lead_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['lead_message'] ) ) : '';
	$source  = isset( $_POST['lead_source'] ) ? sanitize_text_field( wp_unslash( $_POST['lead_source'] ) ) : 'site';

	if ( '' === $name || '' === $phone ) {
		wp_safe_redirect( add_query_arg( 'lead', 'error', $redirect ) . '#contact' );
		exit;
	}

	$lead_id = wp_insert_post(
		array(
			'post_type'   => 'iuventa_lead',
			'post_status' => 'publish',
			'post_title'  => sprintf( '%s — %s', $name, $phone ),
		)
	);

	if ( $lead_id && ! is_wp_error( $lead_id ) ) {
		update_post_meta( $lead_id, '_iuventa_name', $name );
		update_post_meta( $lead_id, '_iuventa_phone', $phone );
		update_post_meta( $lead_id, '_iuventa_message', $message );
		update_post_meta( $lead_id, '_iuventa_source', $source );
		wp_safe_redirect( add_query_arg( 'lead', 'ok', $redirect ) . '#contact' );
		exit;
	}

	wp_safe_redirect( add_query_arg( 'lead', 'error', $redirect ) . '#contact' );
	exit;
}
add_action( 'admin_post_nopriv_iuventa_lead', 'iuventa_handle_lead' );
add_action( 'admin_post_iuventa_lead', 'iuventa_handle_lead' );

/**
 * Show lead contact details in the admin list.
 */
function iuventa_lead_columns( $columns ) {
	return array(
		'cb'             => $columns['cb'],
		'title'          => 'Заявка',
		'iuventa_phone'  => 'Телефон',
		'iuventa_source' => 'Источник',
		'date'           => 'Дата',
	);
}
add_filter( 'manage_iuventa_lead_posts_columns', 'iuventa_lead_columns' );

function iuventa_lead_column_content( $column, $post_id ) {
	if ( 'iuventa_phone' === $column ) {
		echo esc_html( get_post_meta( $post_id, '_iuventa_phone', true ) );
	}
	if ( 'iuventa_source' === $column ) {
		echo esc_html( get_post_meta( $post_id, '_iuventa_source', true ) );
	}
}
add_action( 'manage_iuventa_lead_posts_custom_column', 'iuventa_lead_column_content', 10, 2 );

/**
 * Render a meta box with full lead details on the edit screen.
 */
function iuventa_lead_meta_box() {
	add_meta_box( 'iuventa_lead_details', 'Данные заявки', 'iuventa_lead_meta_box_render', 'iuventa_lead', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'iuventa_lead_meta_box' );

function iuventa_lead_meta_box_render( $post ) {
	$fields = array(
		'Имя'        => get_post_meta( $post->ID, '_iuventa_name', true ),
		'Телефон'    => get_post_meta( $post->ID, '_iuventa_phone', true ),
		'Сообщение'  => get_post_meta( $post->ID, '_iuventa_message', true ),
		'Источник'   => get_post_meta( $post->ID, '_iuventa_source', true ),
	);
	echo '<table class="form-table">';
	foreach ( $fields as $label => $value ) {
		echo '<tr><th style="width:160px">' . esc_html( $label ) . '</th><td>' . esc_html( $value ? $value : '—' ) . '</td></tr>';
	}
	echo '</table>';
}
