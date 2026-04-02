<?php require('../app/views/components/common/head.php') ?>
<?php require('../app/views/components/common/header.php') ?>

<body>
	<main>
		<section>
			<?php if (!empty($_SESSION['error']['image'])): ?>
			<p class="error-message">
				<?= htmlspecialchars($_SESSION['error']['image'], ENT_QUOTES, 'UTF-8') ?>
			</p>
			<?php unset($_SESSION['error']['image']); ?>
			<?php endif; ?>
			<div class="button-section">
				<?php if (isOwner($diary)&&isLogin()): ?>
				<a href="/edit/<?= htmlspecialchars($diary['id'], ENT_QUOTES, 'UTF-8') ?>"><button class="edit">編集</button></a>
				<a href="/delete/<?= htmlspecialchars($diary['id'], ENT_QUOTES, 'UTF-8') ?>"><button
						class="delete">削除</button></a>
				<?php endif ;?>
				<a href="/"><button class="back">戻る</button></a>
			</div>

			<form action="/edit/<?= $diary['id'] ?>" method="POST" enctype="multipart/form-data">
				<div class="detail-section">
					<div class="diary-detail flex">
						<div class="img">
							<div class="background-white">
								<img src="<?= $diary['image'] ? $diary['image'] : '/images/default.png' ; ?>" alt="">
							</div>
						</div>

						<div class="detail">
							<p class="mini-title">タイトル：<input type="text" name="title" value="<?= $diary['title'] ?>"></p>
							<p class="mini-title">日付：<input type="date" name="diary_date" value="<?= $diary['diary_date'] ?>"></p>
							<p class="mini-title">画像：<input type="file" name="diary_image" id="imageInput"></p>
							<img id="preview" style="max-width: 300px; display: none;">
						</div>
					</div>
					<div class="detail-text">
						<p class="detail-body">
							<textarea name='body' class=""><?= $diary['body'] ?></textarea>
						</p>
					</div>
					<div class="update-button">
						<button class="" type="submit">更新</button>
					</div>
				</div>
			</form>
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
