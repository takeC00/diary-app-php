<?php

declare(strict_types=1);

function isLogin(): void
{
    if (empty($_SESSION['user'])) {
        $_SESSION['error']['common'] = 'ログインしてください。';
        header('Location: /login');
        exit;
    }
}
