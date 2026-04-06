<?php require('../app/views/components/common/head.php') ?>
<?php require('../app/views/components/common/header.php') ?>
<body>
	<main>
		<section>
			<h1>
				マイページ
					<img src="<?= !empty($diaries[0]['icon']) ? $diaries[0]['icon'] : '/images/default.png'; ?>"
						class="icon" alt="">
			</h1>
			<form action="/myPage/edit/<?= (int)$_SESSION['user']['id'] ?>" method="POST" enctype="multipart/form-data">
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
							<textarea name="introduction"><?= htmlspecialchars($diaries[0]['introduction'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
						<p class="mini-title">アイコン：</p>
						<input type="file" name="icon" id="imageInput">
						<img id="preview" class="preview">
					</div>
					<div class="user-diary-grid">
						<?php foreach ($diaries as $diary): ?>
						<a href="/show/<?= (int)$diary['id'] ?>?from=public&page=<?= (int)$page ?>" class="grid-item">
							<img src="<?= !empty($diary['image']) ? $diary['image'] : '/images/default.png'; ?>">
						</a>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="update-button-my-page">
						<button class="" type="submit">更新</button>
					</div>
			</form>

			<div class="user-diaries">
				<?php require('../app/views/components/common/pagination.php') ?>
			</div>
		</section>
	</main>
</body>
<?php require('../app/views/components/common/footer.php') ?>
<script>
document.getElementById('imageInput').addEventListener('change', function(e) {
	const file = e.target.files[0];

	if (!file) return;

	const reader = new FileReader();

	reader.onload = function(event) {
		const img = document.getElementById('preview');
		img.src = event.target.result;
		img.style.display = 'block';
	};

	reader.readAsDataURL(file);
});
</script>
</html>
