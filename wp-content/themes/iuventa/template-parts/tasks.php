<?php
/**
 * "Выберите задачу" section.
 *
 * @package iuventa
 */

$tasks = iuventa_tasks();
?>
<section class="section tasks" id="tasks">
	<div class="container">
		<h2 class="section-title">Выберите, с какой задачей обратиться к косметологу</h2>
		<p class="section-sub">Косметология в Самаре: лечение акне, уход за кожей, омоложение лица</p>

		<div class="tasks-grid">
			<?php foreach ( $tasks as $task ) : ?>
				<article class="task-card">
					<div class="task-card-body">
						<h3><?php echo esc_html( $task['title'] ); ?></h3>
						<p class="task-desc"><?php echo esc_html( $task['desc'] ); ?></p>
						<span class="task-tag">→ <?php echo esc_html( $task['tag'] ); ?></span>
						<span class="task-price"><?php echo esc_html( $task['price'] ); ?></span>
					</div>
					<div class="task-card-media">
						<img src="<?php echo esc_url( iuventa_img( $task['img'] ) ); ?>" alt="<?php echo esc_attr( $task['title'] ); ?>" loading="lazy">
					</div>
					<a class="task-overlay-link" href="#contact" aria-label="<?php echo esc_attr( $task['title'] ); ?>"></a>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
