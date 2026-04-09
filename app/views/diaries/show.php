<?php require('../app/views/components/common/head.php') ?>
<?php require('../app/views/components/common/header.php') ?>
<body>
	<main>
		<section>
			<?php if (!empty($_SESSION['success'])): ?>
			<p class="green-message">
				<?= htmlspecialchars($_SESSION['success'], ENT_QUOTES, 'UTF-8') ?>
			</p>
			<?php unset($_SESSION['success']); ?>
			<?php endif; ?>
			<div class="button-section">
				<?php if (isOwner($diary)&&isLogin()): ?>
				<a href="/edit/<?= htmlspecialchars($diary['id'], ENT_QUOTES, 'UTF-8') ?>?from=show"><button class="edit">編集</button></a>
				<form method="POST" action="/delete/<?= htmlspecialchars($diary['id'], ENT_QUOTES, 'UTF-8') ?>"
					onsubmit="return confirm('削除しますか？');">
					<button type="submit" class="delete">削除</button>
				</form>
				<?php else :?>
					<a href="/myPage/<?= $diary['user_id'] ?>" class="btn my-page">この人の日記一覧を見る</a>
				<?php endif ;?>
				<a href="<?= htmlspecialchars($backUrl, ENT_QUOTES, 'UTF-8') ?>" class="btn">戻る</a>
			</div>


			<div class="detail-section">
				<div class="diary-detail flex">
					<div class="img">
						<div class="background-white">
							<img src="<?= $diary['image'] ? $diary['image'] : '/images/default.png' ; ?>" alt="">
						</div>
					</div>

					<div class="detail">
						<p>タイトル：<?= $diary['title'] ?></p>
						<p>日付：<?= $diary['diary_date'] ?></p>
						<p>作者：<?= $diary['user_name'] ?></p>
					</div>
				</div>
				<div class="detail-text">
					<p class="detail-body">
					<p><?= $diary['body'] ?></p>
					</p>
				</div>
			</div>
		</section>
	</main>
</body>
<?php require('../app/views/components/common/footer.php') ?>

</html>
