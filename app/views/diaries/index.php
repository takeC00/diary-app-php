<?php require('../app/views/components/common/head.php') ?>
<?php require('../app/views/components/common/header.php') ?>
<body>
	<main>
		<section>
			<div>
				<div class="diary-list">
					<?php foreach ($diaries as $diary): ?>
						<?php require('../app/views/components/diary/card.php') ?>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
	</main>
</body>
<?php require('../app/views/components/common/footer.php') ?>
</html>
