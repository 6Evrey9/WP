<?php
/**
 * Front page — the IUVENTA single-page landing.
 *
 * @package iuventa
 */

get_header();
?>
<main id="main" class="site-main">
	<?php
	get_template_part( 'template-parts/hero' );
	get_template_part( 'template-parts/tasks' );
	get_template_part( 'template-parts/promo' );
	get_template_part( 'template-parts/procedures' );
	get_template_part( 'template-parts/results' );
	get_template_part( 'template-parts/doctors' );
	get_template_part( 'template-parts/reviews' );
	get_template_part( 'template-parts/news' );
	get_template_part( 'template-parts/faq' );
	get_template_part( 'template-parts/contact' );
	?>
</main>
<?php
get_footer();
