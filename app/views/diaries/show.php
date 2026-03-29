<?php require('../app/views/components/common/head.php') ?>
<?php require('../app/views/components/common/header.php') ?>

<body>
	<main>
		<section>
			<div class="detail-section">
				<div class="diary-detail flex">
					<div class="img">
						<div class="background-white">
							<img src="<?= $diary['image'] ?>" alt="">
						</div>
					</div>
					<div class="detail">
						<p>タイトル：<?= $diary['title'] ?></p>
						<p>日付：<?= $diary['title'] ?></p>
						<p>作者：<?= $diary['title'] ?></p>
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
