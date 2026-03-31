<?php require BASE_PATH . '/app/views/components/common/head.php'; ?>
<?php require BASE_PATH . '/app/views/components/common/header.php'; ?>

<body>
	<main>
		<section class="container">
			<h1 class="page-title">新規作成</h1>
			<?php if (!empty($_SESSION['error'])): ?>
			<?php foreach ($_SESSION['error'] as $error) :?>
			<p style="color: red;">
				<?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
			</p>
			<?php endforeach ;?>
			<?php endif; ?>

			<form action="/register" method="POST">

				<div class="form">
					<label for="name">名前</label>
					<input class="<?= !empty($_SESSION['error']['name']) ? 'error' : ''?>" type="name" placeholder="田中太郎"
						name="name" id="name"
						value="<?= !empty($_SESSION['old']['name']) ? htmlspecialchars($_SESSION['old']['name'], ENT_QUOTES, 'UTF-8'): '' ;?>">
				</div>

				<div class="form">
					<label for="email">メールアドレス</label>
					<input class="<?= !empty($_SESSION['error']['email']) ? 'error' : ''?>" type="email"
						placeholder="sample@hogehoge.com" name="email" id="email"
						value="<?= !empty($_SESSION['old']['email']) ? htmlspecialchars($_SESSION['old']['email'], ENT_QUOTES, 'UTF-8'): '' ;?>">
				</div>

				<div class="form">
					<label for="password">パスワード</label>
					<input class="<?= !empty($_SESSION['error']['password']) ? 'error' : ''?>" class="" type="password"
						placeholder="半角英数字で8文字以上" name="password" id="password">
				</div>

				<div class="form">
					<label for="rePassword">パスワード(確認)</label>
					<input class="<?= !empty($_SESSION['error']['rePassword']) ? 'error' : ''?>" type="rePassword"
						placeholder="パスワードと同じ値を入力" name="rePassword" id="rePassword">
				</div>

				<div class="right">
					<div class="register-button">
						<button class="" type="submit">登録</button>
					</div>
					<div class="register-button-back">
						<a class="back-button" href="/login">戻る</a>
					</div>
				</div>

			</form>
		</section>
	</main>
</body>
<?php unset($_SESSION['error']); ?>
<?php require BASE_PATH . '/app/views/components/common/footer.php'; ?>

</html>
