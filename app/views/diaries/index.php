<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>写真日記一覧</title>
		<link rel="stylesheet" href="/css/common.css">
		<link rel="stylesheet" href="/css/diaries.css">
</head>
<body>
		<header>
		</header>
		<main>
			<section>
				<div>
						<div class="diary-list">
								<?php foreach ($diaries as $diary): ?>
										<article class="diary-card">
												<img
														src="/images/default.png"
														alt="日記画像"
														class="diary-image"
												>

												<h2 class="diary-title">
														<?= htmlspecialchars($diary['title'], ENT_QUOTES, 'UTF-8'); ?>
												</h2>

												<div class="diary-date">
														<?= htmlspecialchars($diary['diary_date'], ENT_QUOTES, 'UTF-8'); ?>
												</div>

												<p class="diary-user">
														<?= nl2br(htmlspecialchars($diary['user_name'], ENT_QUOTES, 'UTF-8')); ?>
												</p>
										</article>
								<?php endforeach; ?>
						</div>
				</div>
			</section>
		</main>
		<footer>
		</footer>
</body>
</html>
