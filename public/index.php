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

// /show/:id で詳細ページを表示
if (preg_match('#^/show/(\d+)$#', $path, $matches)) {
	$id = (int)$matches[1];
	$controller = new DiaryController();
	$controller->show($id);
	exit;
}

http_response_code(404);
echo '404 Not Found';
