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
			<!-- ページが2以上ならページネーション -->
			<?php if ($totalPages > 1): ?>
				<div class="pagination">

					<!-- 1ページ目は戻るボタン無効化 -->
					<?php $page == 1 ? $gray='gray' : $gray = '' ;?>
					<button class="page-button arrow <?= $gray ?>">
						<?php if(!$gray) :?>
							<a href="?page=<?= $_GET['page'] - 1 ?>"> < </a>
						<?php else: ?>
							<
						<?php endif; ?>
					</button>

					<?php for ($i = 1; $i <= $totalPages; $i++): ?>
						<?php if ($page === $i): ?>
							<button class="page-button current"><?= $i ?></button>
						<?php else: ?>
							<a href="?page=<?= $i ?>"><button class="page-button"><?= $i ?></button></a>
						<?php endif; ?>
					<?php endfor; ?>

					<!-- 最終ページ目は進むボタン無効化 -->
					<?php $page == $totalPages ? $gray='gray' : $gray = '' ;?>
					<button class="page-button arrow <?= $gray ?>">
					<?php if(!$gray) :?>
							<a href="?page=<?= $_GET['page'] + 1 ?>"> > </a>
						<?php else: ?>
							>
						<?php endif; ?>
					</button>

				</div>
			<?php endif; ?>
		</section>
	</main>
</body>
<?php require('../app/views/components/common/footer.php') ?>
</html>
