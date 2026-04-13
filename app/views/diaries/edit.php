<?php require('../app/views/components/common/head.php') ?>
<?php require('../app/views/components/common/header.php') ?>
<body>
	<main>
		<section>
			<?php if (!empty($_SESSION['error'])): ?>
			<?php foreach ($_SESSION['error'] as $error) :?>
			<p class="error-message">
				<?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
			</p>
			<?php endforeach ;?>
			<?php endif; ?>
			<div class="button-section">
				<a href="<?= $backUrl ?>"><button class="back">戻る</button></a>
			</div>
			<div class="detail-section">
				<div class="diary-detail flex">
					<div class="img">
						<div class="background-white">
							<img src="<?= $diary['image'] ? $diary['image'] : '/images/defaults/default.png' ; ?>" alt="" id="preview" class="">
						</div>
					</div>
					<form action="/edit/<?= $diary['id'] ?>" method="POST" enctype="multipart/form-data">
						<div class="form-row">
							<p class="mini-title">タイトル：</p>
							<input type="text" name="title"
								value="<?= !empty($_SESSION['old']['title']) ? htmlspecialchars($_SESSION['old']['title'], ENT_QUOTES, 'UTF-8'): $diary['title'] ;?>"
								class="<?= !empty($_SESSION['error']['title']) ? 'error' : '' ?>">
						</div>

						<div class="form-row">
							<p class="mini-title">日付：</p>
							<input type="date" name="diary_date"
								value="<?= !empty($_SESSION['old']['diary_date']) ? htmlspecialchars($_SESSION['old']['diary_date'], ENT_QUOTES, 'UTF-8'): $diary['diary_date'] ;?>"
								class="<?= !empty($_SESSION['error']['diary_date']) ? 'error' : '' ?>">
						</div>

						<div class="form-row">
							<p class="mini-title">画像：</p>
							<div>
								<input type="file" name="diary_image" id="imageInput"
									class="<?= !empty($_SESSION['error']['image']) ? 'error' : $diary['image'] ?>">
							</div>
						</div>

						<div class="form-row">
							<p class="mini-title public">公開設定：</p>
							<div class="radio-group">
							<?php	$currentIsPublic = isset($_SESSION['old']['is_public'])	? (string)$_SESSION['old']['is_public'] : (string)$diary['is_public']; ?>
							<div class="radio-group">
								<label>
									<input type="radio" name="is_public" value="1" <?= $currentIsPublic === '1' ? 'checked' : '' ?>>
									公開
								</label>

								<label>
									<input type="radio" name="is_public" value="0" <?= $currentIsPublic === '0' ? 'checked' : '' ?>>
									非公開
								</label>
							</div>
							</div>
						</div>

						<div class="form-row">
							<p class="mini-title">本文：</p>
							<textarea class="<?= !empty($_SESSION['error']['body']) ? 'error' : '' ?>"
								name="body"><?= !empty($_SESSION['old']['body']) ? htmlspecialchars($_SESSION['old']['body'], ENT_QUOTES, 'UTF-8'): $diary['body'] ;?></textarea>
						</div>

						<div class="button-section">
							<button class="create" type="submit">更新</button>
						</div>
					</form>
				</div>
			</div>
		</section>
	</main>
	<?php unset($_SESSION['error']) ;?>
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
