<?php require('../app/views/components/common/head.php') ?>
<?php require('../app/views/components/common/header.php') ?>

<body>
	<main>
		<section>
			<div class="button-section">
				<a href="/edit/<?= htmlspecialchars($diary['id'], ENT_QUOTES, 'UTF-8') ?>"><button class="edit">編集</button></a>
				<a href="/delete/<?= htmlspecialchars($diary['id'], ENT_QUOTES, 'UTF-8') ?>"><button class="delete">削除</button></a>
				<a href="/"><button class="back">戻る</button></a>
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
