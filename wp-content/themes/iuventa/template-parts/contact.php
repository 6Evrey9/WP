<?php
/**
 * Contact / lead capture form.
 *
 * @package iuventa
 */

$info   = iuventa_clinic_info();
$status = isset( $_GET['lead'] ) ? sanitize_key( $_GET['lead'] ) : '';
?>
<section class="section contact" id="contact">
	<div class="container contact-inner">
		<div class="contact-copy">
			<h2 class="section-title section-title--light">Запишитесь на визит или задайте вопрос косметологу</h2>
			<p>Оценим состояние кожи, подберём процедуры и рассчитаем стоимость. Перезвоним через 15 минут.</p>

			<ul class="contact-list">
				<li><span class="contact-ico">☎</span> <a href="tel:<?php echo esc_attr( $info['phone_raw'] ); ?>"><?php echo esc_html( $info['phone'] ); ?></a></li>
				<li><span class="contact-ico">📍</span> <?php echo esc_html( $info['address'] ); ?>, <?php echo esc_html( $info['address_note'] ); ?></li>
			</ul>
		</div>

		<div class="contact-form-wrap">
			<?php if ( 'ok' === $status ) : ?>
				<div class="form-alert form-alert--ok">
					Спасибо! Заявка отправлена — мы свяжемся с вами в течение 15 минут.
				</div>
			<?php elseif ( 'error' === $status ) : ?>
				<div class="form-alert form-alert--error">
					Пожалуйста, заполните имя и телефон.
				</div>
			<?php endif; ?>

			<form class="lead-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
				<input type="hidden" name="action" value="iuventa_lead">
				<input type="hidden" name="lead_source" value="Главная — форма записи">
				<?php wp_nonce_field( 'iuventa_lead', 'iuventa_lead_nonce' ); ?>

				<label class="field">
					<span>Ваше имя</span>
					<input type="text" name="lead_name" placeholder="Например, Анна" required>
				</label>
				<label class="field">
					<span>Телефон</span>
					<input type="tel" name="lead_phone" placeholder="+7 (___) ___-__-__" required>
				</label>
				<label class="field">
					<span>Комментарий (необязательно)</span>
					<textarea name="lead_message" rows="3" placeholder="Какая процедура вас интересует?"></textarea>
				</label>

				<button type="submit" class="btn btn-primary btn-lg btn-block">Записаться на консультацию</button>
				<p class="form-note">Нажимая кнопку, вы соглашаетесь с обработкой персональных данных. Ваши данные никому не передаются!</p>
			</form>
		</div>
	</div>
</section>
