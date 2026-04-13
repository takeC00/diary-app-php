<?php require('../app/views/components/common/head.php') ?>
<?php require('../app/views/components/common/header.php') ?>

<body>
	<main>

		<section>
		<?php if (!empty($_SESSION['error'])): ?>
					<?php foreach($_SESSION['error'] as $error) :?>
						<p class="error-message">
							<?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
						</p>
					<?php endforeach ;?>
					<?php unset($_SESSION['error']); ?>
				<?php endif; ?>
			<img class="err-img" src = "/images/defaults/404.jpeg">
		</section>
	</main>
</body>
<?php require('../app/views/components/common/footer.php') ?>

</html>
