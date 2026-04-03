<?php

declare(strict_types=1);

session_start();

require_once __DIR__ . '/../app/controllers/DiaryController.php';
require_once __DIR__ . '/../app/controllers/LoginController.php';

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

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

// /login でログインページ
if ($path === '/login' && $method=='GET') {
	$controller = new LoginController();
	$controller->showLogin();
	exit;
}

// ログイン処理
if ($path === '/login' && $method=='POST') {
	$controller = new LoginController();
	$controller->login();
	exit;
}

// 新規登録画面
if ($path === '/register' && $method=='GET') {
	$controller = new LoginController();
	$controller->showRegister();
	exit;
}

// 新規登録処理
if ($path === '/register' && $method=='POST') {
	$controller = new LoginController();
	$controller->register();
	exit;
}

// ログアウト
if ($path === '/logout' && $method=='POST') {
	$controller = new LoginController();
	$controller->logout();
	exit;
}

// /edit/:id で編集ページを表示
if (preg_match('#^/edit/(\d+)$#', $path, $matches) && $method=='GET') {
	$id = (int)$matches[1];
	$controller = new DiaryController();
	$controller->editPage($id);
	exit;
}

// /edit/:id で日記更新
if (preg_match('#^/edit/(\d+)$#', $path, $matches) && $method=='POST') {
	$id = (int)$matches[1];
	$controller = new DiaryController();
	$controller->edit($id);
	exit;
}

// /delete/:id で日記削除
if (preg_match('#^/delete/(\d+)$#', $path, $matches) && $method=='POST') {
	$id = (int)$matches[1];
	$controller = new DiaryController();
	$controller->delete($id);
	exit;
}

http_response_code(404);
echo '404 Not Found';
