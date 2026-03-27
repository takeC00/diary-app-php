<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/controllers/DiaryController.php';

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// /で一覧画面を表示
if ($path === '/' || $path === '') {
    $controller = new DiaryController();
    $controller->index();
    exit;
}

// /showで詳細ページを表示
if ($path === '/show' ) {
	echo "詳細ページ";
	exit;
}
http_response_code(404);
echo '404 Not Found';
