<?php
/**
 * FAQ accordion.
 *
 * @package iuventa
 */

$faq = iuventa_faq();
?>
<section class="section faq" id="faq">
	<div class="container container--narrow">
		<h2 class="section-title">Частые вопросы о косметологии в Самаре</h2>

		<div class="faq-list">
			<?php foreach ( $faq as $item ) : ?>
				<details class="faq-item">
					<summary><?php echo esc_html( $item['q'] ); ?><span class="faq-icon"></span></summary>
					<div class="faq-answer"><p><?php echo esc_html( $item['a'] ); ?></p></div>
				</details>
			<?php endforeach; ?>
		</div>
	</div>
</section>
