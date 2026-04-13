<?php

declare(strict_types=1);

session_start();

require_once __DIR__ . '/../app/controllers/DiaryController.php';
require_once __DIR__ . '/../app/controllers/LoginController.php';
require_once __DIR__ . '/../app/controllers/MyDiaryController.php';
require_once __DIR__ . '/../app/controllers/MyPageController.php';

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

// /myDiaries で自分日記一覧
if ($path === '/myDiaries' && $method=='GET') {
	$id = $_SESSION['user']['id'];
	$controller = new MyDiaryController();
	$controller->index($id);
	exit;
}

// /myPage/:id で、マイページ
if (preg_match('#^/myPage/(\d+)$#', $path, $matches) && $method=='GET') {
	$id = (int)$matches[1];
	$controller = new MyPageController();
	$controller->show($id);
	exit;
}

// /myPage/edit/:id で、マイページ更新
if (preg_match('#^/myPage/edit/(\d+)$#', $path, $matches) && $method=='POST') {
	$id = (int)$matches[1];
	$controller = new MyPageController();
	$controller->edit($id);
	exit;
}

// /diary/create/ で、日記新規作成ページ
if ($path =='/diary/create' && $method=='GET') {
	$controller = new DiaryController();
	$controller->createPage();
	exit;
}

// /diary/create/ で、日記新規作成
if ($path =='/diary/create' && $method=='POST') {
	$controller = new DiaryController();
	$controller->create();
	exit;
}

http_response_code(404);
require __DIR__ . '/../app/views/errors/404.php';
exit;
