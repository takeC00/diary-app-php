<?php

function isLogin(): bool
{
	return !empty($_SESSION['user']);
}

function requireLogin(): void
{
    if (empty($_SESSION['user'])) {
		$_SESSION['error']['common'] = 'ログインしてください。';
		header('Location: /login');
		exit;
	}
}

function isOwner(array $diary): bool
{
	return isLogin() && $_SESSION['user']['id'] === (int)$diary['user_id'];
}
