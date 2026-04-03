<?php require('../app/views/components/common/head.php') ?>
<?php require('../app/views/components/common/header.php') ?>

<body>
	<main>
		<section>
			<div>
				<?php if (!empty($_SESSION['success'])): ?>
				<p class="green-message">
					<?= htmlspecialchars($_SESSION['success'], ENT_QUOTES, 'UTF-8') ?>
				</p>
				<?php unset($_SESSION['success']); ?>
				<?php endif; ?>
				<div class="diary-list">
					<?php foreach ($diaries as $diary): ?>
					<?php require('../app/views/components/diary/card.php') ?>
					<?php endforeach; ?>
				</div>
			</div>
			<?php require('../app/views/components/common/pagination.php') ?>
		</section>
	</main>
</body>
<?php require('../app/views/components/common/footer.php') ?>

</html>
