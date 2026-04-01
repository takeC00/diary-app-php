<?php require BASE_PATH . '/app/views/components/common/head.php'; ?>
<?php require BASE_PATH . '/app/views/components/common/header.php'; ?>

<body>
	<main>
		<section class="container">
			<h1 class="page-title">ログイン</h1>
			<?php if (!empty($_SESSION['success'])): ?>
			<p style="color: green;">
				<?= htmlspecialchars($_SESSION['success'], ENT_QUOTES, 'UTF-8') ?>
			</p>
			<?php unset($_SESSION['success']); ?>
			<?php endif; ?>
			<?php if (!empty($_SESSION['error'])): ?>
			<?php foreach ($_SESSION['error'] as $error) :?>
			<p style="color: red;">
				<?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
			</p>
			<?php endforeach ;?>
			<?php endif; ?>

			<form action="/login" method="POST">
				<div class="form">
					<label for="email">メールアドレス</label>
					<input class="<?= !empty($_SESSION['error']['email']) ? 'error' : ''?>" type="email" name="email" id="email"
						value="<?= !empty($_SESSION['old']['email']) ? htmlspecialchars($_SESSION['old']['email'], ENT_QUOTES, 'UTF-8'): '' ;?>">
				</div>

				<div class="form">
					<label for="password">パスワード</label>
					<input class="<?= !empty($_SESSION['error']['email']) ? 'error' : ''?>" type="password" name="password"
						id="password">
				</div>

				<div class="right">
					<div class="register-link-button">
						<button><a class="register-link" href="/register">アカウント作成がまだの方はこちらから</a></button>
					</div>
					<div class="login-button">
						<button class="" type="submit">ログイン</button>
					</div>
				</div>

			</form>
		</section>
	</main>
</body>
<?php unset($_SESSION['error']); ?>
<?php require BASE_PATH . '/app/views/components/common/footer.php'; ?>

</html>
