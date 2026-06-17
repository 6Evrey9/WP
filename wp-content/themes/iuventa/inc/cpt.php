<?php
/**
 * Custom post types for editable content:
 *   - procedure  (Процедуры)   — each procedure is an editable page.
 *   - specialist (Косметологи) — each cosmetologist is an editable page.
 *
 * Existing content (from inc/content.php) is seeded once on theme activation,
 * so the entries are immediately available to edit in wp-admin.
 *
 * @package iuventa
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ---------------------------------------------------------- Register --- */

function iuventa_register_cpts() {
	register_post_type(
		'procedure',
		array(
			'labels'       => array(
				'name'               => 'Процедуры',
				'singular_name'      => 'Процедура',
				'menu_name'          => 'Процедуры',
				'add_new'            => 'Добавить процедуру',
				'add_new_item'       => 'Новая процедура',
				'edit_item'          => 'Редактировать процедуру',
				'all_items'          => 'Все процедуры',
				'search_items'       => 'Искать процедуры',
			),
			'public'       => true,
			'has_archive'  => true,
			'menu_icon'    => 'dashicons-heart',
			'menu_position'=> 21,
			'rewrite'      => array( 'slug' => 'procedure' ),
			'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
		)
	);

	register_post_type(
		'specialist',
		array(
			'labels'       => array(
				'name'               => 'Косметологи',
				'singular_name'      => 'Косметолог',
				'menu_name'          => 'Косметологи',
				'add_new'            => 'Добавить косметолога',
				'add_new_item'       => 'Новый косметолог',
				'edit_item'          => 'Редактировать косметолога',
				'all_items'          => 'Все косметологи',
				'search_items'       => 'Искать косметологов',
			),
			'public'       => true,
			'has_archive'  => true,
			'menu_icon'    => 'dashicons-groups',
			'menu_position'=> 22,
			'rewrite'      => array( 'slug' => 'specialist' ),
			'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
		)
	);
}
add_action( 'init', 'iuventa_register_cpts' );

/* --------------------------------------------------------- Meta boxes --- */

function iuventa_cpt_meta_boxes() {
	add_meta_box( 'iuventa_procedure_meta', 'Параметры процедуры', 'iuventa_procedure_meta_render', 'procedure', 'side', 'high' );
	add_meta_box( 'iuventa_specialist_meta', 'Данные косметолога', 'iuventa_specialist_meta_render', 'specialist', 'side', 'high' );
}
add_action( 'add_meta_boxes', 'iuventa_cpt_meta_boxes' );

function iuventa_field_row( $label, $name, $value, $type = 'text' ) {
	echo '<p><label style="display:block;font-weight:600;margin-bottom:4px">' . esc_html( $label ) . '</label>';
	if ( 'checkbox' === $type ) {
		echo '<label><input type="checkbox" name="' . esc_attr( $name ) . '" value="1" ' . checked( $value, '1', false ) . '> Показывать бейдж «хит»</label>';
	} elseif ( 'textarea' === $type ) {
		echo '<textarea name="' . esc_attr( $name ) . '" rows="3" style="width:100%">' . esc_textarea( $value ) . '</textarea>';
	} else {
		echo '<input type="text" name="' . esc_attr( $name ) . '" value="' . esc_attr( $value ) . '" style="width:100%">';
	}
	echo '</p>';
}

function iuventa_procedure_meta_render( $post ) {
	wp_nonce_field( 'iuventa_procedure_meta', 'iuventa_procedure_nonce' );
	iuventa_field_row( 'Краткое описание (для карточки)', 'iuventa_short', get_post_meta( $post->ID, '_iuventa_short', true ), 'textarea' );
	iuventa_field_row( 'Цена (например: от 1900Р)', 'iuventa_price', get_post_meta( $post->ID, '_iuventa_price', true ) );
	iuventa_field_row( 'Бейдж «хит»', 'iuventa_hit', get_post_meta( $post->ID, '_iuventa_hit', true ), 'checkbox' );
}

function iuventa_specialist_meta_render( $post ) {
	wp_nonce_field( 'iuventa_specialist_meta', 'iuventa_specialist_nonce' );
	iuventa_field_row( 'Специализация', 'iuventa_role', get_post_meta( $post->ID, '_iuventa_role', true ), 'textarea' );
	$photo = get_post_meta( $post->ID, '_iuventa_photo', true );
	iuventa_field_row( 'Фото из темы (имя файла)', 'iuventa_photo', $photo );
	echo '<p class="description">Если задать «Изображение записи» (справа), оно имеет приоритет над фото из темы.</p>';
}

function iuventa_save_cpt_meta( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['iuventa_procedure_nonce'] ) && wp_verify_nonce( $_POST['iuventa_procedure_nonce'], 'iuventa_procedure_meta' ) ) {
		update_post_meta( $post_id, '_iuventa_short', sanitize_textarea_field( wp_unslash( $_POST['iuventa_short'] ?? '' ) ) );
		update_post_meta( $post_id, '_iuventa_price', sanitize_text_field( wp_unslash( $_POST['iuventa_price'] ?? '' ) ) );
		update_post_meta( $post_id, '_iuventa_hit', isset( $_POST['iuventa_hit'] ) ? '1' : '' );
	}

	if ( isset( $_POST['iuventa_specialist_nonce'] ) && wp_verify_nonce( $_POST['iuventa_specialist_nonce'], 'iuventa_specialist_meta' ) ) {
		update_post_meta( $post_id, '_iuventa_role', sanitize_textarea_field( wp_unslash( $_POST['iuventa_role'] ?? '' ) ) );
		update_post_meta( $post_id, '_iuventa_photo', sanitize_text_field( wp_unslash( $_POST['iuventa_photo'] ?? '' ) ) );
	}
}
add_action( 'save_post', 'iuventa_save_cpt_meta' );

/* ------------------------------------------------------ Admin columns --- */

function iuventa_procedure_columns( $cols ) {
	$new = array();
	foreach ( $cols as $k => $v ) {
		$new[ $k ] = $v;
		if ( 'title' === $k ) {
			$new['iuventa_price'] = 'Цена';
			$new['iuventa_hit']   = 'Хит';
		}
	}
	return $new;
}
add_filter( 'manage_procedure_posts_columns', 'iuventa_procedure_columns' );

function iuventa_procedure_column( $col, $post_id ) {
	if ( 'iuventa_price' === $col ) {
		echo esc_html( get_post_meta( $post_id, '_iuventa_price', true ) );
	}
	if ( 'iuventa_hit' === $col ) {
		echo get_post_meta( $post_id, '_iuventa_hit', true ) ? '★' : '—';
	}
}
add_action( 'manage_procedure_posts_custom_column', 'iuventa_procedure_column', 10, 2 );

/* ----------------------------------------------------------- Helpers --- */

/**
 * Photo URL for a specialist: featured image if set, else theme image by name.
 */
function iuventa_specialist_photo( $post_id ) {
	if ( has_post_thumbnail( $post_id ) ) {
		return get_the_post_thumbnail_url( $post_id, 'large' );
	}
	$file = get_post_meta( $post_id, '_iuventa_photo', true );
	return $file ? iuventa_img( $file ) : iuventa_img( 'hero-portrait.png' );
}

/**
 * Render a "other procedures" block on a single procedure page.
 */
function iuventa_related_procedures( $exclude_id ) {
	$q = new WP_Query(
		array(
			'post_type'      => 'procedure',
			'posts_per_page' => 3,
			'post__not_in'   => array( $exclude_id ),
			'orderby'        => 'rand',
			'no_found_rows'  => true,
		)
	);
	if ( ! $q->have_posts() ) {
		return;
	}
	echo '<section class="section related"><div class="container">';
	echo '<h2 class="section-title">Другие процедуры</h2><div class="procedures-grid">';
	while ( $q->have_posts() ) {
		$q->the_post();
		$price = get_post_meta( get_the_ID(), '_iuventa_price', true );
		$short = get_post_meta( get_the_ID(), '_iuventa_short', true );
		echo '<article class="procedure-card"><h3>' . esc_html( get_the_title() ) . '</h3>';
		echo '<p class="procedure-desc">' . esc_html( $short ) . '</p>';
		if ( $price ) {
			echo '<p class="procedure-price">' . esc_html( $price ) . '</p>';
		}
		echo '<a class="btn btn-dark" href="' . esc_url( get_permalink() ) . '">Подробнее</a></article>';
	}
	echo '</div></div></section>';
	wp_reset_postdata();
}

/* ----------------------------------------------------------- Seeding --- */

/**
 * Seed the initial procedures and specialists once, from the static content.
 * Idempotent: guarded by the 'iuventa_seeded' option.
 */
function iuventa_seed_content() {
	if ( get_option( 'iuventa_seeded' ) ) {
		return;
	}

	if ( function_exists( 'iuventa_procedures' ) ) {
		$menu_order = 0;
		foreach ( iuventa_procedures() as $p ) {
			$id = wp_insert_post(
				array(
					'post_type'    => 'procedure',
					'post_status'  => 'publish',
					'post_title'   => $p['title'],
					'post_excerpt' => $p['desc'],
					'post_content' => $p['desc'] . "\n\nЗапишитесь на консультацию — косметолог подберёт программу под вашу задачу и рассчитает стоимость.",
					'menu_order'   => $menu_order++,
				)
			);
			if ( $id && ! is_wp_error( $id ) ) {
				update_post_meta( $id, '_iuventa_short', $p['desc'] );
				update_post_meta( $id, '_iuventa_price', $p['price'] );
				update_post_meta( $id, '_iuventa_hit', ! empty( $p['hit'] ) ? '1' : '' );
			}
		}
	}

	if ( function_exists( 'iuventa_doctors' ) ) {
		$menu_order = 0;
		foreach ( iuventa_doctors() as $d ) {
			$id = wp_insert_post(
				array(
					'post_type'    => 'specialist',
					'post_status'  => 'publish',
					'post_title'   => $d['name'],
					'post_excerpt' => $d['role'],
					'post_content' => $d['role'] . "\n\nВрач-косметолог клиники «Ювента» в Самаре. Проводит процедуры по современным протоколам доказательной медицины.",
					'menu_order'   => $menu_order++,
				)
			);
			if ( $id && ! is_wp_error( $id ) ) {
				update_post_meta( $id, '_iuventa_role', $d['role'] );
				update_post_meta( $id, '_iuventa_photo', $d['img'] );
			}
		}
	}

	update_option( 'iuventa_seeded', 1 );
}

/**
 * On theme activation: ensure CPTs are registered, seed content, flush rules.
 */
function iuventa_after_switch_theme() {
	iuventa_register_cpts();
	iuventa_seed_content();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'iuventa_after_switch_theme' );
