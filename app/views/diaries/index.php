<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>写真日記一覧</title>
	<link rel="stylesheet" href="/css/common.css">
	<link rel="stylesheet" href="/css/header.css">
	<link rel="stylesheet" href="/css/footer.css">
	<link rel="stylesheet" href="/css/diaries.css">
</head>

<body>
	<header class="">
		<div class="flex">
			<!-- ロゴ -->
			<div class="flex">
				<a href="/diaries" class="flex">
					<img src="/images/default.png" class="logo">
					<span class="">Photo Diary</span>
				</a>
				<!-- ハンバーガー -->
				<!--<button x-on:click="open = !open; console.log(open)" class="">
									<svg x-show="!open" class="">
											<path
													d="M96 160C96 142.3 110.3 128 128 128L512 128C529.7 128 544 142.3 544 160C544 177.7 529.7 192 512 192L128 192C110.3 192 96 177.7 96 160zM96 320C96 302.3 110.3 288 128 288L512 288C529.7 288 544 302.3 544 320C544 337.7 529.7 352 512 352L128 352C110.3 352 96 337.7 96 320zM544 480C544 497.7 529.7 512 512 512L128 512C110.3 512 96 497.7 96 480C96 462.3 110.3 448 128 448L512 448C529.7 448 544 462.3 544 480z" />
									</svg>
									<svg x-show="open" class="">
											<path
													d="M183.1 137.4C170.6 124.9 150.3 124.9 137.8 137.4C125.3 149.9 125.3 170.2 137.8 182.7L275.2 320L137.9 457.4C125.4 469.9 125.4 490.2 137.9 502.7C150.4 515.2 170.7 515.2 183.2 502.7L320.5 365.3L457.9 502.6C470.4 515.1 490.7 515.1 503.2 502.6C515.7 490.1 515.7 469.8 503.2 457.3L365.8 320L503.1 182.6C515.6 170.1 515.6 149.8 503.1 137.3C490.6 124.8 470.3 124.8 457.8 137.3L320.5 274.7L183.1 137.4z" />
									</svg>
							</button>-->
			</div>


			<!-- ナビ -->
			<nav class="right">
				<ul class="flex right">
					<li class="">
						<a href="/diaries" class="">
							自分日記
						</a>
					</li>

					<li class="">
						<a href="#" class="">
							マイページ
						</a>
					</li>

					<li class="">
						<a href="#" class="">
							公開日記
						</a>
					</li>

					<li class="">
						<form method="POST" action="{{ route('logout') }}" class="">
							<button type="submit" class="">
								ログアウト
							</button>
						</form>
					</li>
				</ul>
			</nav>
		</div>
	</header>
	<main>
		<section>
			<div>
				<div class="diary-list">
					<?php foreach ($diaries as $diary): ?>
					<article class="diary-card">
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
					</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
	</main>
	<footer>
		<div class="flex">

			<!-- ロゴ -->
			<div class="">
				<a href="/diaries" class="flex">
					<img src="/images/default.png" class="logo-mid">
				</a>
			</div>

			<!-- ナビ -->
			<nav class="">
				<ul class="flex">
					<li class="">
						<a href="#" class="">
							自分日記
						</a>
					</li>

					<li class="">
						<a href="#" class="">
							マイページ
						</a>
					</li>

					<li class="">
						<a href="#" class="">
							公開日記
						</a>
					</li>

					<li class="">
						<form method="POST" action="{{ route('logout') }}" class="">
							<button type="submit" class="">
								ログアウト
							</button>
						</form>
					</li>
				</ul>
			</nav>
		</div>
		<div class="copy-light">
				<small>&copy; 2026 PhotoDiaryApp-PHP.</small>
			</div>
	</footer>
</body>

</html>
