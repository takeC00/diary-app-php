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
