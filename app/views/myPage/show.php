<?php require('../app/views/components/common/head.php') ?>
<?php require('../app/views/components/common/header.php') ?>

<body>
	<main>
		<section>
			<h1>
				<?= htmlspecialchars($diaries[0]['name'], ENT_QUOTES, 'UTF-8') ?>の日記一覧
					<img src="<?= !empty($diaries[0]['icon']) ? $diaries[0]['icon'] : '/images/defaults/default.png'; ?>"
							class="icon" alt="">
			</h1>
			<div>
				<?php if (!empty($_SESSION['success'])): ?>
				<p class="green-message">
					<?= htmlspecialchars($_SESSION['success'], ENT_QUOTES, 'UTF-8') ?>
				</p>
				<?php unset($_SESSION['success']); ?>
				<?php endif; ?>
			</div>
			<div class="diary-detail flex">
				<div class="detail">
					<p class="mini-title">自己紹介：</p>
					<?php if (!empty($diaries[0]['introduction'])) :?>
						<p><?= $diaries[0]['introduction'] ?></p>
					<?php endif ;?>
				</div>
				<div>
						<p class="mini-title">日記一覧：</p>
						<div class="user-diary-grid">
							<?php foreach ($diaries as $diary): ?>
							<a href="/show/<?= (int)$diary['id'] ?>?from=myPage&page=<?= (int)$page ?>" class="grid-item">
								<img src="<?= !empty($diary['image']) ? $diary['image'] : '/images/defaults/default.png'; ?>">
							</a>
							<?php endforeach; ?>
						</div>
					</div>
			</div>
			<div class="user-diaries">
				<?php require('../app/views/components/common/pagination.php') ?>
			</div>
		</section>
	</main>
</body>
<?php require('../app/views/components/common/footer.php') ?>

</html>
