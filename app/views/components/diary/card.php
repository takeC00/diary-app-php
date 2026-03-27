<article class="diary-card">
	<a href="/show/<?= htmlspecialchars($diary['id'], ENT_QUOTES, 'UTF-8') ?>">
		<img src="/images/default.png" alt="日記画像" class="diary-image">

		<h2 class="diary-title">
			<?= htmlspecialchars($diary['title'], ENT_QUOTES, 'UTF-8'); ?>
		</h2>

		<div class="diary-date">
			<?= htmlspecialchars($diary['diary_date'], ENT_QUOTES, 'UTF-8'); ?>
		</div>

		<p class="diary-user">
			<?= nl2br(htmlspecialchars($diary['user_name'], ENT_QUOTES, 'UTF-8')); ?>
		</p>
	</a>
</article>
